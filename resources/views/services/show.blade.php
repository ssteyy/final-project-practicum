<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $service->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-2">{{ $service->title }}</h1>
                            <p class="text-lg text-gray-600 dark:text-gray-400 mb-4">
                                By <span class="font-semibold text-indigo-600 dark:text-indigo-400">{{ $service->freelancer->name }}</span>
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="text-5xl font-black text-green-600 dark:text-green-400">${{ number_format($service->price, 2) }}</span>
                            <p class="text-sm text-gray-500 dark:text-gray-400">One-time fee</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">Description</h3>
                        <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ $service->description }}</p>
                    </div>

                    <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                        <div class="flex justify-between items-center">
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300">
                                Category: {{ $service->category }}
                            </span>
                            @if (Auth::check() && Auth::user()->role === \App\Models\User::ROLE_CLIENT)
                                <a href="{{ route('orders.create', $service) }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-lg font-bold text-base text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Place Order') }}
                                </a>
                            @elseif (Auth::check() && Auth::user()->role === \App\Models\User::ROLE_FREELANCER && $service->freelancer_id === Auth::id())
                                <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $service->status === 'published' ? 'bg-green-200 text-green-800' : ($service->status === 'draft' ? 'bg-yellow-200 text-yellow-800' : 'bg-red-200 text-red-800') }}">
                                    Status: {{ ucfirst($service->status) }}
                                </span>
                            @else
                                <p class="text-sm text-gray-500 dark:text-gray-400">Login as a client to place an order.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
