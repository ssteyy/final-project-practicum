<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50 dark:bg-gray-900/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="relative overflow-hidden bg-indigo-600 rounded-3xl p-8 mb-8 shadow-lg shadow-indigo-200 dark:shadow-none">
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-black text-white mb-2">
                            Welcome back, {{ Auth::user()->name }}!
                        </h1>
                        <p class="text-indigo-100 text-lg">
                            @if (Auth::user()->role === \App\Models\User::ROLE_FREELANCER)
                                You have new opportunities waiting in your services.
                            @else
                                Ready to find the perfect professional for your next project?
                            @endif
                        </p>
                    </div>
                    <div class="mt-6 md:mt-0">
                        <span class="px-4 py-2 bg-white/20 backdrop-blur-md rounded-xl text-white font-bold text-sm border border-white/30 uppercase tracking-widest">
                            {{ Auth::user()->role }} Account
                        </span>
                    </div>
                </div>
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-40 h-40 bg-indigo-400/20 rounded-full blur-2xl"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                @if (Auth::user()->role === \App\Models\User::ROLE_FREELANCER)
                    <a href="{{ route('services.index') }}" class="group bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col">
                                <div class="w-14 h-14 bg-indigo-50 dark:bg-indigo-900/30 rounded-2xl flex items-center justify-center text-indigo-600 dark:text-indigo-400 mb-4 group-hover:scale-110 transition-transform">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Manage Services</h3>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">Create, edit, and track your professional offerings.</p>
                            </div>
                            <div class="text-indigo-600 dark:text-indigo-400 opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('orders.index') }}" class="group bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col">
                                <div class="w-14 h-14 bg-emerald-50 dark:bg-emerald-900/30 rounded-2xl flex items-center justify-center text-emerald-600 dark:text-emerald-400 mb-4 group-hover:scale-110 transition-transform">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">View Orders</h3>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">Check active requests and delivery statuses.</p>
                            </div>
                            <div class="text-emerald-600 dark:text-emerald-400 opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </div>
                        </div>
                    </a>

                @else
                    <a href="{{ route('services.index') }}" class="group bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col">
                                <div class="w-14 h-14 bg-indigo-50 dark:bg-indigo-900/30 rounded-2xl flex items-center justify-center text-indigo-600 dark:text-indigo-400 mb-4 group-hover:scale-110 transition-transform">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Browse Services</h3>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">Explore top-rated services from professional freelancers.</p>
                            </div>
                            <div class="text-indigo-600 dark:text-indigo-400 opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('orders.index') }}" class="group bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col">
                                <div class="w-14 h-14 bg-rose-50 dark:bg-rose-900/30 rounded-2xl flex items-center justify-center text-rose-600 dark:text-rose-400 mb-4 group-hover:scale-110 transition-transform">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Track Orders</h3>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">Manage your purchases and communicate with freelancers.</p>
                            </div>
                            <div class="text-rose-600 dark:text-rose-400 opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </div>
                        </div>
                    </a>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>