<x-app-layout>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-950 dark:via-slate-900 py-10 px-4">

    <div class="max-w-6xl mx-auto">

        <!-- ================= PROGRESS ================= -->
        <div class="mb-10">
            <div class="flex items-center justify-between">

                <!-- STEP 1 -->
                <div class="flex flex-col items-center">
                    <div id="step1"
                         class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center">
                        ✓
                    </div>
                    <span class="text-xs mt-2">Order</span>
                </div>

                <div class="flex-1 h-1 bg-emerald-500 mx-2"></div>

                <!-- STEP 2 -->
                <div class="flex flex-col items-center">
                    <div id="step2"
                         class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center animate-pulse">
                        2
                    </div>
                    <span class="text-xs mt-2">Payment</span>
                </div>

                <div class="flex-1 h-1 bg-gray-300 mx-2"></div>

                <!-- STEP 3 -->
                <div class="flex flex-col items-center">
                    <div id="step3"
                         class="w-10 h-10 rounded-full bg-gray-300 text-white flex items-center justify-center">
                        3
                    </div>
                    <span class="text-xs mt-2">Done</span>
                </div>

            </div>
        </div>

        <!-- ================= CONTENT ================= -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-9">

            <!-- LEFT QR -->
            <div class="relative lg:col-span-1">

                <div class="absolute -inset-4 bg-gradient-to-r from-red-400 to-pink-500 blur-2xl opacity-20 rounded-3xl"></div>

                <div class="relative bg-white rounded-3xl shadow-2xl overflow-hidden border">

                    <div class="bg-red-600 p-4 text-center relative">
                        <h2 class="text-white font-bold text-lg tracking-widest">
                            KHQR
                        </h2>
                        <div class="absolute bottom-0 right-0 w-16 h-16 bg-red-600 rotate-45 translate-x-6 translate-y-6"></div>
                    </div>

                    <div class="p-6">

                        <p class="text-sm text-gray-600">FreelanceHub</p>

                        <h1 class="text-3xl font-extrabold text-black mt-1">
                            {{ number_format($order->amount ?? 0, 2) }}
                            <span class="text-sm font-medium text-gray-500">USD</span>
                        </h1>

                        <div class="border-t border-dashed my-5"></div>

                        <div class="flex justify-center">
                            <div class="p-[20px] bg-white rounded-2xl shadow-inner">
                                @if($order->khqr_string)
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=260x260&data={{ urlencode($order->khqr_string) }}"
                                         class="w-64 h-64">
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="lg:col-span-2">

                <div class="bg-white dark:bg-slate-800 p-8 rounded-3xl shadow-2xl border">

                    <h1 class="text-4xl font-black text-center text-emerald-500">
                        ${{ number_format($order->amount ?? 0, 2) }}
                    </h1>

                    <p class="text-center text-gray-500 mb-6">
                        {{ $order->service->title }}
                    </p>

                    <div class="p-5 rounded-2xl bg-yellow-50 border border-yellow-200 mb-6">
                        <div class="flex items-center gap-3">

                            <div class="relative">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                <div class="absolute inset-0 bg-yellow-500 rounded-full animate-ping"></div>
                            </div>

                            <div>
                                <p class="font-bold">Waiting for Payment</p>
                                <p class="text-xs text-gray-500">Auto checking every 3 seconds</p>
                            </div>

                        </div>
                    </div>

                    <a href="{{ route('orders.index') }}"
                       class="block text-center text-gray-500 mt-4 hover:text-black">
                        Back →
                    </a>

                </div>

                <!-- BUTTON -->
                <div class="mt-6 px-2 flex justify-center">

                    <form id="markPaidForm"
                          action="{{ route('orders.mark-paid-test', $order) }}"
                          method="POST">
                        @csrf

                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white text-sm px-5 py-2 rounded-lg font-semibold shadow-md">
                            ⚠️ Mark as Paid
                        </button>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>

<!-- ================= SUCCESS MODAL ================= -->
<div id="successModal"
     class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">

    <div class="bg-white dark:bg-slate-800 rounded-3xl p-10 w-[90%] max-w-md text-center shadow-2xl">

        <div class="mx-auto w-20 h-20 rounded-full bg-green-100 flex items-center justify-center mb-4">
            <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                      d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h2 class="text-2xl font-bold text-green-600">
            Payment Successful
        </h2>

        <p class="text-gray-500 mt-2">
            Order marked as paid successfully.
        </p>

        <button onclick="goToOrders()"
                class="mt-6 bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-xl font-semibold">
            OK
        </button>

    </div>
</div>

<!-- ================= SCRIPT ================= -->
@push('scripts')
<script>

document.getElementById('markPaidForm')?.addEventListener('submit', async function (e) {
    e.preventDefault();

    try {
        const res = await fetch(this.action, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            }
        });

        if (res.ok) {
            showModal();
            updateProgress(); // ✅ UPDATE STEP
        } else {
            alert("Failed to mark as paid");
        }

    } catch (err) {
        console.error(err);
        alert("Something went wrong");
    }
});

// ================= PROGRESS UPDATE =================
function updateProgress() {

    // STEP 2 → DONE
    const step2 = document.getElementById('step2');
    step2.classList.remove('bg-blue-500', 'animate-pulse');
    step2.classList.add('bg-green-500');
    step2.innerHTML = '✓';

    // STEP 3 → ACTIVE
    const step3 = document.getElementById('step3');
    step3.classList.remove('bg-gray-300');
    step3.classList.add('bg-blue-500', 'animate-pulse');

}

function showModal() {
    const modal = document.getElementById('successModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function goToOrders() {
    window.location.href = "{{ route('orders.index') }}";
}

</script>
@endpush

</x-app-layout>
