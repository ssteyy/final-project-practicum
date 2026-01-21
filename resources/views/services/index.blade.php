<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Services - FreelanceHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

    <nav class="bg-white shadow-sm mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo-600">FreelanceHub</a>
            <div class="flex space-x-6">
                <a href="{{ url('/services') }}" class="text-indigo-600 font-semibold">Browse Services</a>
                <a href="{{ url('/login') }}" class="text-gray-600">Login</a>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-8">

            <aside class="w-full md:w-1/4">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 uppercase text-xs tracking-wider">Categories</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ url('/services?category=all') }}" class="text-indigo-600 font-medium">All Categories</a></li>
                        <li><a href="{{ url('/services?category=web') }}" class="text-gray-600 hover:text-indigo-600">Web Development</a></li>
                        <li><a href="{{ url('/services?category=design') }}" class="text-gray-600 hover:text-indigo-600">Graphic Design</a></li>
                        <li><a href="{{ url('/services?category=writing') }}" class="text-gray-600 hover:text-indigo-600">Content Writing</a></li>
                        <li><a href="{{ url('/services?category=marketing') }}" class="text-gray-600 hover:text-indigo-600">Digital Marketing</a></li>
                    </ul>
                </div>
            </aside>

            <main class="w-full md:w-3/4">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Available Services</h1>
                    <span class="text-gray-500 text-sm">Showing 12 services</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @php
                        // Mock data for display
                        $services = [
                            ['id' => 1, 'title' => 'Modern Logo Design', 'price' => 45, 'category' => 'Design', 'freelancer' => 'Alex Rivera', 'img' => 'https://images.unsplash.com/photo-1626785774573-4b799315345d?w=400'],
                            ['id' => 2, 'title' => 'Laravel Web App', 'price' => 500, 'category' => 'Web Dev', 'freelancer' => 'Sarah Chen', 'img' => 'https://images.unsplash.com/photo-1587620962725-abab7fe55159?w=400'],
                            ['id' => 3, 'title' => 'SEO Blog Writing', 'price' => 30, 'category' => 'Writing', 'freelancer' => 'John Doe', 'img' => 'https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?w=400'],
                            ['id' => 4, 'title' => 'Social Media Ads', 'price' => 120, 'category' => 'Marketing', 'freelancer' => 'Emma Wilson', 'img' => 'https://images.unsplash.com/photo-1611162617474-5b21e879e113?w=400'],
                            ['id' => 5, 'title' => 'Mobile UI Design', 'price' => 250, 'category' => 'Design', 'freelancer' => 'Priya K.', 'img' => 'https://images.unsplash.com/photo-1581291518062-012f97bb5514?w=400'],
                            ['id' => 6, 'title' => 'Python Automation', 'price' => 150, 'category' => 'Web Dev', 'freelancer' => 'Marc Andre', 'img' => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?w=400'],
                        ];
                    @endphp

                    @foreach($services as $service)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
                        <a href="{{ url('/services/details/'.$service['id']) }}">
                            <img src="{{ $service['img'] }}" alt="Service" class="w-full h-40 object-cover">
                        </a>

                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs font-bold text-indigo-600 uppercase">{{ $service['category'] }}</span>
                                <span class="font-bold text-gray-900">${{ $service['price'] }}</span>
                            </div>

                            <a href="{{ url('/services/details/'.$service['id']) }}" class="block text-lg font-semibold text-gray-800 hover:text-indigo-600 mb-1">
                                {{ $service['title'] }}
                            </a>

                            <p class="text-gray-500 text-sm flex items-center">
                                <i class="fas fa-user-circle mr-2"></i> {{ $service['freelancer'] }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-12 flex justify-center">
                    <nav class="flex items-center space-x-2">
                        <a href="#" class="px-4 py-2 border rounded-md bg-white text-gray-500 hover:bg-gray-50">Previous</a>
                        <a href="#" class="px-4 py-2 border rounded-md bg-indigo-600 text-white font-bold">1</a>
                        <a href="#" class="px-4 py-2 border rounded-md bg-white text-gray-700 hover:bg-gray-50">2</a>
                        <a href="#" class="px-4 py-2 border rounded-md bg-white text-gray-700 hover:bg-gray-50">3</a>
                        <a href="#" class="px-4 py-2 border rounded-md bg-white text-gray-500 hover:bg-gray-50">Next</a>
                    </nav>
                </div>
            </main>
        </div>
    </div>

    <footer class="mt-20 bg-gray-900 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-400 text-sm">
            &copy; {{ date('Y') }} FreelanceHub. All rights reserved.
        </div>
    </footer>

</body>
</html>
