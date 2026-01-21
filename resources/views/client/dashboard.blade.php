<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard - FreelanceHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans antialiased">

    <div class="min-h-screen flex">
        <aside class="w-64 bg-indigo-900 text-white hidden md:block">
            <div class="p-6">
                <span class="text-2xl font-bold">FreelanceHub</span>
            </div>
            <nav class="mt-6 px-4 space-y-2">
                <a href="{{ url('/dashboard') }}" class="flex items-center space-x-3 bg-indigo-800 p-3 rounded-lg">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ url('/client/browse') }}" class="flex items-center space-x-3 hover:bg-indigo-800 p-3 rounded-lg transition">
                    <i class="fas fa-search"></i><span>Browse Services</span>
                </a>
                <a href="{{ url('/my-orders') }}" class="flex items-center space-x-3 hover:bg-indigo-800 p-3 rounded-lg transition">
                    <i class="fas fa-shopping-bag"></i>
                    <span>My Orders</span>
                </a>
                <div class="pt-4 border-t border-slate-800 mt-auto">
                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 w-full text-left text-gray-400 hover:text-red-400 p-3 rounded-lg transition duration-200">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="font-medium">Logout</span>
                    </button>
                </form>
            </div>
            </nav>
        </aside>

        <main class="flex-1">
            <header class="bg-white shadow-sm p-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>

                <a href="{{ url('/profile') }}" class="flex items-center space-x-4 group hover:bg-gray-50 px-3 py-1 rounded-lg transition">
                    <div class="text-right">
                        <p class="text-sm font-bold text-gray-900 group-hover:text-indigo-600">John Doe</p>
                        <p class="text-xs text-gray-500 italic">Manage Profile</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=John+Doe&background=6366f1&color=fff"
                        class="w-10 h-10 rounded-full border-2 border-transparent group-hover:border-indigo-500 transition">
                </a>
            </header>

            <div class="p-8">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Hello, John! 👋</h1>
                    <p class="text-gray-500">Here is what's happening with your projects today.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Total Orders</p>
                                <h3 class="text-2xl font-bold text-gray-900">12</h3>
                            </div>
                            <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-xl">
                                <i class="fas fa-list"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Active Projects</p>
                                <h3 class="text-2xl font-bold text-gray-900">3</h3>
                            </div>
                            <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl">
                                <i class="fas fa-spinner"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Spent Total</p>
                                <h3 class="text-2xl font-bold text-gray-900">$1,450</h3>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xl">
                                <i class="fas fa-wallet"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-bold text-gray-900 text-lg">Recent Orders</h3>
                        <a href="{{ url('/my-orders') }}" class="text-indigo-600 text-sm font-semibold hover:underline">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                                <tr>
                                    <th class="px-6 py-4">Service</th>
                                    <th class="px-6 py-4">Freelancer</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4">Price</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr>
                                    <td class="px-6 py-4 font-medium">Modern Logo Design</td>
                                    <td class="px-6 py-4">Sarah Chen</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">In Progress</span>
                                    </td>
                                    <td class="px-6 py-4">$45</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 font-medium">Laravel Bug Fix</td>
                                    <td class="px-6 py-4">Alex Rivera</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Completed</span>
                                    </td>
                                    <td class="px-6 py-4">$120</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
