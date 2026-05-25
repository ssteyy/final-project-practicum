# KHQR Bakong Payment Integration Guide

This guide explains how to add **KHQR (Bakong QR)** payment to your FreelanceHub Laravel project using **open source** libraries.

KHQR is Cambodia’s national QR payment standard managed by the National Bank of Cambodia (NBC). It allows clients to pay freelancers instantly using any Bakong-supported bank or wallet app.

---

## 1. How It Works (Simple Flow)

1. Client places an order → order has `amount` (includes platform fee).
2. Client clicks **"Pay with KHQR"** on the order.
3. System generates a **dynamic KHQR** (with exact amount + order reference).
4. QR code + "Scan with Bakong app" is shown.
5. Client scans and pays using their phone.
6. System automatically checks payment status every few seconds.
7. When payment succeeds → order status changes to **Paid** and work can begin.

---

## 2. Prerequisites

- PHP 8.1+ and Laravel 10+
- A real **Bakong account** registered with a Cambodian bank
- Bakong Developer access (free to register)
- Composer
- Basic understanding of your existing `Order` model

---

## 3. Choose an Open Source Library

We recommend the most complete open-source option:

### Recommended: `fidele007/bakong-khqr-php`

```bash
composer require fidele007/bakong-khqr-php
```

This library supports:
- Generate Individual and Merchant KHQR
- Generate Deep Links
- Check transaction status by MD5, hash, etc.
- Renew token

**Alternative (Laravel-native):** `helmab/bakong`

```bash
composer require helmab/bakong
```

Use the alternative only if you prefer Laravel facades.

---

## 4. Register for Bakong Developer Token (Official Process)

According to the **Bakong Open API Document** (National Bank of Cambodia):

1. Go to the official developer portal: **https://api-bakong.nbc.gov.kh/register**
2. Register using the same email/phone linked to your verified Bakong account (must be KYC-verified).
3. After successful registration and login, you can generate a **Bearer Token**.
4. Copy the token. This token is used for all API calls.

**Important Official Notes:**
- The token is valid for **90 days**.
- You must renew it before it expires using the `/v1/renew_token` endpoint (see section below).
- Use the **SIT (Sandbox)** environment for testing: `https://sit-api-bakong.nbc.gov.kh`
- Use **Production** for live payments: `https://api-bakong.nbc.gov.kh`

Add these to your `.env` file:

```env
BAKONG_TOKEN=your_long_token_here
BAKONG_ACCOUNT_ID=yourname@devb          # Your Bakong ID (e.g. john@aclb)
BAKONG_MERCHANT_NAME=FreelanceHub
BAKONG_MERCHANT_CITY=Phnom Penh
BAKONG_ENV=sit                           # Change to "prod" when going live
```

---

## 5. Official Bakong Open API Endpoints (From NBC Document)

All requests must include:

- **Header**: `Authorization: Bearer <your_token>`
- **Content-Type**: `application/json`
- **Method**: `POST`

### Base URLs
- **SIT (Testing)**: `https://sit-api-bakong.nbc.gov.kh`
- **Production**: `https://api-bakong.nbc.gov.kh`

### Important Endpoints

| Endpoint                              | Purpose                                      | Key Request Body                          | When to Use |
|---------------------------------------|----------------------------------------------|-------------------------------------------|-------------|
| `POST /v1/renew_token`                | Renew expired token                          | `{ "email": "your@email.com" }`           | When token is about to expire (every 90 days) |
| `POST /v1/check_transaction_by_md5`   | Check payment status (most used)             | `{ "md5": "..." }`                        | After client scans your KHQR (primary method) |
| `POST /v1/check_transaction_by_hash`  | Check by full transaction hash               | `{ "hash": "..." }`                       | Alternative verification |
| `POST /v1/check_transaction_by_short_hash` | Check using short hash + amount + currency | `{ "short_hash": "...", "amount": 10.5, "currency": "USD" }` | When using short reference |
| `POST /v1/check_bakong_account`       | Verify if a Bakong ID exists                 | `{ "accountId": "user@bank" }`            | Optional validation before generating QR |
| `POST /v1/generate_deeplink_by_qr`    | Generate mobile deep link for the QR         | `{ "qr": "...", "sourceInfo": {...} }`    | Nice-to-have: opens Bakong app directly |

