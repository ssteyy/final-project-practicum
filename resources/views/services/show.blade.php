<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $service->title }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 via-indigo-50/20 to-purple-50/20 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-200 dark:border-gray-700">

                <!-- Service Image Banner -->
                <div class="w-full h-96 overflow-hidden bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 relative">
                    @if($service->image_path || $service->image_url)
                        @if($service->image_path)
                            <img src="{{ asset('storage/' . $service->image_path) }}" alt="{{ $service->title }}" class="w-full h-full object-cover">
                        @elseif($service->image_url)
                            <img src="{{ $service->image_url }}" alt="{{ $service->title }}" class="w-full h-full object-cover">
                        @endif
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-32 h-32 text-white opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>

                    <!-- Category Badge -->
                    <div class="absolute top-6 left-6">
                        <span class="px-4 py-2 text-sm font-bold uppercase tracking-wider rounded-xl bg-white/90 backdrop-blur-sm text-indigo-600 shadow-lg">
                            {{ $service->category }}
                        </span>
                    </div>
                </div>

                <!-- Service Content -->
                <div class="p-8 lg:p-10">
                    <!-- Header Section -->
                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6 mb-8 pb-8 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex-1">
                            <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 dark:text-white mb-4 leading-tight">
                                {{ $service->title }}
                            </h1>

                            <!-- Freelancer Info -->
                            <div class="flex items-center space-x-3 mb-4">
                                @if($service->freelancer->profile_picture)
                                    <img src="{{ asset('storage/' . $service->freelancer->profile_picture) }}" alt="{{ $service->freelancer->name }}" class="w-12 h-12 rounded-full object-cover border-2 border-indigo-500">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-indigo-500 flex items-center justify-center text-white text-lg font-bold">
                                        {{ substr($service->freelancer->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Offered by</p>
                                    <p class="text-lg font-bold text-indigo-600 dark:text-indigo-400">{{ $service->freelancer->name }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Price Card -->
                        <div class="lg:w-80 bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-gray-700 dark:to-gray-800 rounded-2xl p-6 border-2 border-indigo-200 dark:border-indigo-800 shadow-lg">
                            <div class="text-center mb-4">
                                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider mb-2">Service Price</p>
                                <p class="text-5xl font-black text-indigo-600 dark:text-indigo-400">${{ number_format($service->price, 2) }}</p>
                            </div>

                            @if (Auth::check() && Auth::user()->role === \App\Models\User::ROLE_CLIENT)
                                <a href="{{ route('orders.create') }}?id={{ $service->id }}" class="block w-full text-center px-6 py-4 bg-indigo-600 border border-transparent rounded-xl font-bold text-base text-white uppercase tracking-wider hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                    {{ __('Place Order') }}
                                </a>
                            @elseif (Auth::check() && Auth::user()->role === \App\Models\User::ROLE_FREELANCER && $service->freelancer_id === Auth::id())
                                <div class="text-center">
                                    <span class="inline-flex items-center px-4 py-2 text-sm font-bold rounded-xl uppercase tracking-wider
                                        {{ $service->status === 'published' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300' :
                                           ($service->status === 'draft' ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300' :
                                           'bg-gray-100 text-gray-700 dark:bg-gray-900/40 dark:text-gray-300') }}">
                                        <span class="w-2 h-2 rounded-full mr-2 {{ $service->status === 'published' ? 'bg-emerald-500' : ($service->status === 'draft' ? 'bg-amber-500' : 'bg-gray-500') }}"></span>
                                        {{ $service->status }}
                                    </span>
                                </div>
                            @else
                                <div class="text-center p-4 bg-gray-100 dark:bg-gray-700 rounded-xl">
                                    <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Login as a client to place an order</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Description Section -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Service Description
                        </h3>
                        <div class="prose prose-lg dark:prose-invert max-w-none">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $service->description }}</p>
                        </div>
                    </div>

                    <!-- Service Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 bg-gray-50 dark:bg-gray-700/30 rounded-2xl">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            </div>
                            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Category</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">{{ $service->category }}</p>
                        </div>

                        <div class="text-center">
                            <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Price</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">${{ number_format($service->price, 2) }}</p>
                        </div>

                        <div class="text-center">
                            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Posted</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">{{ $service->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
