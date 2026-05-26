<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use KHQR\BakongKHQR;
use KHQR\Helpers\KHQRData;
use KHQR\Models\IndividualInfo;

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
        $expirationTimestamp = strval(floor(microtime(true) * 1000) + (30 * 60 * 1000)); // 30 minutes validity

        $info = new IndividualInfo(
            bakongAccountID: config('services.bakong.account_id', 'demo@devb'),
            merchantName: config('services.bakong.merchant_name', 'FreelanceHub'),
            merchantCity: config('services.bakong.merchant_city', 'Phnom Penh'),
            currency: KHQRData::CURRENCY_USD,
            amount: (float) $order->amount,
            billNumber: 'ORD-'.$order->id,
            purposeOfTransaction: 'Payment for order #'.$order->id,
            expirationTimestamp: $expirationTimestamp,
        );

        $response = BakongKHQR::generateIndividual($info);

        // The QR data is inside $response->data
        $qrData = $response->data;

        $order->update([
            'khqr_string' => $qrData['qr'],
            'khqr_md5' => $qrData['md5'],
        ]);

        return view('orders.payment', compact('order'));
    }

    /**
     * Dedicated function: take khqr_md5 (from generated khqr_string) and verify paid/unpaid
     * via Bakong Open API check_transaction_by_md5 endpoint.
     */
    public function verifyPaymentByMD5(string $md5): array
    {
        if (empty($md5)) {
            return ['status' => 'no_qr'];
        }

        $token = config('services.bakong.token');
        if (empty($token)) {
            return ['status' => 'pending', 'message' => 'No BAKONG_TOKEN configured'];
        }

        $isTest = config('services.bakong.env', 'sit') === 'sit';

        try {
            $bakong = new BakongKHQR($token);
            $response = $bakong->checkTransactionByMD5($md5, $isTest);

            \Log::info('KHQR verify by md5', ['md5' => $md5, 'response' => $response]);

            $data = $response['data'] ?? null;
            $code = $response['responseCode'] ?? null;
            $message = $response['responseMessage'] ?? null;

            // Exact "Unhash Failed" case from Bakong (MD5 not known to the system)
            if (isset($response['unhashed']) || str_contains(strtolower($message ?? ''), 'unhash') || str_contains(strtolower($message ?? ''), 'not found')) {
                return [
                    'status' => 'not_found',
                    'message' => 'Unhash Failed. String not found. (This MD5 was never seen by Bakong for your account/token)',
                    'raw' => $response,
                ];
            }

            if ($code === 0 && $data && ($data['status'] ?? null) === 'SUCCESS') {
                return ['status' => 'paid', 'data' => $data];
            }

            return [
                'status' => 'pending',
                'data' => $data,
                'message' => $message,
                'raw' => $response,
            ];
        } catch (\Exception $e) {
            \Log::error('KHQR verify md5 failed: '.$e->getMessage());

            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Check payment status (AJAX). Now uses verifyPaymentByMD5(khqr_md5).
     */
    public function checkStatus(Order $order)
    {
        if ($order->payment_status === 'paid') {
            return response()->json(['status' => 'paid']);
        }

        if (! $order->khqr_md5) {
            return response()->json(['status' => 'no_qr']);
        }

        $result = $this->verifyPaymentByMD5($order->khqr_md5);

        if ($result['status'] === 'paid' && ! empty($result['data'])) {
            $d = $result['data'];
            $order->update([
                'payment_status' => 'paid',
                'paid_at' => now(),
                'transaction_reference' => $d['transactionId'] ?? $d['md5'] ?? $d['hash'] ?? null,
            ]);

            return response()->json(['status' => 'paid']);
        }

        return response()->json([
            'status' => $result['status'],
            'bakong_response' => $result['data'] ?? $result['raw'] ?? null,
            'message' => $result['message'] ?? null,
        ]);
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
            'payment_status' => 'paid',
            'paid_at' => now(),
            'transaction_reference' => 'TEST-PAYMENT-'.time(),
            // Note: We do NOT change the main 'status' column here.
            // 'status' can stay as 'pending', 'accepted', 'in progress', or 'completed' depending on your workflow.
        ]);

        return redirect()->route('orders.index')
            ->with('status', '✅ Payment completed successfully! Your order is now awaiting freelancer confirmation.');
    }

    /**
     * Decode a KHQR string to see embedded details (very useful for debugging).
     * Shows which Bakong account the QR was actually generated for.
     */
    public function decodeKHQR(string $khqrString): array
    {
        try {
            $decoded = BakongKHQR::decode($khqrString);

            // The decoded data structure from the library
            $data = $decoded->data ?? [];

            return [
                'success' => true,
                'bakong_account' => $data['accountId'] ?? $data['bakongAccountID'] ?? null,
                'amount' => $data['amount'] ?? null,
                'currency' => $data['currency'] ?? null,
                'merchant_name' => $data['merchantName'] ?? null,
                'bill_number' => $data['billNumber'] ?? null,
                'raw' => $data,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Debug endpoint: decode the KHQR of the current order.
     * Visit: /orders/{order}/debug-khqr
     */
    public function debugDecodeKHQR(Order $order)
    {
        if (! $order->khqr_string) {
            return response()->json(['error' => 'No khqr_string on this order']);
        }

        $result = $this->decodeKHQR($order->khqr_string);

        return response()->json([
            'order_id' => $order->id,
            'stored_khqr_md5' => $order->khqr_md5,
            'decoded' => $result,
            'your_config_account' => config('services.bakong.account_id'),
        ]);
    }
}
