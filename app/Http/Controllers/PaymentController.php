<?php

namespace App\Http\Controllers;

use App\Models\Order;
use KHQR\BakongKHQR;
use KHQR\Helpers\KHQRData;
use KHQR\Models\IndividualInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Generate and show KHQR payment page for an order.
     * This method works WITHOUT any Bakong token (pure client-side QR generation).
     */
    public function generateQR(Order $order)
    {
        if ($order->client_id !== Auth::id()) {
            abort(403);
        }

        if ($order->payment_status === 'paid') {
            return redirect()->route('orders.index');
        }

        // Always generate a fresh QR with new expiration timestamp (recommended for testing)
        // This prevents "QR code is Expired" errors
        $expirationTimestamp = strval( floor(microtime(true) * 1000) + (30 * 60 * 1000) ); // 30 minutes validity

        $info = new IndividualInfo(
            bakongAccountID: config('services.bakong.account_id', 'demo@devb'),
            merchantName: config('services.bakong.merchant_name', 'FreelanceHub'),
            merchantCity: config('services.bakong.merchant_city', 'Phnom Penh'),
            currency: KHQRData::CURRENCY_USD,
            amount: (float) $order->amount,
            billNumber: 'ORD-' . $order->id,
            purposeOfTransaction: 'Payment for order #' . $order->id,
            expirationTimestamp: $expirationTimestamp,
        );

        $response = BakongKHQR::generateIndividual($info);

        // The QR data is inside $response->data
        $qrData = $response->data;

        $order->update([
            'khqr_string' => $qrData['qr'],
            'khqr_md5'    => $qrData['md5'],
        ]);

        return view('orders.payment', compact('order'));
    }

    /**
     * Check payment status (AJAX).
     * Currently returns 'pending' because we have no token yet.
     * When you get a real Bakong token, replace the logic below.
     */
    public function checkStatus(Order $order)
    {
        if ($order->payment_status === 'paid') {
            return response()->json(['status' => 'paid']);
        }

        if (!$order->khqr_md5) {
            return response()->json(['status' => 'no_qr']);
        }

        // Real-time detection via Bakong Open API
        $token = config('services.bakong.token');

        // Use BAKONG_API_URL if provided, otherwise auto-detect based on ENV
        $baseUrl = config('services.bakong.api_url');

        if (!$baseUrl) {
            $env = config('services.bakong.env', 'sit');
            $baseUrl = $env === 'sit'
                ? 'https://sit-api-bakong.nbc.gov.kh'
                : 'https://api-bakong.nbc.gov.kh';
        }

        if ($token && $order->khqr_md5) {
            try {
                $bakong = new BakongKHQR($token, $baseUrl);
                $response = $bakong->checkTransactionByMD5($order->khqr_md5);

                \Log::info('Bakong check for order #' . $order->id, [
                    'md5' => $order->khqr_md5,
                    'response' => $response,
                ]);

                if (isset($response->data) && ($response->data->status ?? null) === 'SUCCESS') {
                    $order->update([
                        'payment_status'       => 'paid',
                        'paid_at'              => now(),
                        'transaction_reference' => $response->data->transactionId ?? $response->data->md5 ?? null,
                    ]);

                    return response()->json(['status' => 'paid']);
                }

                // Return more info for debugging on the payment page
                return response()->json([
                    'status' => 'pending',
                    'bakong_response' => $response->data ?? null,
                ]);
            } catch (\Exception $e) {
                \Log::error('Bakong API error for order #' . $order->id . ': ' . $e->getMessage());
                return response()->json([
                    'status' => 'pending',
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return response()->json(['status' => 'pending']);
    }

    /**
     * TEST ONLY: Manually mark order as paid.
     * This is for development/testing when you don't have a real Bakong token yet.
     */
    public function markAsPaidTest(Order $order)
    {
        if ($order->client_id !== Auth::id()) {
            abort(403);
        }

        if ($order->payment_status === 'paid') {
            return redirect()->route('orders.index');
        }

        $order->update([
            'payment_status'       => 'paid',
            'paid_at'              => now(),
            'transaction_reference' => 'TEST-PAYMENT-' . time(),
            // Note: We do NOT change the main 'status' column here.
            // 'status' can stay as 'pending', 'accepted', 'in progress', or 'completed' depending on your workflow.
        ]);

        return redirect()->route('orders.index')
            ->with('status', '✅ Payment completed successfully! Your order is now awaiting freelancer confirmation.');
    }
}
