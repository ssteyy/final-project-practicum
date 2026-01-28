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
                            <span class="text-4xl font-black text-emerald-600 dark:text-emerald-400">${{ number_format($order->amount, 2) }}</span>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total Price</p>
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
