<x-admin-layout>
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-slate-50 dark:bg-gray-950 font-sans antialiased overflow-hidden">

        <!-- Mobile sidebar overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'" class="w-72 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 fixed lg:static inset-y-0 left-0 z-50 lg:flex flex-col flex-shrink-0 transform transition-transform duration-300 ease-in-out lg:transform-none">
            <div class="p-8">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200 dark:shadow-none">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">FreelanceHub<span class="text-indigo-600">Admin</span></h2>
                </div>
            </div>

            <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4">Main Menu</p>

                <a href="{{ route('admin.dashboard') }}" @click="sidebarOpen = false" class="group flex items-center px-4 py-3 text-sm font-medium transition-all duration-200 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-2xl">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.users.index') }}" @click="sidebarOpen = false" class="group flex items-center px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-2xl transition-all">
                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Manage Users
                </a>

                <a href="{{ route('admin.services.index') }}" @click="sidebarOpen = false" class="group flex items-center px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-2xl transition-all">
                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Manage Services
                </a>

                <a href="{{ route('admin.orders.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium transition-all duration-200 bg-indigo-50 text-indigo-700 dark:bg-indigo-900/20 dark:text-indigo-400 rounded-2xl">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    Manage Orders
                </a>
            </nav>
        </aside>

        <main class="flex-1 overflow-y-auto scroll-smooth">

            <!-- Admin Navigation Bar -->
            <nav class="bg-white/95 backdrop-blur-md dark:bg-gray-800/95 border-b border-gray-200 dark:border-gray-700 shadow-sm sticky top-0 z-40">
                <div class="px-6 lg:px-10 py-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 dark:from-indigo-500 dark:to-purple-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                        <i class="fas fa-bolt text-white"></i>
                                    </div>
                                    <span class="text-xl font-bold tracking-tight text-gray-800 dark:text-gray-200 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">FreelanceHub<span class="text-indigo-600">Admin</span></span>
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            @php
                                $unreadCount = \App\Models\Message::where('receiver_id', Auth::id())
                                    ->where('is_read', false)
                                    ->count();
                            @endphp
                            <a href="{{ route('messages.index') }}" class="relative inline-flex items-center px-3 py-2 border border-gray-200 dark:border-gray-700 text-sm leading-4 font-medium rounded-xl text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                @if($unreadCount > 0)
                                    <span class="absolute -top-1 -right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full min-w-[20px]">
                                        {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                                    </span>
                                @endif
                            </a>
                            <div class="flex items-center">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="inline-flex items-center px-4 py-2 border border-gray-200 dark:border-gray-700 text-sm leading-4 font-medium rounded-xl text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                                            @if(Auth::user()->profile_picture)
                                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-full object-cover mr-3 border-2 border-indigo-500 shadow-sm">
                                            @else
                                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-sm font-bold mr-3 shadow-sm">
                                                    {{ substr(Auth::user()->name, 0, 1) }}
                                                </div>
                                            @endif
                                            <div class="text-left mr-2">
                                                <div class="font-semibold">{{ Auth::user()->name }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400 capitalize">{{ Auth::user()->role }}</div>
                                            </div>
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('profile.edit')">
                                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            {{ __('Profile') }}
                                        </x-dropdown-link>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="p-6 lg:p-10">
                <div class="max-w-5xl mx-auto">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 mb-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                Back to Orders
                            </a>
                            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight">Order #{{ $order->id }}</h1>
                            <p class="text-gray-500 dark:text-gray-400 mt-1">Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                        </div>
                        <div>
                            @php
                                $statusClass = match($order->status) {
                                    'completed' => 'bg-emerald-100 text-emerald-700 border-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-400',
                                    'pending' => 'bg-amber-100 text-amber-700 border-amber-200 dark:bg-amber-500/10 dark:text-amber-400',
                                    'in progress' => 'bg-blue-100 text-blue-700 border-blue-200 dark:bg-blue-500/10 dark:text-blue-400',
                                    'cancelled' => 'bg-red-100 text-red-700 border-red-200 dark:bg-red-500/10 dark:text-red-400',
                                    default => 'bg-gray-100 text-gray-700 border-gray-200 dark:bg-gray-500/10 dark:text-gray-400',
                                };
                            @endphp
                            <span class="inline-flex items-center px-5 py-2 rounded-2xl text-sm font-bold border {{ $statusClass }}">
                                <span class="w-2 h-2 rounded-full bg-current mr-2"></span>
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm p-8 lg:p-10">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                    Order Details
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Complete information about this transaction</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500 dark:text-gray-400">TOTAL AMOUNT</p>
                                <p class="text-4xl font-black text-emerald-600 dark:text-emerald-400">${{ number_format($order->amount, 2) }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-10 gap-y-10">
                            <!-- Service -->
                            <div>
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">SERVICE</p>
                                <div class="flex items-center gap-4">
                                    @if($order->service && ($order->service->image_path || $order->service->image_url))
                                        <div class="w-20 h-20 rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700 flex-shrink-0 shadow-sm">
                                            <img src="{{ $order->service->image_path ? asset('storage/' . $order->service->image_path) : $order->service->image_url }}" class="w-full h-full object-cover">
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-bold text-xl text-gray-900 dark:text-white">{{ $order->service->title ?? 'Deleted Service' }}</p>
                                        <p class="text-sm text-gray-500 mt-0.5">{{ $order->service->category ?? '' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Participants -->
                            <div>
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">PARTICIPANTS</p>
                                <div class="space-y-4">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.users.show', $order->client->id) }}" class="flex items-center gap-3 hover:opacity-80 transition">
                                            @if($order->client && $order->client->profile_picture)
                                                <img src="{{ str_starts_with($order->client->profile_picture, 'http') ? $order->client->profile_picture : asset('storage/' . $order->client->profile_picture) }}" class="w-10 h-10 rounded-2xl object-cover border border-gray-200 dark:border-gray-700 flex-shrink-0">
                                            @else
                                                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold flex-shrink-0">
                                                    {{ substr($order->client->name ?? 'C', 0, 1) }}
                                                </div>
                                            @endif
                                            <div>
                                                <p class="text-xs text-gray-500">Client</p>
                                                <p class="font-semibold text-gray-900 dark:text-white">{{ $order->client->name ?? 'Unknown' }}</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.users.show', $order->freelancer->id) }}" class="flex items-center gap-3 hover:opacity-80 transition">
                                            @if($order->freelancer && $order->freelancer->profile_picture)
                                                <img src="{{ str_starts_with($order->freelancer->profile_picture, 'http') ? $order->freelancer->profile_picture : asset('storage/' . $order->freelancer->profile_picture) }}" class="w-10 h-10 rounded-2xl object-cover border border-gray-200 dark:border-gray-700 flex-shrink-0">
                                            @else
                                                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-bold flex-shrink-0">
                                                    {{ substr($order->freelancer->name ?? 'F', 0, 1) }}
                                                </div>
                                            @endif
                                            <div>
                                                <p class="text-xs text-gray-500">Freelancer</p>
                                                <p class="font-semibold text-gray-900 dark:text-white">{{ $order->freelancer->name ?? 'Unknown' }}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($order->requirements)
                        <div class="mt-10 pt-8 border-t border-gray-100 dark:border-gray-800">
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">REQUIREMENTS</p>
                            <div class="bg-gray-50 dark:bg-gray-800/50 rounded-2xl p-5 text-gray-700 dark:text-gray-300 leading-relaxed">
                                {{ $order->requirements }}
                            </div>
                        </div>
                        @endif

                        @if($order->review)
                        <div class="mt-10 pt-8 border-t border-gray-100 dark:border-gray-800">
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">REVIEW</p>
                            <div class="flex items-center gap-1 mb-3">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-6 h-6 {{ $i <= $order->review->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                @endfor
                            </div>
                            @if($order->review->comment)
                                <div class="text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-800/50 rounded-2xl p-5">
                                    {{ $order->review->comment }}
                                </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </main>
    </div>
</x-admin-layout>
