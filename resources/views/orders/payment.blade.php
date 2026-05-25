<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Pay for Order #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-3xl border border-gray-200 dark:border-gray-700">

                <!-- Header -->
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Pay for Order #{{ $order->id }}</h1>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->service->title }}</p>
                        </div>
                        <a href="{{ route('orders.index') }}" class="text-sm text-indigo-600 hover:underline">← Back to My Orders</a>
                    </div>
                </div>

                <div class="p-8 text-center">

                    <!-- Amount -->
                    <div class="mb-8">
                        <p class="text-sm uppercase tracking-widest text-gray-500 dark:text-gray-400">Amount to Pay</p>
                        <div class="mt-2">
                            <span class="text-6xl font-black text-emerald-600 dark:text-emerald-400">${{ number_format($order->amount, 2) }}</span>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">USD • via KHQR (Bakong)</p>
                    </div>

                    <!-- QR Code -->
                    @if($order->khqr_string)
                        <div class="mb-6">
                            <div class="inline-block p-4 bg-white border-2 border-gray-200 rounded-2xl shadow-inner">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=260x260&data={{ urlencode($order->khqr_string) }}"
                                     alt="KHQR Payment Code"
                                     class="mx-auto"
                                     width="260" height="260">
                            </div>
                            <p class="mt-4 text-sm text-gray-600 dark:text-gray-400 max-w-xs mx-auto">
                                Open any Bakong-supported banking app (ABA, Acleda, Wing, KB, etc.) and scan this QR code.
                            </p>
                        </div>
                    @else
                        <div class="text-red-500">Failed to generate QR code.</div>
                    @endif

                    <!-- Payment Status -->
                    <div id="payment-status"
                         class="mt-8 p-4 rounded-2xl text-lg font-semibold bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                        Waiting for payment...
                    </div>

                    <div id="last-check-info" class="mt-2 text-xs text-gray-400 dark:text-gray-500 text-center">
                        Checking with Bakong Open API...
                    </div>

                    <button onclick="checkPaymentStatus()" 
                            class="mt-4 inline-flex items-center px-4 py-2 text-sm font-semibold text-emerald-700 dark:text-emerald-300 bg-emerald-100 dark:bg-emerald-900/40 hover:bg-emerald-200 dark:hover:bg-emerald-900/60 rounded-xl transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.058 11H1M12 3v2m0 16v2m9-9H15m-6 0a8 8 0 01-.938-1.5M12 3a8 8 0 00-8 8"></path>
                        </svg>
                        Force Check with Bakong Now
                    </button>



                    <!-- TEST BUTTON -->
                    @if(config('app.env') === 'local' || config('app.debug'))
                        <div class="mt-8 p-4 border border-red-300 bg-red-50 dark:bg-red-900/20 rounded-2xl">
                            <p class="text-red-700 dark:text-red-400 text-sm font-semibold mb-3">
                                ⚠️ DEVELOPMENT ONLY — Do not use in production
                            </p>
                            <form action="{{ route('orders.mark-paid-test', $order) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="w-full px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition"
                                        onclick="return confirm('Mark this order as PAID for testing?')">
                                    Mark as Paid (Test Mode)
                                </button>
                            </form>
                            <p class="text-xs text-red-600 dark:text-red-400 mt-2">
                                This will instantly mark the order as paid without real payment.
                            </p>
                        </div>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('orders.index') }}"
                           class="inline-block px-6 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            Done? Go to My Orders →
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>

    @push('scripts')
    <script>
                async function checkPaymentStatus() {
                    try {
                        const response = await fetch('{{ route('orders.payment.status', $order) }}');
                        const data = await response.json();

                        const statusEl = document.getElementById('payment-status');
                        const lastCheckEl = document.getElementById('last-check-info');

                        const now = new Date().toLocaleTimeString();

                        if (data.status === 'paid') {
                            statusEl.className = 'mt-8 p-4 rounded-2xl text-lg font-semibold bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
                            statusEl.innerHTML = '✅ Payment received! Redirecting to your orders...';
                            setTimeout(() => {
                                window.location.href = '{{ route('orders.index') }}?paid=success';
                            }, 1500);
                        } else if (data.status === 'no_qr') {
                            statusEl.innerHTML = 'No QR generated yet.';
                        } else {
                            statusEl.innerHTML = 'Waiting for payment... (Checking Bakong Open API)';
                        }

                        if (lastCheckEl) {
                            let extra = '';
                            if (data.bakong_response) {
                                extra = ` | Bakong: ${JSON.stringify(data.bakong_response).substring(0, 80)}...`;
                            } else if (data.error) {
                                extra = ` | Error: ${data.error}`;
                            }
                            lastCheckEl.textContent = `Last checked with Bakong at ${now}${extra}`;
                        }
                    } catch (e) {
                        console.error('Status check failed', e);
                    }
                }
            } catch (e) {
                console.error('Status check failed', e);
            }
        }

        // Real-time detection via Bakong Open API - check every 3 seconds
        checkPaymentStatus();
        setInterval(checkPaymentStatus, 3000);
    </script>
    @endpush
</x-app-layout>
