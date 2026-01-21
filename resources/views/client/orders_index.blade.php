<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - FreelanceHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 flex">

    <aside class="w-64 bg-indigo-900 min-h-screen text-white hidden md:block sticky top-0">
        <div class="p-6 text-2xl font-bold border-b border-indigo-800">FreelanceHub</div>
        <nav class="mt-6 px-4 space-y-2">
            <a href="{{ url('/dashboard') }}" class="flex items-center space-x-3 hover:bg-indigo-800 p-3 rounded-lg transition">
                <i class="fas fa-th-large"></i><span>Dashboard</span>
            </a>
            <a href="{{ url('/client/browse') }}" class="flex items-center space-x-3 hover:bg-indigo-800 p-3 rounded-lg transition">
                <i class="fas fa-search"></i><span>Browse Services</span>
            </a>
            <a href="{{ url('/my-orders') }}" class="flex items-center space-x-3 bg-indigo-800 p-3 rounded-lg">
                <i class="fas fa-shopping-bag"></i><span>My Orders</span>
            </a>
        </nav>
    </aside>

    <div class="flex-1">
        <header class="bg-white shadow-sm p-4 flex justify-between items-center sticky top-0 z-10">
            <h2 class="text-xl font-semibold text-gray-800">Order Management</h2>
            <div class="flex items-center space-x-4">
                <img src="https://ui-avatars.com/api/?name=John+Doe&background=6366f1&color=fff" class="w-8 h-8 rounded-full">
            </div>
        </header>

        <main class="p-8">
            <div class="max-w-6xl mx-auto">
                <div class="flex justify-between items-end mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">My Orders</h1>
                        <p class="text-gray-500 mt-1">Manage and track your active and past projects.</p>
                    </div>
                </div>

                <div class="flex border-b border-gray-200 mb-6">
                    <button class="px-6 py-3 border-b-2 border-indigo-600 text-indigo-600 font-bold text-sm">All Orders</button>
                    <button class="px-6 py-3 text-gray-500 font-medium text-sm hover:text-indigo-600">Active</button>
                    <button class="px-6 py-3 text-gray-500 font-medium text-sm hover:text-indigo-600">Completed</button>
                </div>

                <div class="space-y-4">
                    @php
                        $orders = [
                            ['id' => 'ORD-9921', 'title' => 'Responsive Web App with Laravel', 'freelancer' => 'Sarah Chen', 'date' => 'Dec 28, 2023', 'price' => 500, 'status' => 'In Progress', 'status_color' => 'blue'],
                            ['id' => 'ORD-9850', 'title' => 'Minimalist Business Logo Design', 'freelancer' => 'Alex Rivera', 'date' => 'Dec 25, 2023', 'price' => 45, 'status' => 'Pending', 'status_color' => 'yellow'],
                            ['id' => 'ORD-9742', 'title' => 'Professional SEO Article Writing', 'freelancer' => 'John Doe', 'date' => 'Dec 20, 2023', 'price' => 30, 'status' => 'Completed', 'status_color' => 'green'],
                            ['id' => 'ORD-9610', 'title' => 'Social Media Growth Strategy', 'freelancer' => 'Emma Wilson', 'date' => 'Dec 15, 2023', 'price' => 120, 'status' => 'Accepted', 'status_color' => 'indigo'],
                        ];
                    @endphp

                    @foreach($orders as $order)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">

                            <div class="flex gap-4 items-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                                    <i class="fas fa-file-invoice text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-lg hover:text-indigo-600 cursor-pointer">
                                        {{ $order['title'] }}
                                    </h3>
                                    <div class="flex items-center text-sm text-gray-500 mt-1">
                                        <span>Order #{{ $order['id'] }}</span>
                                        <span class="mx-2">•</span>
                                        <span>Freelancer: <span class="font-medium text-gray-700">{{ $order['freelancer'] }}</span></span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 lg:gap-12">
                                <div class="text-left sm:text-right">
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Status</p>
                                    <span class="px-3 py-1 rounded-full text-xs font-bold
                                        {{ $order['status_color'] == 'blue' ? 'bg-blue-100 text-blue-700' : '' }}
                                        {{ $order['status_color'] == 'yellow' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $order['status_color'] == 'green' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $order['status_color'] == 'indigo' ? 'bg-indigo-100 text-indigo-700' : '' }}
                                    ">
                                        {{ $order['status'] }}
                                    </span>
                                </div>

                                <div class="text-left sm:text-right">
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Amount</p>
                                    <p class="text-lg font-bold text-gray-900">${{ $order['price'] }}</p>
                                </div>

                                <a href="{{ url('/services/details/1') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-bold text-gray-700 hover:bg-gray-50 transition">
                                    View Details
                                </a>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </main>
    </div>

</body>
</html>
