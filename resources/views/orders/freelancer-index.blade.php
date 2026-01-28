<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Orders (Freelancer)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div x-data="{ show: true }" x-show="show" x-transition.opacity class="flex items-center p-4 mb-6 text-emerald-800 border-l-4 border-emerald-500 bg-emerald-50 dark:bg-emerald-900/20 dark:text-emerald-400 rounded-r-xl shadow-sm">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span class="text-sm font-medium">{{ session('status') }}</span>
                    <button @click="show = false" class="ml-auto text-emerald-500 hover:text-emerald-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="space-y-4">
                        @forelse ($orders as $order)
                            <div class="group bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-200 dark:border-gray-700 hover:border-emerald-500 dark:hover:border-emerald-400 transition-all duration-300 shadow-sm hover:shadow-md flex items-center gap-5">
                                <!-- Service Image -->
                                <div class="flex-shrink-0">
                                    @if($order->service->image_path || $order->service->image_url)
                                        <div class="w-24 h-24 rounded-xl overflow-hidden shadow-md">
                                            @if($order->service->image_path)
                                                <img src="{{ asset('storage/' . $order->service->image_path) }}" alt="{{ $order->service->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                            @elseif($order->service->image_url)
                                                <img src="{{ $order->service->image_url }}" alt="{{ $order->service->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                            @endif
                                        </div>
                                    @else
                                        <div class="w-24 h-24 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-md">
                                            <svg class="w-12 h-12 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Order Details -->
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold">
                                        <a href="{{ route('services.show', $order->service) }}" class="text-gray-900 dark:text-white hover:text-emerald-600 transition">
                                            {{ $order->service->title }}
                                        </a>
                                    </h3>
                                    <p class="text-sm text-gray-500">Client: <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $order->client->name }}</span></p>
                                    <p class="text-2xl font-black text-emerald-600 dark:text-emerald-400 mt-2">${{ number_format($order->amount, 2) }}</p>
                                </div>

                                <!-- Status and Actions -->
                                <div class="text-right">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-tight
                                        {{ $order->status === 'completed' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300' :
                                           ($order->status === 'pending' ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300' :
                                           ($order->status === 'in progress' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300' :
                                           'bg-gray-100 text-gray-700 dark:bg-gray-900/40 dark:text-gray-300')) }}">
                                        <span class="w-1.5 h-1.5 rounded-full mr-2 {{ $order->status === 'completed' ? 'bg-emerald-500' : ($order->status === 'pending' ? 'bg-amber-500' : ($order->status === 'in progress' ? 'bg-blue-500' : 'bg-gray-500')) }}"></span>
                                        {{ $order->status }}
                                    </span>

                                    <div class="mt-4 flex items-center justify-end space-x-2">
                                        <a href="{{ route('chat.show', $order) }}"
                                           class="inline-flex items-center px-3 py-2 text-sm font-semibold text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition"
                                           title="Chat with {{ $order->client->name }}">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                            </svg>
                                            Chat
                                        </a>
                                        <a href="{{ route('orders.show', $order) }}" class="px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                            View / Update
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-2xl text-gray-500">
                                You have no incoming orders yet.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
