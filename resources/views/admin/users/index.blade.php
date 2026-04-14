<x-app-layout>
    <div class="flex h-screen bg-slate-50 dark:bg-gray-950 font-sans antialiased overflow-hidden">

        <aside class="w-72 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 hidden lg:flex flex-col flex-shrink-0 h-full">
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

                <a href="#" class="group flex items-center px-4 py-3 text-sm font-medium transition-all duration-200 bg-indigo-50 text-indigo-700 dark:bg-indigo-900/20 dark:text-indigo-400 rounded-2xl">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Manage User
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
        </aside>

        <main class="flex-1 overflow-y-auto scroll-smooth bg-slate-50 dark:bg-gray-950">
            <div class="p-6 lg:p-10">

                <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
                    <div>
                        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                            User Management
                        </h2>
                        <p class="text-gray-500 dark:text-gray-400 mt-1 font-medium">
                            Control user access, update roles, and manage account statuses.
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <form method="GET" action="#" class="relative group">
                            <input type="search" name="search" value="{{ request('search') }}"
                                placeholder="Search by name or email..."
                                class="pl-10 pr-4 py-2 w-72 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm" />
                            <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </form>
                        <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold shadow-md transition">
                            + Add User
                        </button>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-50 dark:border-gray-700 flex items-center justify-between bg-white dark:bg-gray-800 sticky top-0 z-10">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Registered Users</h3>
                        <div class="flex gap-2">
                            <span class="px-3 py-1 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-lg text-xs font-bold border border-blue-100 dark:border-blue-800">
                                Total: {{ $users->total() ?? 0 }}
                            </span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/50 dark:bg-gray-900/50">
                                    <th class="px-8 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">User Details</th>
                                    <th class="px-8 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Role</th>
                                    <th class="px-8 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Joined Date</th>
                                    <th class="px-8 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                                    <th class="px-8 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-right">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                                @forelse($users as $user)
                                    <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-700/30 transition-colors">
                                        <td class="px-8 py-5">
                                            <div class="flex items-center gap-3">
                                                <div class="h-10 w-10 rounded-full bg-indigo-100 dark:bg-gray-700 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-sm">
                                                    {{ substr($user->name, 0, 2) }}
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $user->name }}</span>
                                                    <span class="text-xs text-gray-400">{{ $user->email }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-5">
                                            <span class="text-xs font-bold px-2.5 py-1 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-600">
                                                {{ ucfirst($user->role ?? 'User') }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-5 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $user->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-8 py-5">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold border bg-emerald-50 text-emerald-700 border-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400">
                                                <span class="w-1.5 h-1.5 rounded-full bg-current mr-2"></span>
                                                Active
                                            </span>
                                        </td>
                                        <td class="px-8 py-5 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <button class="p-2 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 rounded-xl hover:bg-indigo-100 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                </button>
                                                <form action="#" method="POST" onsubmit="return confirm('Suspend this user?');">
                                                    @csrf @method('DELETE')
                                                    <button class="p-2 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-xl hover:bg-red-100 transition">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="px-8 py-6 border-t border-gray-50 dark:border-gray-700 bg-gray-50/30 dark:bg-gray-900/30">
                        {{ $users->links() }}
                    </div>
                </div>

                <div class="h-20"></div>
            </div>
        </main>
    </div>
</x-app-layout>
