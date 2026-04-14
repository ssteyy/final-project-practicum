<x-app-layout>
    <div class="flex h-screen bg-slate-50 dark:bg-gray-950 font-sans antialiased overflow-hidden">

        <aside class="w-72 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 hidden lg:flex flex-col flex-shrink-0">
            <div class="p-8">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200 dark:shadow-none">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">Nexus<span class="text-indigo-600">Admin</span></h2>
                </div>
            </div>

            <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4">Main Menu</p>

                <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-4 py-3 text-sm font-medium transition-all duration-200 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-2xl">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.users.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-2xl transition-all">
                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Manage User
                </a>

                <a href="{{ route('admin.services.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-2xl transition-all">
                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Manage Services
                </a>

                <a href="#" class="group flex items-center px-4 py-3 text-sm font-medium transition-all duration-200 bg-indigo-50 text-indigo-700 dark:bg-indigo-900/20 dark:text-indigo-400 rounded-2xl">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    Manage Orders
                </a>
            </nav>
        </aside>

        <main class="flex-1 p-6 lg:p-10 overflow-y-auto scroll-smooth h-full">

            <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                        Order Management
                    </h2>
                    <p class="text-gray-500 dark:text-gray-400 mt-1 font-medium">
                        Review, update status, and track platform transactions.
                    </p>
                </div>

                <form method="GET" action="{{ route('admin.orders.index') }}" class="relative group">
                    <input type="search" name="search" value="{{ request('search') }}"
                        placeholder="Search orders..."
                        class="pl-10 pr-4 py-2 w-72 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm" />
                    <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden mb-12">

                <div class="px-8 py-6 border-b border-gray-50 dark:border-gray-700 flex items-center justify-between bg-white dark:bg-gray-800 sticky top-0 z-10">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">All Orders</h3>
                    <span class="px-3 py-1 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 rounded-lg text-xs font-bold">
                        Live Transactions
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 dark:bg-gray-900/50">
                                <th class="px-8 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">ID</th>
                                <th class="px-8 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Stakeholders</th>
                                <th class="px-8 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Service Title</th>
                                <th class="px-8 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Amount</th>
                                <th class="px-8 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                                <th class="px-8 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-right">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                            @forelse($orders as $order)
                                <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-700/30 transition-colors">
                                    <td class="px-8 py-5 text-sm font-bold text-gray-400 font-mono">#{{ $order->id }}</td>
                                    <td class="px-8 py-5">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $order->client->name ?? 'Unknown' }}</span>
                                            <span class="text-xs text-gray-400 font-medium">to {{ $order->freelancer->name ?? 'Unknown' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-sm text-gray-600 dark:text-gray-300 font-medium">
                                        {{ $order->service->title ?? 'Deleted Service' }}
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="text-sm font-bold text-emerald-600 dark:text-emerald-400">
                                            ${{ number_format($order->amount, 2) }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5">
                                        @php
                                            $statusClass = match($order->status) {
                                                'completed' => 'bg-emerald-50 text-emerald-700 border-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400',
                                                'pending' => 'bg-amber-50 text-amber-700 border-amber-100 dark:bg-amber-500/10 dark:text-amber-400',
                                                'in progress' => 'bg-blue-50 text-blue-700 border-blue-100 dark:bg-blue-500/10 dark:text-blue-400',
                                                'cancelled' => 'bg-red-50 text-red-700 border-red-100 dark:bg-red-500/10 dark:text-red-400',
                                                default => 'bg-gray-50 text-gray-700 border-gray-100 dark:bg-gray-500/10 dark:text-gray-400',
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold border {{ $statusClass }}">
                                            <span class="w-1.5 h-1.5 rounded-full bg-current mr-2"></span>
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>

                                    <td class="px-8 py-5 text-right">
                                        <div class="flex items-center justify-end gap-3">
                                            <a href="{{ route('orders.show', $order) }}" class="p-2 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-xl hover:bg-gray-200 transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>

                                            <form action="{{ route('orders.update', $order) }}" method="POST" class="flex items-center gap-2">
                                                @csrf @method('PATCH')
                                                <select name="status" class="text-xs font-semibold py-1 pl-2 pr-8 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-indigo-500">
                                                    @foreach(['pending','in progress','completed','cancelled'] as $status)
                                                        <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                                            {{ ucfirst($status) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button class="p-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                                </button>
                                            </form>

                                            <form action="{{ route('orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Remove order?');">
                                                @csrf @method('DELETE')
                                                <button class="p-2 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-xl hover:bg-red-100 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-20 text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-full mb-4 text-gray-400">
                                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                            </div>
                                            <p class="font-bold text-lg">No orders found</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-8 py-6 border-t border-gray-50 dark:border-gray-700 bg-gray-50/30 dark:bg-gray-900/30">
                    {{ $orders->links() }}
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
