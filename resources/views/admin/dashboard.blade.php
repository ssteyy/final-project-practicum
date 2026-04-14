<x-app-layout>
    <div class="flex h-screen bg-slate-50 dark:bg-gray-950 font-sans antialiased overflow-hidden">

        <aside class="w-72 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-700 hidden lg:flex flex-col flex-shrink-0">
            <div class="p-8">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200 dark:shadow-none">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h2 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">Nexus<span class="text-indigo-600">Admin</span></h2>
                </div>
            </div>

            <nav class="flex-1 px-4 space-y-1 overflow-y-auto custom-scrollbar">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4">Main Menu</p>

                <a href="#" class="group flex items-center px-4 py-3 text-sm font-medium transition-all duration-200 bg-indigo-50 text-indigo-700 dark:bg-indigo-900/20 dark:text-indigo-400 rounded-2xl">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.users.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-2xl transition-all">
                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Manage Users
                </a>

                <a href="{{ route('admin.services.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-2xl transition-all">
                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Manage Services
                </a>

                <a href="{{ route('admin.orders.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-2xl transition-all">
                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    Manage Orders
                </a>
            </nav>

            <div class="p-6 border-t border-gray-100 dark:border-gray-800">
                <div class="flex items-center gap-3 px-2">
                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs">AD</div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">Admin Account</p>
                        <p class="text-xs text-gray-500 truncate">admin@nexus.com</p>
                    </div>
                </div>
            </div>
        </aside>

        <main class="flex-1 p-6 lg:p-10 overflow-y-auto scroll-smooth">

            <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Analytics Overview</h2>
                    <p class="text-gray-500 dark:text-gray-400 mt-1 font-medium">Monitoring platform activity and growth.</p>
                </div>
                <div class="flex items-center gap-3">
                    <button class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-semibold shadow-sm hover:bg-gray-50 transition">Export</button>
                    <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold shadow-md transition">+ New Service</button>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">
                @php
                    $stats = [
                        ['label' => 'Total Services', 'value' => $totalServices, 'color' => 'text-blue-600', 'bg' => 'bg-blue-50'],
                        ['label' => 'Total Orders', 'value' => $totalOrders, 'color' => 'text-indigo-600', 'bg' => 'bg-indigo-50'],
                        ['label' => 'Total Clients', 'value' => $totalClients, 'color' => 'text-emerald-600', 'bg' => 'bg-emerald-50'],
                        ['label' => 'Freelancers', 'value' => $totalFreelancers, 'color' => 'text-amber-600', 'bg' => 'bg-amber-50'],
                    ];
                @endphp

                @foreach($stats as $stat)
                <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm transition-transform hover:scale-[1.02]">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-2 {{ $stat['bg'] }} dark:bg-gray-700 rounded-lg">
                            <svg class="w-6 h-6 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        </div>
                        <span class="text-xs font-bold text-emerald-500 bg-emerald-50 dark:bg-emerald-500/10 px-2 py-1 rounded-lg">Live</span>
                    </div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ $stat['label'] }}</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $stat['value'] }}</p>
                </div>
                @endforeach
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden mb-10">
                <div class="px-8 py-6 border-b border-gray-50 dark:border-gray-700 flex items-center justify-between bg-white dark:bg-gray-800 sticky top-0 z-10">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Recent Orders</h3>
                    <a href="#" class="text-sm font-semibold text-indigo-600 hover:underline">View all activity</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 dark:bg-gray-900/50">
                                <th class="px-8 py-4 text-xs font-semibold uppercase text-gray-500">ID</th>
                                <th class="px-8 py-4 text-xs font-semibold uppercase text-gray-500">Stakeholders</th>
                                <th class="px-8 py-4 text-xs font-semibold uppercase text-gray-500">Service</th>
                                <th class="px-8 py-4 text-xs font-semibold uppercase text-gray-500">Amount</th>
                                <th class="px-8 py-4 text-xs font-semibold uppercase text-gray-500">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                            @forelse($recentOrders as $order)
                                <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-700/30 transition-colors">
                                    <td class="px-8 py-5 text-sm font-bold text-gray-400 font-mono">#{{ $order->id }}</td>
                                    <td class="px-8 py-5">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $order->client->name ?? 'Unknown' }}</span>
                                            <span class="text-xs text-gray-400">to {{ $order->freelancer->name ?? 'Unknown' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-sm text-gray-600 dark:text-gray-300 font-medium">{{ $order->service->title ?? 'Deleted' }}</td>
                                    <td class="px-8 py-5 text-sm font-bold text-gray-900 dark:text-white">${{ number_format($order->amount, 2) }}</td>
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
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-8 py-10 text-center text-gray-500">No orders found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="h-64"></div>
        </main>
    </div>
</x-app-layout>
