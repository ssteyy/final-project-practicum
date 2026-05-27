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

                <div id="line1" class="flex-1 h-1 bg-emerald-500 mx-2"></div>

                <!-- STEP 2 -->
                <div class="flex flex-col items-center">
                    <div id="step2"
                         class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center animate-pulse">
                        2
                    </div>
                    <span class="text-xs mt-2">Payment</span>
                </div>

                <div id="line2" class="flex-1 h-1 bg-gray-300 mx-2"></div>

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

                        <p class="text-2xl font-extrabold text-gray-900">
                            FreelanceHub
                        </p>

                        <h1 class="text-3xl font-bold text-black mt-1">
                            {{ number_format($order->amount ?? 0, 2) }}
                            <span class="text-sm font-medium text-gray-500">USD</span>
                        </h1>

                        <div class="border-t border-dashed border-gray-500 my-5"></div>

                        <div class="flex justify-center">
                        <div class="flex justify-center">
                        <div class="p-[20px] bg-white rounded-2xl shadow-inner">

                            @if($order->khqr_string)

                                <svg width="260" height="260" viewBox="0 0 260 260">

                                    <!-- QR CODE -->
                                    <image
                                        href="https://api.qrserver.com/v1/create-qr-code/?size=260x260&data={{ urlencode($order->khqr_string) }}"
                                        x="0"
                                        y="0"
                                        width="260"
                                        height="260"
                                    />

                                    <!-- Circle background -->
                                    <circle
                                        cx="130"
                                        cy="130"
                                        r="30"
                                        fill="white"
                                    />

                                    <!-- Optional border (nice UI touch) -->
                                    <circle
                                        cx="130"
                                        cy="130"
                                        r="30"
                                        fill="none"
                                        stroke="#e5e7eb"
                                        stroke-width="1"
                                    />

                                    <!-- USD SVG ICON -->
                                    <image
                                        href="{{ asset('assets/currency-dollar-svgrepo-com.svg') }}"
                                        x="110"
                                        y="110"
                                        width="40"
                                        height="40"
                                    />

                                </svg>

                            @endif

                        </div>
                    </div>
                    </div>

                    </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="lg:col-span-2">

                <div class="bg-white dark:bg-slate-800 p-8 rounded-3xl shadow-2xl border">

                    <h1 class="text-4xl font-black text-center text-emerald-500">
                        {{ number_format($order->amount ?? 0, 2) }}
                    </h1>

                    <p class="text-center text-gray-500 mb-6">
                        {{ $order->service->title }}
                    </p>

                    <!-- SERVICE DETAILS -->
                    <div class="mb-6">

                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                            Service Details
                        </h3>

                        <div class="space-y-2">

                            <p class="text-gray-600">
                                <strong>Description:</strong>
                                {{ $order->service->description }}
                            </p>

                            @if ($order->service->freelancer)
                                <p class="text-gray-600">
                                    <strong>Freelancer:</strong>
                                    {{ $order->service->freelancer->name }}
                                </p>
                            @endif

                        </div>

                    </div>

                    <!-- WAITING -->
                    <div id="waitingBox"
                         class="p-5 rounded-2xl bg-yellow-50 border border-yellow-200 mb-6">

                        <div class="flex items-center gap-3">

                            <div class="relative">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                <div class="absolute inset-0 bg-yellow-500 rounded-full animate-ping"></div>
                            </div>

                            <div>
                                <p class="font-bold">
                                    Waiting for Payment
                                </p>

                                <p class="text-xs text-gray-500">
                                    Auto checking every 3 seconds
                                </p>
                            </div>

                        </div>
                    </div>

                    <!-- SUCCESS BOX -->
                    <div id="successBox"
                         class="hidden p-5 rounded-2xl bg-green-50 border border-green-200 mb-6">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center">
                                ✓
                            </div>

                            <div>
                                <p class="font-bold text-green-700">
                                    Payment Completed
                                </p>

                                <p class="text-xs text-green-600">
                                    Your payment has been verified successfully
                                </p>
                            </div>

                        </div>
                    </div>

                    <a href="{{ route('orders.index') }}"
                       class="block text-center text-gray-500 mt-4 hover:text-black">
                        Back →
                    </a>

                </div>

                <!-- BUTTON -->
                <div class="mt-12 px-2 flex justify-center">

                    <form id="markPaidForm"
                        action="{{ route('orders.mark-paid-test', $order) }}"
                        method="POST">

                        @csrf

                        <button type="submit"
                                class="bg-white text-white text-sm px-5 py-2 rounded-lg font-semibold flex items-center gap-2 border border-white hover:bg-white-100">
                            <span>Mark as Paid</span>
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

            <svg class="w-10 h-10 text-green-500"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="3"
                      d="M5 13l4 4L19 7" />
            </svg>

        </div>

        <h2 class="text-2xl font-bold text-green-600">
            Payment Successful
        </h2>

        <p class="text-gray-500 mt-2">
            Order marked as paid successfully.
        </p>

        <button onclick="completeOrder()"
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

            // STEP 2 COMPLETE
            updateProgressToStep2Done();

        } else {

            alert("Failed to mark as paid");

        }

    } catch (err) {

        console.error(err);
        alert("Something went wrong");

    }

});

// ================= STEP 2 COMPLETE =================
function updateProgressToStep2Done() {

    // STEP 2
    const step2 = document.getElementById('step2');

    step2.classList.remove('bg-blue-500', 'animate-pulse');
    step2.classList.add('bg-green-500');

    step2.innerHTML = '✓';

    // LINE TO STEP 3
    const line2 = document.getElementById('line2');

    line2.classList.remove('bg-gray-300');
    line2.classList.add('bg-emerald-500');

    // STEP 3 ACTIVE
    const step3 = document.getElementById('step3');

    step3.classList.remove('bg-gray-300');
    step3.classList.add('bg-blue-500', 'animate-pulse');

}

// ================= FINAL COMPLETE =================
function completeOrder() {

    // STEP 3 CHECK
    const step3 = document.getElementById('step3');

    step3.classList.remove('bg-blue-500', 'animate-pulse');
    step3.classList.add('bg-green-500');

    step3.innerHTML = '✓';

    // HIDE WAITING BOX
    document.getElementById('waitingBox').classList.add('hidden');

    // SHOW SUCCESS BOX
    document.getElementById('successBox').classList.remove('hidden');

    // CLOSE MODAL
    const modal = document.getElementById('successModal');

    modal.classList.remove('flex');
    modal.classList.add('hidden');

}

// ================= SHOW MODAL =================
function showModal() {

    const modal = document.getElementById('successModal');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

}

</script>
@endpush

</x-app-layout>