**Most Important for Your Project**: Use `check_transaction_by_md5` after generating the QR. The MD5 is returned when you create the KHQR using the open-source library.

The recommended library (`fidele007/bakong-khqr-php`) already implements all these official endpoints correctly.

---

---

## 6. Database Changes

Create a new migration:

```bash
php artisan make:migration add_khqr_payment_fields_to_orders_table
```

Paste this content:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_status')->default('unpaid')->after('status'); // unpaid, paid, failed
            $table->string('khqr_md5')->nullable()->after('payment_status');
            $table->text('khqr_string')->nullable()->after('khqr_md5');
            $table->timestamp('paid_at')->nullable()->after('khqr_string');
            $table->string('transaction_reference')->nullable()->after('paid_at');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'payment_status',
                'khqr_md5',
                'khqr_string',
                'paid_at',
                'transaction_reference'
            ]);
        });
    }
};
```

Run:

```bash
php artisan migrate
```

Update `app/Models/Order.php` — add the new fields to `$fillable`:

```php
protected $fillable = [
    // ... existing fields
    'payment_status',
    'khqr_md5',
    'khqr_string',
    'paid_at',
    'transaction_reference',
];
```

---

## 7. Update Order Status Logic (Recommended)

Update your order status flow to:

- `pending` → waiting for client to pay
- `paid` → client has paid (freelancer can start work)
- `in_progress`
- `completed`
- `cancelled`

Update any places that check status (especially freelancer and admin views).

---

## 8. Create Payment Controller

```bash
php artisan make:controller PaymentController
```

Basic structure you will implement:

```php
<?php

namespace App\Http\Controllers;

use App\Models\Order;
use BakongKHQR\BakongKHQR;
use BakongKHQR\IndividualInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function generateQR(Order $order)
    {
        if ($order->client_id !== Auth::id()) {
            abort(403);
        }

        if ($order->payment_status === 'paid') {
            return redirect()->route('orders.show', $order);
        }

        $info = new IndividualInfo(
            bakongAccountID: config('services.bakong.account_id'),
            merchantName: config('services.bakong.merchant_name'),
            merchantCity: config('services.bakong.merchant_city'),
            currency: 'USD',
            amount: $order->amount,
            billNumber: 'ORD-' . $order->id,
            purposeOfTransaction: 'Payment for order #' . $order->id,
        );

        $result = BakongKHQR::generateIndividual($info);

        // Save to database
        $order->update([
            'khqr_string' => $result['qr'],
            'khqr_md5'    => $result['md5'],
        ]);

        return view('orders.payment', compact('order'));
    }

    public function checkStatus(Order $order)
    {
        if ($order->payment_status === 'paid') {
            return response()->json(['status' => 'paid']);
        }

        if (!$order->khqr_md5) {
            return response()->json(['status' => 'no_qr']);
        }

        $token = config('services.bakong.token');
        $bakong = new BakongKHQR($token);

        $response = $bakong->checkTransactionByMD5($order->khqr_md5);

        if ($response->data && $response->data->status === 'SUCCESS') {
            $order->update([
                'payment_status' => 'paid',
                'paid_at' => now(),
                'transaction_reference' => $response->data->transactionId ?? null,
                'status' => 'paid', // update main status
            ]);

            return response()->json(['status' => 'paid']);
        }

        return response()->json(['status' => 'pending']);
    }
}
```

---

## 9. Add Routes

In `routes/web.php`, add inside the auth middleware group:

```php
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/orders/{order}/pay', [App\Http\Controllers\PaymentController::class, 'generateQR'])->name('orders.pay');
    Route::get('/orders/{order}/payment-status', [App\Http\Controllers\PaymentController::class, 'checkStatus'])->name('orders.payment.status');
});
```

---

## 10. Create Payment View

Create file: `resources/views/orders/payment.blade.php`

Simple structure:

```blade
@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Pay for Order #{{ $order->id }}</h1>

    <div class="text-center">
        <p class="text-lg font-semibold">Amount to Pay: <span class="text-green-600">${{ number_format($order->amount, 2) }}</span></p>

        @if($order->khqr_string)
            <div class="my-6">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ urlencode($order->khqr_string) }}" 
                     alt="KHQR Code" class="mx-auto border p-2">
            </div>

            <p class="text-sm text-gray-600">Scan this QR code using any Bakong-supported app (ABA, Acleda, Wing, etc.)</p>
        @endif

        <div id="payment-status" class="mt-6 text-lg font-medium text-yellow-600">
            Waiting for payment...
        </div>
    </div>
