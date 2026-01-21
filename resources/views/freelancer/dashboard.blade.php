<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancer Dashboard - FreelanceHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans antialiased">

    <div class="min-h-screen flex">
        <aside class="w-64 bg-slate-900 text-white hidden md:block">
            <div class="p-6 border-b border-slate-800">
                <span class="text-2xl font-bold text-indigo-400">FreelanceHub</span>
                <p class="text-xs text-slate-400 mt-1 uppercase tracking-widest">Freelancer Mode</p>
            </div>
            <nav class="mt-6 px-4 space-y-2">
                <a href="{{ url('/freelancer/dashboard') }}" class="flex items-center space-x-3 bg-indigo-600 p-3 rounded-lg">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ url('/freelancer/services') }}" class="flex items-center space-x-3 hover:bg-slate-800 p-3 rounded-lg transition">
                    <i class="fas fa-concierge-bell"></i>
                    <span>Manage Services</span>
                </a>
                <a href="{{ url('/freelancer/orders') }}" class="flex items-center space-x-3 hover:bg-slate-800 p-3 rounded-lg transition">
                    <i class="fas fa-tasks"></i>
                    <span>Received Orders</span>
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
                <h2 class="text-xl font-semibold text-gray-800">Seller Overview</h2>

                <a href="{{ url('/profile') }}" class="flex items-center space-x-4 group hover:bg-gray-50 px-3 py-1 rounded-lg transition">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-gray-900 group-hover:text-indigo-600">Sarah Chen</p>
                        <p class="text-xs text-green-500 font-medium">View Profile Settings</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=Sarah+Chen&background=6366f1&color=fff"
                        class="w-10 h-10 rounded-full border-2 border-transparent group-hover:border-indigo-500 transition">
                </a>
            </header>

            <div class="p-8">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Freelancer Stats</h1>
                    <p class="text-gray-500">Track your earnings and service performance.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center text-xl">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Active Services</p>
                                <h3 class="text-2xl font-bold text-gray-900">5</h3>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-xl">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Total Sales</p>
                                <h3 class="text-2xl font-bold text-gray-900">142</h3>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-lg flex items-center justify-center text-xl">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Pending Orders</p>
                                <h3 class="text-2xl font-bold text-gray-900 text-orange-600">4</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-bell text-indigo-500 mr-2"></i> Recent Order Activity
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm text-gray-700 font-medium">New order from **John Doe**</span>
                                <span class="text-xs text-gray-400">2 mins ago</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm text-gray-700 font-medium">Order #9921 marked as **In Progress**</span>
                                <span class="text-xs text-gray-400">1 hour ago</span>
                            </div>
                        </div>
                        <a href="{{ url('/freelancer/orders') }}" class="mt-6 block text-center text-sm font-bold text-indigo-600 hover:underline">View All Orders</a>
                    </div>

                    <div class="bg-indigo-600 rounded-xl shadow-sm p-8 text-white flex flex-col justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Grow your business</h3>
                            <p class="text-indigo-100 opacity-90">Create a new service to reach more clients and increase your revenue.</p>
                        </div>
                        <a href="{{ url('/freelancer/services/create') }}" class="mt-8 bg-white text-indigo-600 text-center font-bold py-3 rounded-lg hover:bg-indigo-50 transition">
                            + Create New Service
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
