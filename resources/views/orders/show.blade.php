<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between items-start mb-6 border-b pb-4">
                        <div>
                            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-1">Order #{{ $order->id }}</h1>
                            <p class="text-lg text-gray-600 dark:text-gray-400">Service: <a href="{{ route('services.show', $order->service) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">{{ $order->service->title }}</a></p>
                        </div>
                        <div class="text-right">
                            <span class="text-4xl font-black text-green-600 dark:text-green-400">${{ number_format($order->amount, 2) }}</span>
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