</div>

<script>
    // Simple polling every 4 seconds
    setInterval(function() {
        fetch("{{ route('orders.payment.status', $order) }}")
            .then(res => res.json())
            .then(data => {
                if (data.status === 'paid') {
                    document.getElementById('payment-status').innerHTML = 
                        '<span class="text-green-600 font-bold">Payment Successful!</span>';
                    setTimeout(() => {
                        window.location.href = "{{ route('orders.show', $order) }}";
                    }, 1500);
                }
            });
    }, 4000);
</script>
@endsection
```

---

## 11. Link from Order Page

In your order show view (`orders/show.blade.php` or client index), add this button when status is `pending`:

```blade
@if($order->payment_status !== 'paid')
    <a href="{{ route('orders.pay', $order) }}" 
       class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
        Pay with KHQR
    </a>
@endif
```

---

## 12. Configuration File (Optional but Clean)

Create `config/services.php` additions or a new `config/bakong.php`:

```php
return [
    'bakong' => [
        'token'         => env('BAKONG_TOKEN'),
        'account_id'    => env('BAKONG_ACCOUNT_ID'),
        'merchant_name' => env('BAKONG_MERCHANT_NAME', 'FreelanceHub'),
        'merchant_city' => env('BAKONG_MERCHANT_CITY', 'Phnom Penh'),
    ],
];
```

---

## 13. Security Best Practices

- Never expose your `BAKONG_TOKEN` on the frontend.
- Always validate that the logged-in user owns the order before generating or checking payment.
- Use HTTPS in production.
- Consider adding a timeout (e.g. QR expires after 15 minutes).
- Log all payment attempts for auditing.

---

## 14. Testing Tips (Using Official SIT Environment)

From the official Bakong Open API Document:

- Always test first on **SIT environment**:
  - Base URL: `https://sit-api-bakong.nbc.gov.kh`
- Switch to Production only after successful testing:
  - Base URL: `https://api-bakong.nbc.gov.kh`
- The recommended library supports passing a custom base URL if needed (check its documentation).
- Use small test amounts (e.g. $0.10 or 100 KHR).
- The SIT environment behaves almost identically to production.
- You can test end-to-end by scanning the generated QR with the real Bakong mobile app (it works on SIT too for development accounts).

---

## 15. Future Improvements

- Add payment expiration (auto-cancel unpaid orders after X minutes)
- Send email/SMS notification when payment succeeds
- Support both USD and KHR
- Add "Pay with Deep Link" button (opens Bakong app directly)
- Store transaction receipt image

---

## 16. Summary

You now have a complete, open-source KHQR Bakong payment flow integrated into your FreelanceHub platform.

**Files you will modify/create:**
- Migration for payment fields
- `Order` model
- `PaymentController`
- `routes/web.php`
- `resources/views/orders/payment.blade.php`
- `.env` variables
- Links from existing order pages

This solution uses only **free open source** libraries and follows Cambodia’s official KHQR standard.

---

**Done.** Your clients can now pay freelancers securely using KHQR.
