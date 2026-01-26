<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-zinc-900 dark:text-white leading-tight tracking-tight">
            {{ __('Place Your Order') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:from-zinc-950 dark:via-zinc-900 dark:to-zinc-950 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Order Form - Left Side (2/3) -->
                <div class="lg:col-span-2">
                    <div class="bg-white/90 dark:bg-zinc-900/90 overflow-hidden shadow-2xl rounded-3xl border border-zinc-200 dark:border-zinc-800">
                        <div class="px-10 py-8 border-b border-zinc-100 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-800/50">
                            <h3 class="text-2xl font-extrabold text-zinc-900 dark:text-white">Order Details</h3>
                            <p class="text-zinc-500 dark:text-zinc-400 text-base mt-2">Provide your requirements to get started</p>
                        </div>

                        <div class="p-10">
                            <form method="POST" action="{{ route('orders.store') }}" class="space-y-8">
                                @csrf
                                <input type="hidden" name="service_id" value="{{ $service->id }}">

                                <!-- Requirements Section -->
                                <div>
                                    <label for="requirements" class="block text-base font-semibold text-zinc-700 dark:text-zinc-300 mb-2">
                                        <i class="fas fa-clipboard-list text-indigo-600 mr-2"></i>
                                        Project Requirements
                                    </label>
                                    <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-3">
                                        Be as specific as possible. Include details about deliverables, timeline, and any special requests.
                                    </p>
                                    <textarea
                                        id="requirements"
                                        name="requirements"
                                        rows="8"
                                        required
                                        placeholder="Example: I need a responsive website with 5 pages including home, about, services, portfolio, and contact. The design should be modern and clean with a blue color scheme. I need it completed within 2 weeks..."
                                        class="block w-full px-5 py-4 rounded-2xl border-zinc-200 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 text-base shadow-sm transition-all placeholder:text-zinc-400"
                                    >{{ old('requirements') }}</textarea>
                                    <x-input-error :messages="$errors->get('requirements')" class="mt-2" />
                                </div>

                                <!-- Important Notes -->
                                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-900 rounded-2xl p-6">
                                    <h4 class="font-semibold text-blue-900 dark:text-blue-200 mb-3 flex items-center">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Important Information
                                    </h4>
                                    <ul class="space-y-2 text-sm text-blue-800 dark:text-blue-300">
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle mt-1 mr-2 text-blue-600"></i>
                                            <span>Your order will be sent to the freelancer for review</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle mt-1 mr-2 text-blue-600"></i>
                                            <span>The freelancer will accept or decline within 24-48 hours</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle mt-1 mr-2 text-blue-600"></i>
                                            <span>You can track your order status in the Orders section</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle mt-1 mr-2 text-blue-600"></i>
                                            <span>Payment will be processed after order acceptance</span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Action Buttons -->
                                <div class="pt-8 flex items-center justify-between border-t border-zinc-100 dark:border-zinc-800">
                                    <a href="{{ route('services.show', $service) }}" class="px-8 py-3 text-base font-semibold text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-colors rounded-xl">
                                        <i class="fas fa-arrow-left mr-2"></i>
                                        Back to Service
                                    </a>
                                    <button type="submit" class="px-10 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-base font-bold rounded-2xl shadow-lg hover:scale-[1.03] hover:shadow-xl transition-transform active:scale-100">
                                        <i class="fas fa-shopping-cart mr-2"></i>
                                        Confirm & Place Order
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Order Summary - Right Side (1/3) -->
                <div class="lg:col-span-1">
                    <div class="bg-white/90 dark:bg-zinc-900/90 overflow-hidden shadow-2xl rounded-3xl border border-zinc-200 dark:border-zinc-800 sticky top-8">
                        <div class="px-8 py-6 border-b border-zinc-100 dark:border-zinc-800 bg-gradient-to-r from-indigo-600 to-purple-600">
                            <h3 class="text-xl font-bold text-white">Order Summary</h3>
                        </div>

                        <div class="p-8 space-y-6">
                            <!-- Service Info -->
                            <div>
                                <h4 class="text-lg font-bold text-zinc-900 dark:text-white mb-2">{{ $service->title }}</h4>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400 line-clamp-3">{{ $service->description }}</p>
                            </div>

                            <!-- Category Badge -->
                            <div>
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300">
                                    <i class="fas fa-tag mr-2"></i>
                                    {{ $service->category }}
                                </span>
                            </div>

                            <!-- Freelancer Info -->
                            <div class="border-t border-zinc-200 dark:border-zinc-800 pt-6">
                                <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-2">Freelancer</p>
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-zinc-900 dark:text-white">{{ $service->freelancer->name }}</p>
                                        <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $service->freelancer->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Price Breakdown -->
                            <div class="border-t border-zinc-200 dark:border-zinc-800 pt-6 space-y-3">
                                <div class="flex justify-between text-base">
                                    <span class="text-zinc-600 dark:text-zinc-400">Service Price</span>
                                    <span class="font-semibold text-zinc-900 dark:text-white">${{ number_format($service->price, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-base">
                                    <span class="text-zinc-600 dark:text-zinc-400">Platform Fee</span>
                                    <span class="font-semibold text-zinc-900 dark:text-white">$0.00</span>
                                </div>
                                <div class="border-t border-zinc-200 dark:border-zinc-800 pt-3 flex justify-between items-center">
                                    <span class="text-lg font-bold text-zinc-900 dark:text-white">Total Amount</span>
                                    <span class="text-3xl font-black text-green-600 dark:text-green-400">${{ number_format($service->price, 2) }}</span>
                                </div>
                            </div>

                            <!-- Trust Badges -->
                            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-900 rounded-xl p-4">
                                <div class="flex items-center text-green-800 dark:text-green-300 mb-2">
                                    <i class="fas fa-shield-alt mr-2"></i>
                                    <span class="font-semibold text-sm">Secure Payment</span>
                                </div>
                                <p class="text-xs text-green-700 dark:text-green-400">
                                    Your payment is protected until the work is completed and approved.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
