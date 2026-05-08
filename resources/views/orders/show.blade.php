<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Service Image Banner -->
                @if($order->service->image_path || $order->service->image_url)
                <div class="w-full h-64 overflow-hidden bg-gray-100 dark:bg-gray-700">
                    @if($order->service->image_path)
                        <img src="{{ asset('storage/' . $order->service->image_path) }}" alt="{{ $order->service->title }}" class="w-full h-full object-cover">
                    @elseif($order->service->image_url)
                        <img src="{{ $order->service->image_url }}" alt="{{ $order->service->title }}" class="w-full h-full object-cover">
                    @endif
                </div>
                @endif

                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between items-start mb-6 border-b pb-4">
                        <div>
                            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-1">Order #{{ $order->id }}</h1>
                            <p class="text-lg text-gray-600 dark:text-gray-400">Service: <a href="{{ route('services.show', $order->service) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline font-semibold">{{ $order->service->title }}</a></p>
                        </div>
                        <div class="text-right">
                            @php
                                $serviceFee = $order->service->price;
                                $platformFee = $serviceFee * 0.15;
                                $totalAmount = $serviceFee + $platformFee;
                            @endphp
                            <div class="space-y-1">
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium">Service Fee:</span> ${{ number_format($serviceFee, 2) }}
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium">Platform Fee (15%):</span> ${{ number_format($platformFee, 2) }}
                                </div>
                                <div class="border-t border-gray-300 dark:border-gray-600 pt-1">
                                    <span class="text-4xl font-black text-emerald-600 dark:text-emerald-400">${{ number_format($totalAmount, 2) }}</span>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Amount</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400">Client</p>
                            <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $order->client->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400">Freelancer</p>
                            <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $order->freelancer->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400">Order Date</p>
                            <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400">Status</p>
                            <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $order->status === 'completed' ? 'bg-green-200 text-green-800' : ($order->status === 'pending' ? 'bg-yellow-200 text-yellow-800' : 'bg-blue-200 text-blue-800') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Chat Button Section -->
                    <div class="mt-6 p-6 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-700 dark:to-gray-800 rounded-2xl border-2 border-indigo-200 dark:border-indigo-800">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-14 h-14 bg-indigo-600 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Need to Discuss?</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        Chat with
                                        @if(Auth::id() === $order->client_id)
                                            <span class="font-semibold text-indigo-600 dark:text-indigo-400">{{ $order->freelancer->name }}</span> (Freelancer)
                                        @else
                                            <span class="font-semibold text-indigo-600 dark:text-indigo-400">{{ $order->client->name }}</span> (Client)
                                        @endif
                                        about this order
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('chat.show', $order) }}"
                               class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-wider hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                Start Chat
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Order Summary Section -->
                    <div class="mt-6 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 rounded-2xl p-6 border-2 border-gray-200 dark:border-gray-700">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                            <svg class="w-7 h-7 mr-3 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Order Summary
                        </h3>

                        <div class="space-y-4">
                            <!-- Service Info -->
                            <div class="flex justify-between items-center py-3 border-b border-gray-300 dark:border-gray-600">
                                <span class="text-sm font-semibold text-gray-600 dark:text-gray-400">Service</span>
                                <span class="text-base font-bold text-gray-900 dark:text-white">{{ $order->service->title }}</span>
                            </div>

                            <!-- Freelancer Info -->
                            <div class="flex justify-between items-center py-3 border-b border-gray-300 dark:border-gray-600">
                                <span class="text-sm font-semibold text-gray-600 dark:text-gray-400">Freelancer</span>
                                <span class="text-base font-bold text-gray-900 dark:text-white">{{ $order->freelancer->name }}</span>
                            </div>

                            <!-- Category Info -->
                            <div class="flex justify-between items-center py-3 border-b border-gray-300 dark:border-gray-600">
                                <span class="text-sm font-semibold text-gray-600 dark:text-gray-400">Category</span>
                                <span class="text-base font-bold text-gray-900 dark:text-white">{{ $order->service->category }}</span>
                            </div>

                            <!-- Pricing Type -->
                            <div class="flex justify-between items-center py-3 border-b border-gray-300 dark:border-gray-600">
                                <span class="text-sm font-semibold text-gray-600 dark:text-gray-400">Pricing Type</span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase
                                    {{ $order->service->pricing_type === 'hourly' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300' :
                                       ($order->service->pricing_type === 'project' ? 'bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-300' :
                                       'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300') }}">
                                    {{ $order->service->pricing_type === 'hourly' ? '🕐 Hourly' : ($order->service->pricing_type === 'project' ? '📋 Project' : '💰 Fixed') }}
                                </span>
                            </div>

                            <!-- Service Fee -->
                            <div class="flex justify-between items-center py-3 border-b border-gray-300 dark:border-gray-600">
                                <span class="text-sm font-semibold text-gray-600 dark:text-gray-400">Service Fee</span>
                                <span class="text-lg font-bold text-gray-900 dark:text-white">${{ number_format($serviceFee, 2) }}</span>
                            </div>

                            <!-- Platform Fee -->
                            <div class="flex justify-between items-center py-3 border-b border-gray-300 dark:border-gray-600">
                                <span class="text-sm font-semibold text-gray-600 dark:text-gray-400">Platform Fee (15%)</span>
                                <span class="text-lg font-bold text-indigo-600 dark:text-indigo-400">${{ number_format($platformFee, 2) }}</span>
                            </div>

                            <!-- Total Amount -->
                            <div class="flex justify-between items-center py-4 bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 rounded-xl px-4 mt-2">
                                <span class="text-lg font-bold text-gray-900 dark:text-white">Total Amount</span>
                                <span class="text-3xl font-black text-emerald-600 dark:text-emerald-400">${{ number_format($totalAmount, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">Client Requirements</h3>
                        <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">{{ $order->requirements ?? 'No specific requirements provided.' }}</p>
                    </div>

                    @if (Auth::user()->role === \App\Models\User::ROLE_FREELANCER && $order->freelancer_id === Auth::id())
                        <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Update Order Status</h3>
                            <form method="POST" action="{{ route('orders.update', $order) }}">
                                @csrf
                                @method('PUT')

                                <div class="flex items-end space-x-4">
                                    <div class="flex-grow">
                                        <x-input-label for="status" :value="__('New Status')" />
                                        <select id="status" name="status" class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                            <option value="accepted" {{ $order->status == 'accepted' ? 'selected' : '' }} {{ $order->status == 'pending' ? '' : 'disabled' }}>Accepted</option>
                                            <option value="in progress" {{ $order->status == 'in progress' ? 'selected' : '' }} {{ $order->status == 'pending' || $order->status == 'accepted' ? '' : 'disabled' }}>In Progress</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }} {{ $order->status == 'in progress' ? '' : 'disabled' }}>Completed</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }} disabled>Cancelled (Client Only)</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                    </div>
                                    <x-primary-button>
                                        {{ __('Update Status') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    @endif

                    <!-- Enhanced Review Section -->
                    @if (Auth::user()->role === \App\Models\User::ROLE_CLIENT && $order->client_id === Auth::id() && $order->status === 'completed')
                        <div id="review-section" class="mt-12 relative">
                            <!-- Decorative Background -->
                            <div class="absolute -inset-4 bg-gradient-to-r from-amber-100/30 via-yellow-100/30 to-orange-100/30 dark:from-amber-900/10 dark:via-yellow-900/10 dark:to-orange-900/10 rounded-3xl blur-xl -z-10"></div>

                            @if($order->review)
                                <!-- Enhanced Existing Review Display -->
                                <div class="relative bg-gradient-to-br from-emerald-50 via-green-50 to-teal-50 dark:from-emerald-900/20 dark:via-green-900/20 dark:to-teal-900/20 rounded-3xl border-2 border-emerald-200/60 dark:border-emerald-700/60 shadow-xl overflow-hidden backdrop-blur-sm">
                                    <!-- Header Section -->
                                    <div class="bg-gradient-to-r from-emerald-600 to-green-600 dark:from-emerald-700 dark:to-green-700 px-8 py-6">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-4">
                                                <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                                                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h3 class="text-2xl font-bold text-white">Your Review</h3>
                                                    <p class="text-emerald-100 text-sm">Thank you for your feedback!</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <span class="text-sm text-emerald-100">{{ $order->review->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Content Section -->
                                    <!-- Modern Premium Rating Section -->
<div class="px-8 py-10">
    <!-- Header -->
    <div class="text-center mb-10">
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-r from-yellow-400 via-orange-400 to-pink-500 shadow-2xl mb-5">
            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
        </div>

        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">
            Rate Your Experience
        </h2>

        <p class="text-gray-600 dark:text-gray-400 text-lg max-w-2xl mx-auto">
            How was your experience working with
            <span class="font-bold text-indigo-600 dark:text-indigo-400">
                {{ $order->freelancer->name }}
            </span>?
        </p>
    </div>

    <form method="POST" action="{{ route('reviews.store', $order) }}" class="space-y-10">
        @csrf

        <!-- Rating Card -->
        <div class="max-w-3xl mx-auto">
            <div class="relative overflow-hidden rounded-3xl border border-white/20 dark:border-gray-700/50 bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl shadow-[0_20px_60px_-15px_rgba(0,0,0,0.25)]">

                <!-- Background Glow -->
                <div class="absolute inset-0 bg-gradient-to-br from-yellow-100/40 via-pink-100/20 to-indigo-100/30 dark:from-yellow-500/10 dark:via-pink-500/5 dark:to-indigo-500/10"></div>

                <div class="relative p-10">

                    <!-- Label -->
                    <div class="text-center mb-8">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                            Select Your Rating
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Click the stars to rate your experience
                        </p>
                    </div>

                    <!-- Stars -->
                    <div class="flex items-center justify-center gap-4 mb-8">
                        @for($i = 1; $i <= 5; $i++)
                            <label class="cursor-pointer group relative">
                                <input
                                    type="radio"
                                    name="rating"
                                    value="{{ $i }}"
                                    class="sr-only peer"
                                    required
                                >

                                <!-- Glow Effect -->
                                <div class="absolute inset-0 rounded-full bg-yellow-400/20 blur-xl opacity-0 peer-checked:opacity-100 group-hover:opacity-70 transition duration-300"></div>

                                <!-- Star -->
                                <div class="relative transition-all duration-300 transform group-hover:scale-125 peer-checked:scale-125">
                                    <svg
                                        class="w-16 h-16 text-gray-300 dark:text-gray-600 peer-checked:text-yellow-400 group-hover:text-yellow-300 drop-shadow-lg transition-all duration-300"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                    >
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </div>
                            </label>
                        @endfor
                    </div>

                    <!-- Rating Display -->
                    <div class="text-center mb-6">
                        <div
                            id="rating-display"
                            class="text-4xl font-black bg-gradient-to-r from-yellow-500 via-orange-500 to-pink-500 bg-clip-text text-transparent transition-all duration-300"
                        >
                            Select a rating
                        </div>

                        <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Your feedback helps improve the platform
                        </div>
                    </div>

                    <!-- Rating Labels -->
                    <div class="grid grid-cols-5 gap-3 text-center mt-8">
                        <div class="bg-red-50 dark:bg-red-500/10 rounded-xl py-3">
                            <p class="text-xs font-semibold text-red-500">Poor</p>
                        </div>

                        <div class="bg-orange-50 dark:bg-orange-500/10 rounded-xl py-3">
                            <p class="text-xs font-semibold text-orange-500">Fair</p>
                        </div>

                        <div class="bg-yellow-50 dark:bg-yellow-500/10 rounded-xl py-3">
                            <p class="text-xs font-semibold text-yellow-500">Good</p>
                        </div>

                        <div class="bg-lime-50 dark:bg-lime-500/10 rounded-xl py-3">
                            <p class="text-xs font-semibold text-lime-500">Great</p>
                        </div>

                        <div class="bg-green-50 dark:bg-green-500/10 rounded-xl py-3">
                            <p class="text-xs font-semibold text-green-500">Excellent</p>
                        </div>
                    </div>

                    <x-input-error :messages="$errors->get('rating')" class="mt-5 text-center" />
                </div>
            </div>
        </div>

        <!-- Review Text -->
        <div class="max-w-3xl mx-auto">
            <label for="review" class="flex items-center text-lg font-semibold text-gray-900 dark:text-white mb-4">
                <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 10h.01M12 10h.01M16 10h.01M9 16h6M7 20h10a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>

                Share Your Thoughts
            </label>

            <div class="relative">
                <textarea
                    id="review"
                    name="review"
                    rows="6"
                    class="w-full rounded-3xl border border-gray-200 dark:border-gray-700 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md px-6 py-5 text-gray-900 dark:text-white shadow-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all duration-300 resize-none"
                    placeholder="Tell others about your experience working with this freelancer..."
                >{{ old('review') }}</textarea>

                <div class="absolute bottom-4 right-5 text-sm text-gray-500 dark:text-gray-400">
                    <span id="char-count">0</span>/500
                </div>
            </div>

            <x-input-error :messages="$errors->get('review')" class="mt-3" />
        </div>

        <!-- Submit -->
        <div class="text-center pt-2">
            <button
                type="submit"
                class="group relative inline-flex items-center overflow-hidden rounded-2xl bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 px-10 py-5 text-lg font-bold text-white shadow-2xl transition-all duration-300 hover:scale-105 hover:shadow-[0_20px_50px_-10px_rgba(99,102,241,0.5)]"
            >
                <span class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition duration-300"></span>

                <svg class="relative w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 13l4 4L19 7"/>
                </svg>

                <span class="relative">
                    Submit Review
                </span>
            </button>
        </div>
    </form>
</div>
                                </div>
                            @else
                                <!-- Enhanced Review Form -->
                                <div class="relative bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-indigo-900/20 dark:via-purple-900/20 dark:to-pink-900/20 rounded-3xl border-2 border-indigo-200/60 dark:border-indigo-700/60 shadow-2xl overflow-hidden backdrop-blur-sm">
                                    <!-- Header Section -->
                                    <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 dark:from-indigo-700 dark:via-purple-700 dark:to-pink-700 px-8 py-6">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                                                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-2xl font-bold text-white">Rate Your Experience</h3>
                                                <p class="text-indigo-100 text-sm">Help others by sharing your feedback</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form Content -->
                                    <div class="px-8 py-8">
                                        <div class="text-center mb-8">
                                            <p class="text-gray-600 dark:text-gray-400 text-lg">How was your experience working with <span class="font-semibold text-indigo-600 dark:text-indigo-400">{{ $order->freelancer->name }}</span>?</p>
                                        </div>

                                        <form method="POST" action="{{ route('reviews.store', $order) }}" class="space-y-8">
                                            @csrf

                                            <!-- Enhanced Star Rating Input -->
                                            <div class="text-center">
                                                <label class="block text-lg font-semibold text-gray-900 dark:text-white mb-6">
                                                    Select Your Rating
                                                </label>
                                                <div class="flex justify-center">
                                                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl px-8 py-6 shadow-xl border border-white/30 dark:border-gray-700/50">
                                                        <div class="flex items-center justify-center space-x-3 mb-4">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <label class="cursor-pointer group relative">
                                                                    <input type="radio" name="rating" value="{{ $i }}" class="sr-only peer" required>
                                                                    <div class="relative">
                                                                        <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 peer-checked:text-yellow-400 group-hover:text-yellow-300 transition-all duration-300 peer-checked:scale-110 group-hover:scale-105" fill="currentColor" viewBox="0 0 20 20">
                                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                                        </svg>
                                                                        @if(old('rating') >= $i)
                                                                            <div class="absolute inset-0 animate-pulse">
                                                                                <svg class="w-12 h-12 text-yellow-300 opacity-60" fill="currentColor" viewBox="0 0 20 20">
                                                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                                                </svg>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </label>
                                                            @endfor
                                                        </div>
                                                        <div class="text-center">
                                                            <div class="text-2xl font-bold text-gray-900 dark:text-white" id="rating-display">Select a rating</div>
                                                            <div class="text-sm text-gray-600 dark:text-gray-400">Hover and click to rate</div>
                                                        </div>
                                                        <x-input-error :messages="$errors->get('rating')" class="mt-3" />
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Review Text Input -->
                                            <div>
                                                <label for="review" class="block text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                                                    <svg class="w-5 h-5 mr-2 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                    </svg>
                                                    Share Your Thoughts (Optional)
                                                </label>
                                                <div class="relative">
                                                    <textarea id="review" name="review" rows="5"
                                                        class="w-full px-6 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-2xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 resize-none shadow-lg"
                                                        placeholder="Tell others about your experience working with this freelancer. What did you like? What could be improved?">{{ old('review') }}</textarea>
                                                    <div class="absolute bottom-3 right-3 text-xs text-gray-500 dark:text-gray-400">
                                                        <span id="char-count">0</span>/500
                                                    </div>
                                                </div>
                                                <x-input-error :messages="$errors->get('review')" class="mt-3" />
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="text-center pt-4">
                                                <button type="submit"
                                                    class="inline-flex items-center px-12 py-4 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 text-white font-bold text-lg rounded-2xl shadow-2xl hover:shadow-3xl transform hover:-translate-y-1 transition-all duration-300">
                                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                                    </svg>
                                                    Submit Your Review
                                                    <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Review Form JavaScript -->
    @if (Auth::user()->role === \App\Models\User::ROLE_CLIENT && $order->client_id === Auth::id() && $order->status === 'completed' && !$order->review)
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        // Get all star labels
        const starLabels = document.querySelectorAll('label.cursor-pointer');
        const stars = document.querySelectorAll('input[name="rating"]');

        const ratingDisplay = document.getElementById('rating-display');

        // Rating text
        const ratingTexts = {
            1: '1 Star - Poor',
            2: '2 Stars - Fair',
            3: '3 Stars - Good',
            4: '4 Stars - Great',
            5: '5 Stars - Excellent'
        };

        /**
         * Update star colors
         */
        function updateStars(rating) {

            starLabels.forEach((label, index) => {

                const svg = label.querySelector('svg');

                // Remove all color classes
                svg.classList.remove(
                    'text-yellow-400',
                    'text-yellow-300',
                    'text-gray-300',
                    'dark:text-gray-600',
                    'scale-110'
                );

                // Active stars
                if ((index + 1) <= rating) {

                    svg.classList.add(
                        'text-yellow-400',
                        'scale-110'
                    );

                } else {

                    // Inactive stars
                    svg.classList.add(
                        'text-gray-300',
                        'dark:text-gray-600'
                    );
                }
            });
        }

        /**
         * Hover preview
         */
        starLabels.forEach((label, index) => {

            const input = label.querySelector('input');

            // Hover
            label.addEventListener('mouseenter', function () {

                const hoverRating = index + 1;

                // Update preview stars
                starLabels.forEach((item, i) => {

                    const svg = item.querySelector('svg');

                    svg.classList.remove(
                        'text-yellow-400',
                        'text-gray-300',
                        'dark:text-gray-600'
                    );

                    if ((i + 1) <= hoverRating) {

                        svg.classList.add('text-yellow-300');

                    } else {

                        svg.classList.add(
                            'text-gray-300',
                            'dark:text-gray-600'
                        );
                    }
                });

                // Update text
                ratingDisplay.textContent = ratingTexts[hoverRating];
            });

            // Click / Select
            input.addEventListener('change', function () {

                const selectedRating = parseInt(this.value);

                updateStars(selectedRating);

                ratingDisplay.textContent = ratingTexts[selectedRating];

                // Animation
                ratingDisplay.classList.add('animate-pulse');

                setTimeout(() => {
                    ratingDisplay.classList.remove('animate-pulse');
                }, 500);
            });
        });

        /**
         * Reset hover state
         */
        const starContainer = document.querySelector('.flex.items-center.justify-center.gap-4')
            || document.querySelector('.flex.items-center.justify-center.space-x-3');

        if (starContainer) {

            starContainer.addEventListener('mouseleave', function () {

                const checkedStar = document.querySelector('input[name="rating"]:checked');

                if (checkedStar) {

                    const selectedRating = parseInt(checkedStar.value);

                    updateStars(selectedRating);

                    ratingDisplay.textContent = ratingTexts[selectedRating];

                } else {

                    // Reset all
                    starLabels.forEach((label) => {

                        const svg = label.querySelector('svg');

                        svg.classList.remove(
                            'text-yellow-400',
                            'text-yellow-300',
                            'scale-110'
                        );

                        svg.classList.add(
                            'text-gray-300',
                            'dark:text-gray-600'
                        );
                    });

                    ratingDisplay.textContent = 'Select a rating';
                }
            });
        }

        /**
         * Character count
         */
        const textarea = document.getElementById('review');
        const charCount = document.getElementById('char-count');

        if (textarea && charCount) {

            // Initialize count
            charCount.textContent = textarea.value.length;

            textarea.addEventListener('input', function () {

                const count = this.value.length;

                charCount.textContent = count;

                if (count > 450) {

                    charCount.classList.add('text-red-500');

                    charCount.classList.remove(
                        'text-gray-500',
                        'dark:text-gray-400'
                    );

                } else {

                    charCount.classList.remove('text-red-500');

                    charCount.classList.add(
                        'text-gray-500',
                        'dark:text-gray-400'
                    );
                }
            });
        }

        /**
         * Initialize old selected value
         */
        const checkedStar = document.querySelector('input[name="rating"]:checked');

        if (checkedStar) {

            const selectedRating = parseInt(checkedStar.value);

            updateStars(selectedRating);

            ratingDisplay.textContent = ratingTexts[selectedRating];
        }
    });
    </script>
    @endif
</x-app-layout>
