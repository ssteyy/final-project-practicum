<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use KHQR\BakongKHQR;
use KHQR\Helpers\KHQRData;
use KHQR\Models\IndividualInfo;

class PaymentController extends Controller
{
    /**
     * Generate and show KHQR payment page for an order.
     */
    public function generateQR(Order $order)
    {
        if ($order->client_id !== Auth::id()) {
            abort(403);
        }

        if ($order->payment_status === 'paid') {
            return redirect()->route('orders.index');
        }

        $token = config('services.bakong.token');

        if (empty($token)) {
            abort(500, 'BAKONG_TOKEN is missing');
        }

        $expirationTimestamp = strval(
            floor(microtime(true) * 1000) + (30 * 60 * 1000)
        );

        $info = new IndividualInfo(
            bakongAccountID: config('services.bakong.account_id'),
            merchantName: config('services.bakong.merchant_name', 'FreelanceHub'),
            merchantCity: config('services.bakong.merchant_city', 'Phnom Penh'),
            currency: KHQRData::CURRENCY_USD,
            amount: (float) $order->amount,
            billNumber: 'ORD-'.$order->id,
            purposeOfTransaction: 'Payment for order #'.$order->id,
            expirationTimestamp: $expirationTimestamp,
        );

        $bakong = new BakongKHQR($token);

        $response = $bakong->generateIndividual($info);

        $qrData = is_array($response) ? ($response['data'] ?? []) : ($response->data ?? []);

        $order->update([
            'khqr_string' => $qrData['qr'] ?? null,
            'khqr_md5' => $qrData['md5'] ?? null,
        ]);

        return view('orders.payment', compact('order'));
    }

    /**
     * Verify payment by khqr_md5 using Bakong Open API.
     */
    public function verifyPaymentByMD5(string $md5): array
    {
        if (empty($md5)) {
            return ['status' => 'no_qr'];
        }

        $token = config('services.bakong.token');

        if (empty($token)) {
            return [
                'status' => 'error',
                'message' => 'BAKONG_TOKEN not configured'
            ];
        }

        try {
            $isTest = config('services.bakong.env') === 'sit';
            $bakong = new BakongKHQR($token);
            $response = $bakong->checkTransactionByMD5($md5, $isTest);

            $verifyArray = is_array($response) ? $response : (array) $response;

            Log::info('Bakong Verify', [
                'md5' => $md5,
                'is_test' => $isTest,
                'response' => $verifyArray
            ]);

            // Handle API errors (non-200 responses)
            if (isset($verifyArray['responseCode']) && $verifyArray['responseCode'] !== 0) {
                $errorCode = $verifyArray['errorCode'] ?? 'unknown';
                $errorMessage = $verifyArray['responseMessage'] ?? 'Unknown API error';
                return [
                    'status' => 'error',
                    'message' => $errorMessage,
                    'code' => $errorCode,
                    'raw' => $verifyArray,
                ];
            }

            $data = $verifyArray['data'] ?? [];

            if ((($verifyArray['responseCode'] ?? 1) === 0) && !empty($data['acknowledgedDateMs'])) {
                return ['status' => 'paid', 'data' => $data];
            }

            return [
                'status' => 'pending',
                'data' => $data,
                'message' => $verifyArray['responseMessage'] ?? null,
                'raw' => $verifyArray,
            ];
        } catch (\Exception $e) {
            Log::error('Bakong Verify Error', ['md5' => $md5, 'error' => $e->getMessage()]);
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Check payment status (AJAX).
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
            $data = $result['data'];

            $order->update([
                'payment_status' => 'paid',
                'paid_at' => now(),
                'transaction_reference' => $data['externalRef'] ?? $data['transactionId'] ?? $order->khqr_md5,
            ]);

            return response()->json(['status' => 'paid']);
        }

        return response()->json([
            'status' => $result['status'],
            'message' => $result['message'] ?? null,
            'bakong_response' => $result['data'] ?? $result['raw'] ?? null,
        ]);
    }

    /**
     * TEST ONLY: Manually mark order as paid.
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
        ]);

        return redirect()->route('orders.index')->with('status', '✅ Payment completed successfully!');
    }

    /**
     * Decode a KHQR string to see embedded details.
     */
    public function decodeKHQR(string $khqrString): array
    {
        try {
            $decoded = BakongKHQR::decode($khqrString);
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
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Debug: decode the KHQR of the current order.
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
