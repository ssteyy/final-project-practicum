<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Orders (Freelancer)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('status'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('status') }}</span>
                        </div>
                    @endif

                    <div class="space-y-6">
                        @forelse ($orders as $order)
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg font-semibold mb-1">Order for: <a href="{{ route('services.show', $order->service) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">{{ $order->service->title }}</a></h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Client: {{ $order->client->name }}</p>
                                    <p class="text-xl font-bold text-green-600 dark:text-green-400">${{ number_format($order->amount, 2) }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $order->status === 'completed' ? 'bg-green-200 text-green-800' : ($order->status === 'pending' ? 'bg-yellow-200 text-yellow-800' : 'bg-blue-200 text-blue-800') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                    <div class="mt-2">
                                        <a href="{{ route('orders.show', $order) }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 mr-3">View / Update</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 dark:text-gray-400">You have no incoming orders yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
