<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Place Order') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 via-indigo-50/20 to-purple-50/20 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-200 dark:border-gray-700">

                <!-- Service Preview Section -->
                <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 p-8">
                    <div class="flex items-center gap-6">
                        <!-- Service Image -->
                        <div class="flex-shrink-0">
                            @if($service->image_path || $service->image_url)
                                <div class="w-32 h-32 rounded-2xl overflow-hidden shadow-2xl border-4 border-white/30">
                                    @if($service->image_path)
                                        <img src="{{ asset('storage/' . $service->image_path) }}" alt="{{ $service->title }}" class="w-full h-full object-cover">
                                    @elseif($service->image_url)
                                        <img src="{{ $service->image_url }}" alt="{{ $service->title }}" class="w-full h-full object-cover">
                                    @endif
                                </div>
                            @else
                                <div class="w-32 h-32 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-2xl border-4 border-white/30">
                                    <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </div>

                        <!-- Service Info -->
                        <div class="flex-1 text-white">
                            <h3 class="text-2xl font-bold mb-2">{{ $service->title }}</h3>
                            <div class="flex items-center space-x-3 mb-3">
                                @if($service->freelancer->profile_picture)
                                    <img src="{{ asset('storage/' . $service->freelancer->profile_picture) }}" alt="{{ $service->freelancer->name }}" class="w-8 h-8 rounded-full object-cover border-2 border-white/50">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white text-sm font-bold border-2 border-white/50">
                                        {{ substr($service->freelancer->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <span class="text-white/90 font-medium block">{{ $service->freelancer->name }}</span>
                                    @if($service->freelancer->reviewsReceived->count() > 0)
                                        <div class="flex items-center mt-0.5">
                                            <svg class="w-3.5 h-3.5 text-yellow-300 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <span class="text-sm font-bold text-white">{{ number_format($service->freelancer->averageRating(), 1) }}</span>
                                            <span class="text-xs text-white/70 ml-1">({{ $service->freelancer->reviewsReceived->count() }})</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-3 flex-wrap">
                                <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-xl border border-white/30">
                                    <span class="text-sm font-semibold text-white/80 mr-2">Service Price:</span>
                                    <span class="text-2xl font-black text-white">${{ number_format($service->price, 2) }}</span>
                                </div>
                                <div class="inline-flex items-center px-4 py-2 bg-white/30 backdrop-blur-sm rounded-xl border border-white/40">
                                    <span class="text-sm font-semibold text-white/80 mr-2">Pricing Type:</span>
                                    <span class="text-base font-bold text-white">
                                        {{ $service->pricing_type === 'hourly' ? '🕐 Hourly' : ($service->pricing_type === 'project' ? '📋 Project' : '💰 Fixed') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Form -->
                <div class="p-8 lg:p-10">
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2 flex items-center">
                            <svg class="w-7 h-7 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Order Details
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400">Please provide detailed requirements for your order</p>
                    </div>

                    <form method="POST" action="{{ route('orders.store') }}" class="space-y-6">
                        @csrf
                        <input type="hidden" name="service_id" value="{{ $service->id }}">

                        <!-- Requirements -->
                        <div class="bg-gray-50 dark:bg-gray-700/30 rounded-2xl p-6 border-2 border-dashed border-gray-300 dark:border-gray-600">
                            <x-input-label for="requirements" class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                                <svg class="w-5 h-5 inline mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                {{ __('Your Requirements') }}
                            </x-input-label>
                            <textarea id="requirements" name="requirements" rows="8" class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm" required placeholder="Please describe your project requirements in detail...&#10;&#10;Include:&#10;- Specific deliverables&#10;- Timeline expectations&#10;- Any special instructions&#10;- File formats needed">{{ old('requirements') }}</textarea>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Be as specific as possible to help the freelancer understand your needs</p>
                            <x-input-error :messages="$errors->get('requirements')" class="mt-2" />
                        </div>

                        <!-- Order Summary -->
                        <div class="bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-gray-700 dark:to-gray-800 rounded-2xl p-6 border-2 border-indigo-200 dark:border-indigo-800">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                Order Summary
                            </h3>
                            @php
                                $serviceFee = $service->price;
                                $platformFee = $serviceFee * 0.15;
                                $totalAmount = $serviceFee + $platformFee;
                            @endphp
                            <div class="space-y-3">
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-700 dark:text-gray-300 font-medium">Service</span>
                                    <span class="text-gray-900 dark:text-white font-bold">{{ $service->title }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-700 dark:text-gray-300 font-medium">Freelancer</span>
                                    <span class="text-gray-900 dark:text-white font-bold">{{ $service->freelancer->name }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-700 dark:text-gray-300 font-medium">Category</span>
                                    <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-lg bg-indigo-100 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300">{{ $service->category }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-700 dark:text-gray-300 font-medium">Pricing Type</span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase
                                        {{ $service->pricing_type === 'hourly' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300' :
                                           ($service->pricing_type === 'project' ? 'bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-300' :
                                           'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300') }}">
                                        {{ $service->pricing_type === 'hourly' ? '🕐 Hourly' : ($service->pricing_type === 'project' ? '📋 Project' : '💰 Fixed') }}
                                    </span>
                                </div>

                                <div class="border-t-2 border-indigo-200 dark:border-indigo-800 pt-3 mt-3 space-y-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700 dark:text-gray-300 font-medium">Service Fee</span>
                                        <span class="text-lg font-bold text-gray-900 dark:text-white">${{ number_format($serviceFee, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700 dark:text-gray-300 font-medium">Platform Fee (15%)</span>
                                        <span class="text-lg font-bold text-indigo-600 dark:text-indigo-400">${{ number_format($platformFee, 2) }}</span>
                                    </div>
                                </div>

                                <div class="pt-3 border-t-2 border-indigo-300 dark:border-indigo-700 flex justify-between items-center bg-white/50 dark:bg-gray-900/30 rounded-xl p-3">
                                    <span class="text-lg font-bold text-gray-900 dark:text-white">Total Amount</span>
                                    <span class="text-3xl font-black text-emerald-600 dark:text-emerald-400">${{ number_format($totalAmount, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('services.show', $service) }}" class="inline-flex items-center px-6 py-3 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-xl font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                Back to Service
                            </a>
                            <button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-xl font-bold text-base text-white uppercase tracking-wider hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                {{ __('Confirm Order') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
