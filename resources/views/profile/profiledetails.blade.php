<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Freelancer Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 via-indigo-50/20 to-purple-50/20 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Freelancer Profile Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-200 dark:border-gray-700 mb-8">
                <!-- Cover Background -->
                <div class="h-48 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 relative">
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>

                <!-- Profile Content -->
                <div class="relative px-8 pb-8">
                    <!-- Profile Picture -->
                    <div class="flex flex-col sm:flex-row items-center sm:items-end -mt-20 mb-6">
                        <div class="relative">
                            @if($freelancer->profile_picture)
                                <img src="{{ asset('storage/' . $freelancer->profile_picture) }}"
                                     alt="{{ $freelancer->name }}"
                                     class="w-40 h-40 rounded-full object-cover border-8 border-white dark:border-gray-800 shadow-2xl">
                            @else
                                <div class="w-40 h-40 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-6xl font-bold border-8 border-white dark:border-gray-800 shadow-2xl">
                                    {{ substr($freelancer->name, 0, 1) }}
                                </div>
                            @endif
                            <!-- Online Status Badge -->
                            <div class="absolute bottom-4 right-4 w-6 h-6 bg-emerald-500 rounded-full border-4 border-white dark:border-gray-800"></div>
                        </div>

                        <!-- Name and Role -->
                        <div class="sm:ml-8 mt-4 sm:mt-0 text-center sm:text-left flex-1">
                            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-2">
                                {{ $freelancer->name }}
                            </h1>
                            <div class="flex items-center justify-center sm:justify-start space-x-2 mb-3">
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold uppercase tracking-wider bg-indigo-100 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ ucfirst($freelancer->role) }}
                                </span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 text-lg">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                {{ $freelancer->email }}
                            </p>
                        </div>

                        <!-- Stats Cards -->
                        <div class="mt-6 sm:mt-0 flex gap-4">
                            <div class="bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-gray-700 dark:to-gray-800 rounded-2xl p-4 text-center border-2 border-indigo-200 dark:border-indigo-800 shadow-lg min-w-[120px]">
                                <p class="text-3xl font-black text-indigo-600 dark:text-indigo-400">{{ $services->count() }}</p>
                                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Services</p>
                            </div>
                            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-gray-700 dark:to-gray-800 rounded-2xl p-4 text-center border-2 border-emerald-200 dark:border-emerald-800 shadow-lg min-w-[120px]">
                                <p class="text-3xl font-black text-emerald-600 dark:text-emerald-400">
                                    {{ $freelancer->created_at->diffInMonths(now()) }}+
                                </p>
                                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Months</p>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8 p-6 bg-gray-50 dark:bg-gray-700/30 rounded-2xl">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Member Since</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $freelancer->created_at->format('M Y') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</p>
                                <p class="text-lg font-bold text-emerald-600 dark:text-emerald-400">Active</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Response Time</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-white">Fast</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-200 dark:border-gray-700">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-8 h-8 mr-3 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Services Offered
                        </h2>
                        <span class="px-4 py-2 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 rounded-full text-sm font-bold">
                            {{ $services->count() }} {{ Str::plural('Service', $services->count()) }}
                        </span>
                    </div>

                    @if($services->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($services as $service)
                                <div class="group bg-white dark:bg-gray-700 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-200 dark:border-gray-600 hover:border-indigo-300 dark:hover:border-indigo-600 transform hover:-translate-y-2">
                                    <!-- Service Image -->
                                    <div class="relative h-48 overflow-hidden bg-gradient-to-br from-indigo-400 via-purple-400 to-pink-400">
                                        @if($service->image_path || $service->image_url)
                                            @if($service->image_path)
                                                <img src="{{ asset('storage/' . $service->image_path) }}"
                                                     alt="{{ $service->title }}"
                                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                            @elseif($service->image_url)
                                                <img src="{{ $service->image_url }}"
                                                     alt="{{ $service->title }}"
                                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                            @endif
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-20 h-20 text-white opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <!-- Category Badge -->
                                        <div class="absolute top-3 left-3">
                                            <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-lg bg-white/90 backdrop-blur-sm text-indigo-600 shadow-lg">
                                                {{ $service->category }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Service Content -->
                                    <div class="p-5">
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                            {{ $service->title }}
                                        </h3>

                                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-2">
                                            {{ $service->description }}
                                        </p>

                                        <!-- Price and Action -->
                                        <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-600">
                                            <div>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">Price</p>
                                                <p class="text-2xl font-black text-indigo-600 dark:text-indigo-400">
                                                    ${{ number_format($service->price, 2) }}
                                                </p>
                                            </div>
                                            <a href="{{ route('services.show', $service->id) }}"
                                               class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 shadow-md hover:shadow-lg">
                                                View Details
                                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>

                                        <!-- Posted Time -->
                                        <div class="mt-3 flex items-center text-xs text-gray-500 dark:text-gray-400">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Posted {{ $service->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- No Services Message -->
                        <div class="text-center py-16">
                            <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">No Services Yet</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-lg">This freelancer hasn't published any services yet.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-8 text-center">
                <a href="{{ url()->previous() }}"
                   class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl font-semibold text-sm text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-md hover:shadow-lg hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition ease-in-out duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Previous Page
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
