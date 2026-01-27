<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 via-indigo-50/30 to-purple-50/30 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome Banner -->
            <div class="relative overflow-hidden bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-3xl p-8 mb-8 shadow-2xl">
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between">
                    <div class="flex items-center space-x-4">
                        @if(Auth::user()->profile_picture)
                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}" class="w-16 h-16 rounded-full object-cover border-4 border-white/30 shadow-lg">
                        @else
                            <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white text-2xl font-bold border-4 border-white/30 shadow-lg">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <h1 class="text-3xl font-black text-white mb-1">
                                Welcome back, {{ Auth::user()->name }}!
                            </h1>
                            <p class="text-white/90 text-lg">
                                @if (Auth::user()->role === \App\Models\User::ROLE_FREELANCER)
                                    You have new opportunities waiting in your services.
                                @else
                                    Ready to find the perfect professional for your next project?
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="mt-6 md:mt-0">
                        <span class="px-5 py-2.5 bg-white/20 backdrop-blur-md rounded-xl text-white font-bold text-sm border border-white/30 uppercase tracking-widest shadow-lg">
                            {{ Auth::user()->role }} Account
                        </span>
                    </div>
                </div>
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-40 h-40 bg-pink-400/20 rounded-full blur-2xl"></div>
                <div class="absolute top-1/2 right-1/4 w-32 h-32 bg-purple-400/10 rounded-full blur-2xl"></div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                @if (Auth::user()->role === \App\Models\User::ROLE_FREELANCER)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Services</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ Auth::user()->services()->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Published</p>
                                <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-1">{{ Auth::user()->services()->where('status', 'published')->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Orders</p>
                                <p class="text-3xl font-bold text-purple-600 dark:text-purple-400 mt-1">{{ Auth::user()->services()->withCount('orders')->get()->sum('orders_count') }}</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">My Orders</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ Auth::user()->orders()->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pending</p>
                                <p class="text-3xl font-bold text-yellow-600 dark:text-yellow-400 mt-1">{{ Auth::user()->orders()->where('status', 'pending')->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Completed</p>
                                <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-1">{{ Auth::user()->orders()->where('status', 'completed')->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Quick Actions -->
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                @if (Auth::user()->role === \App\Models\User::ROLE_FREELANCER)
                    <a href="{{ route('services.index') }}" class="group bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-2xl hover:-translate-y-2 hover:border-indigo-300 dark:hover:border-indigo-600 transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col">
                                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center text-white mb-4 group-hover:scale-110 group-hover:rotate-3 transition-transform shadow-lg">
                                    <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Manage Services</h3>
                                <p class="text-gray-600 dark:text-gray-400">Create, edit, and track your professional offerings.</p>
                            </div>
                            <div class="text-indigo-600 dark:text-indigo-400 opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('orders.index') }}" class="group bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-2xl hover:-translate-y-2 hover:border-emerald-300 dark:hover:border-emerald-600 transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col">
                                <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center text-white mb-4 group-hover:scale-110 group-hover:rotate-3 transition-transform shadow-lg">
                                    <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">View Orders</h3>
                                <p class="text-gray-600 dark:text-gray-400">Check active requests and delivery statuses.</p>
                            </div>
                            <div class="text-emerald-600 dark:text-emerald-400 opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </div>
                        </div>
                    </a>

                @else
                    <a href="{{ route('services.index') }}" class="group bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-2xl hover:-translate-y-2 hover:border-indigo-300 dark:hover:border-indigo-600 transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col">
                                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-2xl flex items-center justify-center text-white mb-4 group-hover:scale-110 group-hover:rotate-3 transition-transform shadow-lg">
                                    <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Browse Services</h3>
                                <p class="text-gray-600 dark:text-gray-400">Explore top-rated services from professional freelancers.</p>
                            </div>
                            <div class="text-indigo-600 dark:text-indigo-400 opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('orders.index') }}" class="group bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-2xl hover:-translate-y-2 hover:border-rose-300 dark:hover:border-rose-600 transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col">
                                <div class="w-16 h-16 bg-gradient-to-br from-rose-500 to-pink-600 rounded-2xl flex items-center justify-center text-white mb-4 group-hover:scale-110 group-hover:rotate-3 transition-transform shadow-lg">
                                    <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Track Orders</h3>
                                <p class="text-gray-600 dark:text-gray-400">Manage your purchases and communicate with freelancers.</p>
                            </div>
                            <div class="text-rose-600 dark:text-rose-400 opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </div>
                        </div>
                    </a>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
