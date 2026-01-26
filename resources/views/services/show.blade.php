<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-zinc-900 dark:text-white leading-tight tracking-tight">
            {{ $service->title }}
        </h2>
    </x-slot>
    <div class="py-12 bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:from-zinc-950 dark:via-zinc-900 dark:to-zinc-950 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-200">
                @if($service->image_path || $service->image_url)
                    <img src="{{ $service->image_path ? asset('storage/' . $service->image_path) : $service->image_url }}"
                         alt="{{ $service->title }}"
                         class="w-full h-96 object-cover">
                @endif
                <div class="p-10 bg-white border-b border-gray-200">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                        <div>
                            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">{{ $service->title }}</h1>
                            <p class="text-lg text-gray-600 mb-4">
                                By <span class="font-semibold text-indigo-600">{{ $service->freelancer->name }}</span>
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="text-5xl font-black text-green-600">${{ number_format($service->price, 2) }}</span>
                            <p class="text-sm text-gray-500">One-time fee</p>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-2">Description</h3>
                        <p class="text-gray-700 whitespace-pre-wrap text-lg">{{ $service->description }}</p>
                    </div>
                    <div class="mt-8 border-t border-gray-200 pt-8 flex flex-col md:flex-row justify-between items-center gap-6">
                        <span class="px-4 py-2 text-base font-semibold rounded-full bg-indigo-100 text-indigo-800">
                            Category: {{ $service->category }}
                        </span>
                        @if (Auth::check() && Auth::user()->role === \App\Models\User::ROLE_CLIENT)
                            <a href="{{ route('orders.create', $service) }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-xl font-bold text-lg text-white uppercase tracking-widest hover:scale-105 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all">
                                {{ __('Place Order') }}
                            </a>
                        @elseif (Auth::check() && Auth::user()->role === \App\Models\User::ROLE_FREELANCER && $service->freelancer_id === Auth::id())
                            <span class="px-4 py-2 text-base font-semibold rounded-full {{ $service->status === 'published' ? 'bg-green-200 text-green-800' : ($service->status === 'draft' ? 'bg-yellow-200 text-yellow-800' : 'bg-red-200 text-red-800') }}">
                                Status: {{ ucfirst($service->status) }}
                            </span>
                        @else
                            <p class="text-base text-zinc-500 dark:text-zinc-400">Login as a client to place an order.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
