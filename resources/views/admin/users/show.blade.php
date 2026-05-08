<x-admin-layout>
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-slate-50 dark:bg-gray-950 font-sans antialiased overflow-hidden">

        <!-- Mobile sidebar overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        <!-- Admin Sidebar -->
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

                <a href="{{ route('admin.users.index') }}" @click="sidebarOpen = false" class="group flex items-center px-4 py-3 text-sm font-medium transition-all duration-200 bg-indigo-50 text-indigo-700 dark:bg-indigo-900/20 dark:text-indigo-400 rounded-2xl">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Manage Users
                </a>

                <a href="{{ route('admin.services.index') }}" @click="sidebarOpen = false" class="group flex items-center px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-2xl transition-all">
                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Manage Services
                </a>

                <a href="{{ route('admin.orders.index') }}" @click="sidebarOpen = false" class="group flex items-center px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-2xl transition-all">
                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    Manage Orders
                </a>
            </nav>

            <div class="p-6 border-t border-gray-100 dark:border-gray-800">
                <div class="flex items-center gap-3 px-2">
                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs">AD</div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">Admin Account</p>
                        <p class="text-xs text-gray-500 truncate">admin@freelancehub.com</p>
                    </div>
                </div>
            </div>
        </aside>

        <main class="flex-1 p-6 lg:p-10 overflow-y-auto scroll-smooth">
            <div class="max-w-7xl mx-auto">
                <!-- Back Button -->
                <div class="mb-6">
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 font-medium transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Back to Users
                    </a>
                </div>

                <!-- User Profile Header -->
                <div class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden mb-8">
                    <div class="px-8 py-6 border-b border-gray-50 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                @if($user->profile_picture)
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="w-16 h-16 rounded-full object-cover border-4 border-indigo-100 dark:border-indigo-900">
                                @else
                                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-2xl font-bold border-4 border-indigo-100 dark:border-indigo-900">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h1>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                                    <div class="flex items-center mt-2 space-x-4">
                                        <span class="px-3 py-1 text-xs font-bold rounded-lg bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-800">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                        @if($user->is_active)
                                            <span class="px-3 py-1 text-xs font-bold rounded-lg bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-800">
                                                Active
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-bold rounded-lg bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 border border-red-100 dark:border-red-800">
                                                Inactive
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if(auth()->id() !== $user->id)
                                <div class="flex space-x-3">
                                    @if($user->is_active)
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to deactivate this user?');">
                                            @csrf @method('DELETE')
                                            <button class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl text-sm font-semibold shadow-md transition">
                                                Deactivate User
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.users.reactivate', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to reactivate this user?');">
                                            @csrf @method('PATCH')
                                            <button class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-xl text-sm font-semibold shadow-md transition">
                                                Reactivate User
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- User Stats -->
                    <div class="px-8 py-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6">
                                <div class="flex items-center">
                                    <div class="p-3 bg-blue-100 dark:bg-blue-900/20 rounded-lg">
                                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Orders</p>
                                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->orders->count() }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6">
                                <div class="flex items-center">
                                    <div class="p-3 bg-green-100 dark:bg-green-900/20 rounded-lg">
                                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Services</p>
                                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->services->count() }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6">
                                <div class="flex items-center">
                                    <div class="p-3 bg-purple-100 dark:bg-purple-900/20 rounded-lg">
                                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10a2 2 0 002 2h4a2 2 0 002-2V11M9 11h6"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Member Since</p>
                                        <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $user->created_at->format('M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Services -->
                @if($user->services->count() > 0)
                <div class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-lg overflow-hidden mb-8">
                    <div class="px-8 py-6 border-b border-gray-50 dark:border-gray-700 bg-gradient-to-r from-indigo-50/50 to-purple-50/50 dark:from-indigo-900/10 dark:to-purple-900/10">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-indigo-100 dark:bg-indigo-900/50 rounded-lg">
                                    <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Services Portfolio</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $user->services->count() }} service{{ $user->services->count() > 1 ? 's' : '' }} offered</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 rounded-full text-sm font-semibold">
                                    {{ $user->services->where('status', 'published')->count() }} Published
                                </div>
                                <div class="px-3 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 rounded-full text-sm font-semibold">
                                    {{ $user->services->where('status', 'draft')->count() }} Draft
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                            @foreach($user->services as $service)
                            <div class="group relative bg-gradient-to-br from-white to-gray-50/50 dark:from-gray-800 dark:to-gray-700/30 rounded-2xl border border-gray-200 dark:border-gray-600 shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                                <!-- Service Image -->
                                <div class="relative h-48 bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/20 dark:to-purple-900/20 overflow-hidden">
                                    @if($service->image_path || $service->image_url)
                                        @if($service->image_path)
                                            <img src="{{ asset('storage/' . $service->image_path) }}" alt="{{ $service->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        @elseif($service->image_url)
                                            <img src="{{ $service->image_url }}" alt="{{ $service->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        @endif
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <div class="p-8 bg-white/80 dark:bg-gray-700/50 rounded-full">
                                                <svg class="w-16 h-16 text-indigo-400 dark:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Status Badge -->
                                    <div class="absolute top-4 left-4">
                                        <span class="px-3 py-1.5 text-xs font-bold uppercase tracking-wider rounded-lg shadow-lg backdrop-blur-sm
                                            {{ $service->status === 'published' ? 'bg-emerald-500/90 text-white' :
                                               ($service->status === 'draft' ? 'bg-amber-500/90 text-white' :
                                               ($service->status === 'rejected' ? 'bg-red-500/90 text-white' :
                                               'bg-gray-500/90 text-white')) }}">
                                            {{ $service->status }}
                                        </span>
                                    </div>

                                    <!-- Price Badge -->
                                    <div class="absolute top-4 right-4">
                                        <div class="bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm rounded-lg px-3 py-2 shadow-lg">
                                            <span class="text-lg font-black text-gray-900 dark:text-white">
                                                ${{ number_format($service->price, 0) }}
                                            </span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400 block">
                                                {{ $service->pricing_type }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Hover Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                        <div class="p-6 w-full">
                                            <a href="{{ route('services.show', $service) }}" class="inline-flex items-center justify-center w-full px-4 py-2 bg-white/20 backdrop-blur-sm text-white rounded-lg font-semibold hover:bg-white/30 transition">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Service Content -->
                                <div class="p-6">
                                    <!-- Category & Rating -->
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="px-3 py-1.5 text-xs font-bold uppercase tracking-wider rounded-lg bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-800">
                                            {{ $service->category }}
                                        </span>
                                        @php
                                            $avgRating = $service->freelancer->averageRating();
                                        @endphp
                                        @if($avgRating)
                                        <div class="flex items-center space-x-1">
                                            <svg class="w-3.5 h-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            <span class="text-xs font-bold text-gray-600 dark:text-gray-400">{{ round($avgRating, 1) }}</span>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Title -->
                                    <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors line-clamp-2">
                                        {{ $service->title }}
                                    </h4>

                                    <!-- Description -->
                                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed line-clamp-2 mb-4">
                                        {{ $service->description }}
                                    </p>

                                    <!-- Meta Info -->
                                    <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                        <span>{{ $service->orders->count() }} order{{ $service->orders->count() !== 1 ? 's' : '' }}</span>
                                        <span>{{ $service->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- User Orders -->
                @if($user->orders->count() > 0)
                <div class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-50 dark:border-gray-700">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Orders ({{ $user->orders->count() }})</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/50 dark:bg-gray-900/50">
                                    <th class="px-8 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Order ID</th>
                                    <th class="px-8 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Image</th>
                                    <th class="px-8 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Service</th>
                                    <th class="px-8 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Buyer</th>
                                    <th class="px-8 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Amount</th>
                                    <th class="px-8 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                                    <th class="px-8 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                                @foreach($user->orders as $order)
                                <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-700/30 transition-colors">
                                    <td class="px-8 py-5 text-sm font-bold text-gray-400 font-mono">#{{ $order->id }}</td>
                                    <td class="px-8 py-5 text-sm text-gray-600 dark:text-gray-300 font-medium">
                                        @if($order->service)
                                            @if($order->service->image_path)
                                                <img src="{{ asset('storage/' . $order->service->image_path) }}" alt="{{ $order->service->title }}" class="w-16 h-16 object-cover rounded-lg">
                                            @elseif($order->service->image_url)
                                                <img src="{{ $order->service->image_url }}" alt="{{ $order->service->title }}" class="w-16 h-16 object-cover rounded-lg">
                                            @else
                                                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-briefcase text-white text-xl opacity-75"></i>
                                                </div>
                                            @endif
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-exclamation-triangle text-gray-500 dark:text-gray-400 text-xl"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-8 py-5 text-sm font-bold text-gray-900 dark:text-white">
                                        {{ $order->service->title ?? 'Service Deleted' }}
                                    </td>
                                    <td class="px-8 py-5 text-sm font-bold text-gray-900 dark:text-white">${{ number_format($order->amount, 2) }}</td>
                                    <td class="px-8 py-5 text-sm text-gray-600 dark:text-gray-300 font-medium">
                                        {{ $order->buyer->name ?? 'Buyer Deleted' }}
                                    </td>
                                    <td class="px-8 py-5">
                                        @php
                                            $statusClass = match($order->status) {
                                                'completed' => 'bg-emerald-50 text-emerald-700 border-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400',
                                                'pending' => 'bg-amber-50 text-amber-700 border-amber-100 dark:bg-amber-500/10 dark:text-amber-400',
                                                default => 'bg-blue-50 text-blue-700 border-blue-100 dark:bg-blue-500/10 dark:text-blue-400',
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold border {{ $statusClass }}">
                                            <span class="w-1.5 h-1.5 rounded-full bg-current mr-2"></span>
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-sm text-gray-500 dark:text-gray-400">{{ $order->created_at->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                <!-- Empty State -->
                @if($user->services->count() === 0 && $user->orders->count() === 0)
                <div class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm p-12 text-center">
                    <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">No Activity Yet</h3>
                    <p class="text-gray-600 dark:text-gray-400">This user hasn't created any services or placed any orders yet.</p>
                </div>
                @endif
            </div>
        </main>
    </div>
</x-admin-layout>
