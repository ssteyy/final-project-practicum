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

                    <!-- Review Section (Only for Clients on Completed Orders) -->
                    @if (Auth::user()->role === \App\Models\User::ROLE_CLIENT && $order->client_id === Auth::id() && $order->status === 'completed')
                        <div id="review-section" class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                            @if($order->review)
                                <!-- Display Existing Review -->
                                <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-2xl p-6 border-2 border-green-200 dark:border-green-800">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                                            <svg class="w-7 h-7 mr-3 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            Your Review
                                        </h3>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">Submitted {{ $order->review->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="flex items-center mb-3">
                                        <div class="flex space-x-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-6 h-6 {{ $i <= $order->review->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @endfor
                                        </div>
                                        <span class="ml-2 text-lg font-bold text-gray-900 dark:text-white">{{ $order->review->rating }}/5</span>
                                    </div>
                                    @if($order->review->review)
                                        <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ $order->review->review }}</p>
                                    @endif
                                </div>
                            @else
                                <!-- Review Form -->
                                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-2xl p-6 border-2 border-indigo-200 dark:border-indigo-800">
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                                        <svg class="w-7 h-7 mr-3 text-indigo-600 dark:text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        Rate Your Experience
                                    </h3>
                                    <p class="text-gray-600 dark:text-gray-400 mb-6">Share your feedback about working with {{ $order->freelancer->name }}</p>

                                    <form method="POST" action="{{ route('reviews.store', $order) }}">
                                        @csrf

                                        <div class="mb-6">
                                            <x-input-label for="rating" :value="__('Rating')" class="mb-2" />
                                            <div class="flex items-center space-x-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <label class="cursor-pointer">
                                                        <input type="radio" name="rating" value="{{ $i }}" class="sr-only peer" required>
                                                        <svg class="w-10 h-10 text-gray-300 dark:text-gray-600 peer-checked:text-yellow-400 hover:text-yellow-300 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                    </label>
                                                @endfor
                                            </div>
                                            <x-input-error :messages="$errors->get('rating')" class="mt-2" />
                                        </div>

                                        <div class="mb-6">
                                            <x-input-label for="review" :value="__('Review (Optional)')" />
                                            <textarea id="review" name="review" rows="4"
                                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                                placeholder="Share your experience working with this freelancer...">{{ old('review') }}</textarea>
                                            <x-input-error :messages="$errors->get('review')" class="mt-2" />
                                        </div>

                                        <x-primary-button class="w-full justify-center">
                                            {{ __('Submit Review') }}
                                        </x-primary-button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
