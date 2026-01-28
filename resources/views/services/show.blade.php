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

                            <!-- View Profile Button -->
                            <div class="mt-4">
                                <a href="{{ route('profile.show', $service->freelancer->id) }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-700 border border-indigo-300 dark:border-indigo-600 rounded-lg font-semibold text-sm text-indigo-600 dark:text-indigo-400 uppercase tracking-widest hover:bg-indigo-50 dark:hover:bg-gray-600 focus:bg-indigo-50 dark:focus:bg-gray-600 active:bg-indigo-100 dark:active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    View Profile
                                </a>
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
                                <button onclick="showOwnServiceModal()" class="block w-full text-center px-6 py-4 bg-gradient-to-r from-amber-500 to-orange-500 border border-transparent rounded-xl font-bold text-base text-white uppercase tracking-wider hover:from-amber-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                    {{ __('Place Order') }}
                                </button>
                                <div class="text-center mt-3">
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

    <!-- Own Service Modal -->
    <div id="ownServiceModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm" aria-hidden="true" onclick="closeOwnServiceModal()"></div>

            <!-- Center modal -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border-4 border-amber-400 dark:border-amber-500">
                <!-- Modal Header with Icon -->
                <div class="bg-gradient-to-br from-amber-500 via-orange-500 to-red-500 px-6 py-8 text-center">
                    <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-white/20 backdrop-blur-sm mb-4 animate-bounce">
                        <svg class="h-12 w-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-black text-white mb-2" id="modal-title">
                        Oops! Can't Order
                    </h3>
                    <p class="text-white/90 font-medium text-lg">
                        This is your own service
                    </p>
                </div>

                <!-- Modal Body -->
                <div class="px-6 py-8">
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-amber-100 dark:bg-amber-900/30 mb-4">
                            <svg class="w-8 h-8 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed mb-4">
                            You cannot place an order on your own service. This service belongs to you!
                        </p>
                        <div class="bg-amber-50 dark:bg-amber-900/20 border-2 border-amber-200 dark:border-amber-800 rounded-2xl p-4 mb-4">
                            <p class="text-sm text-amber-800 dark:text-amber-300 font-semibold mb-2">
                                💡 What you can do instead:
                            </p>
                            <ul class="text-left text-sm text-amber-700 dark:text-amber-400 space-y-2">
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Edit your service details</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Browse other services to order</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Manage your existing orders</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('services.edit', $service) }}" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-wider hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Service
                        </a>
                        <a href="{{ route('services.index') }}" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 rounded-xl font-bold text-sm text-gray-700 dark:text-gray-300 uppercase tracking-wider hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Browse Services
                        </a>
                    </div>
                    <button onclick="closeOwnServiceModal()" class="mt-3 w-full inline-flex items-center justify-center px-6 py-3 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl font-semibold text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showOwnServiceModal() {
            const modal = document.getElementById('ownServiceModal');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeOwnServiceModal() {
            const modal = document.getElementById('ownServiceModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeOwnServiceModal();
            }
        });
    </script>
</x-app-layout>
