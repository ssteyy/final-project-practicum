<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Services - FreelanceHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 flex">

    <aside class="w-64 bg-indigo-900 min-h-screen text-white hidden md:block sticky top-0">
        <div class="p-6 text-2xl font-bold">FreelanceHub</div>
        <nav class="mt-6 px-4 space-y-2">
            <a href="{{ url('/dashboard') }}" class="flex items-center space-x-3 hover:bg-indigo-800 p-3 rounded-lg transition">
                <i class="fas fa-th-large"></i><span>Dashboard</span>
            </a>
            <a href="{{ url('/client/browse') }}" class="flex items-center space-x-3 bg-indigo-800 p-3 rounded-lg">
                <i class="fas fa-search"></i><span>Browse Services</span>
            </a>
            <a href="{{ url('/my-orders') }}" class="flex items-center space-x-3 hover:bg-indigo-800 p-3 rounded-lg transition">
                <i class="fas fa-shopping-bag"></i><span>My Orders</span>
            </a>
        </nav>
    </aside>

    <div class="flex-1">
        <header class="bg-white shadow-sm p-4 flex justify-between items-center sticky top-0 z-10">
            <h2 class="text-xl font-semibold text-gray-800">Find Your Next Expert</h2>
            <div class="flex items-center space-x-4">
                <input type="text" placeholder="Search services..." class="px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 outline-none w-64">
                <img src="https://ui-avatars.com/api/?name=John+Doe&background=6366f1&color=fff" class="w-8 h-8 rounded-full">
            </div>
        </header>

        <main class="p-8">
            <div class="flex flex-wrap gap-3 mb-8">
                <button class="bg-indigo-600 text-white px-4 py-2 rounded-full text-sm font-medium">All</button>
                <button class="bg-white border border-gray-200 px-4 py-2 rounded-full text-sm font-medium hover:border-indigo-600">Graphics & Design</button>
                <button class="bg-white border border-gray-200 px-4 py-2 rounded-full text-sm font-medium hover:border-indigo-600">Digital Marketing</button>
                <button class="bg-white border border-gray-200 px-4 py-2 rounded-full text-sm font-medium hover:border-indigo-600">Writing & Translation</button>
                <button class="bg-white border border-gray-200 px-4 py-2 rounded-full text-sm font-medium hover:border-indigo-600">Video & Animation</button>
                <button class="bg-white border border-gray-200 px-4 py-2 rounded-full text-sm font-medium hover:border-indigo-600">Programming & Tech</button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
                @php
                    $services = [
                        ['id' => 1, 'name' => 'Sarah Chen', 'title' => 'Responsive Web App with Laravel', 'price' => 500, 'rating' => 4.9, 'img' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=400'],
                        ['id' => 2, 'name' => 'Alex Rivera', 'title' => 'Minimalist Business Logo Design', 'price' => 45, 'rating' => 4.8, 'img' => 'https://images.unsplash.com/photo-1558655146-d09347e92766?w=400'],
                        ['id' => 3, 'name' => 'John Doe', 'title' => 'Professional SEO Article Writing', 'price' => 30, 'rating' => 4.7, 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead277a?w=400'],
                        ['id' => 4, 'name' => 'Emma Wilson', 'title' => 'Social Media Growth Strategy', 'price' => 120, 'rating' => 5.0, 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400'],
                    ];
                @endphp

                @foreach($services as $service)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition flex flex-col">
                    <img src="{{ $service['img'] }}" class="w-full h-40 object-cover">
                    <div class="p-4 flex-1 flex flex-col">
                        <div class="flex items-center gap-2 mb-2">
                            <img src="https://ui-avatars.com/api/?name={{ $service['name'] }}" class="w-6 h-6 rounded-full">
                            <span class="text-sm font-medium text-gray-700">{{ $service['name'] }}</span>
                        </div>
                        <a href="{{ url('/services/details/'.$service['id']) }}" class="text-gray-800 font-bold hover:text-indigo-600 mb-2 leading-snug">
                            {{ $service['title'] }}
                        </a>
                        <div class="flex items-center text-yellow-400 text-xs mb-4">
                            <i class="fas fa-star"></i>
                            <span class="ml-1 text-gray-600 font-bold">{{ $service['rating'] }}</span>
                        </div>
                        <div class="mt-auto pt-4 border-t flex justify-between items-center">
                            <span class="text-xs text-gray-400 font-bold uppercase tracking-wider">Starting at</span>
                            <span class="text-lg font-bold text-gray-900">${{ $service['price'] }}</span>
                        </div>

                        <a href="{{ url('/services/details/'.$service['id']) }}" class="mt-4 block w-full text-center bg-indigo-50 text-indigo-700 font-bold py-2 rounded-lg hover:bg-indigo-600 hover:text-white transition">
                            Order Service
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </main>
    </div>

</body>
</html>
