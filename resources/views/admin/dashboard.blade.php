<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Admin Dashboard') }}</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Manage services, orders, and platform activity from one central admin panel.</p>
            </div>
            <div class="inline-flex items-center gap-3">
                <a href="{{ route('admin.services.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-2xl hover:bg-indigo-700 transition">Manage Services</a>
                <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-2xl hover:bg-emerald-700 transition">Manage Orders</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 via-indigo-50/20 to-purple-50/20 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 xl:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                    <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Total Services</p>
                    <p class="mt-3 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalServices }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                    <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Total Orders</p>
                    <p class="mt-3 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalOrders }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                    <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Clients</p>
                    <p class="mt-3 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalClients }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                    <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Freelancers</p>
                    <p class="mt-3 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalFreelancers }}</p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-5 bg-gray-100 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Orders</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Order</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Client</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Freelancer</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Service</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($recentOrders as $order)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-white">#{{ $order->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $order->client->name ?? 'Unknown' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $order->freelancer->name ?? 'Unknown' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $order->service->title ?? 'Deleted' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-emerald-700 dark:text-emerald-300">${{ number_format($order->amount, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wide {{ $order->status === 'completed' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300' : ($order->status === 'pending' ? 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300' : ($order->status === 'in progress' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : 'bg-gray-100 text-gray-700 dark:bg-gray-900/40 dark:text-gray-300')) }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">No recent orders to display.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
