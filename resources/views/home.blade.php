<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreelanceHub - Connect & Create</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans antialiased">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-indigo-600">FreelanceHub</span>
                </div>
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('services.index') }}" class="text-gray-600 hover:text-indigo-600">Find Services</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600">How it Works</a>
                    <a href="{{ url('/register') }}" class="bg-indigo-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-indigo-700 transition">Join Now</a>                </div>
            </div>
        </div>
    </nav>

    <header class="relative bg-white py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2 text-center lg:text-left">
                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                    Your vision, <span class="text-indigo-600">realized by experts.</span>
                </h1>
                <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg lg:text-xl">
                    Connect with world-class freelancers to move your business forward. Whether it's coding, design, or marketing, we've got you covered.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                    <a href="{{ route('services.index') }}" class="px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:text-lg">
                        Find Services
                    </a>
                    <a href="{{ url('/login') }}" class="px-8 py-3 border border-indigo-600 text-indigo-600 rounded-md hover:bg-indigo-50">Become a Freelancer</a>
                </div>
            </div>
            <div class="lg:w-1/2 mt-12 lg:mt-0">
                <img class="w-full rounded-xl shadow-2xl" src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80" alt="Team working">
            </div>
        </div>
    </header>

    <section class="py-16 bg-indigo-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900">How It Works</h2>
            <p class="mt-4 text-gray-600">Bridge the gap between talent and opportunity.</p>

            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">1. Find Talent</h3>
                    <p class="text-gray-500 text-sm">Post a job or browse our catalog of vetted professionals across various industries.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-handshake text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">2. Collaborate</h3>
                    <p class="text-gray-500 text-sm">Communicate via our secure platform and manage projects with ease.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">3. Get Results</h3>
                    <p class="text-gray-500 text-sm">Approve the work and release payment only when you are 100% satisfied.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Popular Services</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $services = [
                        ['title' => 'Web Development', 'img' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=400'],
                        ['title' => 'Graphic Design', 'img' => 'https://images.unsplash.com/photo-1558655146-d09347e92766?w=400'],
                        ['title' => 'Digital Marketing', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400'],
                        ['title' => 'Content Writing', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead277a?w=400'],
                    ];
                @endphp

                @foreach($services as $service)
                <div class="group cursor-pointer rounded-lg overflow-hidden border border-gray-200 hover:shadow-lg transition">
                    <img src="{{ $service['img'] }}" alt="{{ $service['title'] }}" class="w-full h-40 object-cover group-hover:scale-105 transition duration-300">
                    <div class="p-4 bg-white">
                        <h4 class="font-bold text-gray-800">{{ $service['title'] }}</h4>
                        <p class="text-indigo-600 text-sm mt-1">Starting from $50</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold text-white mb-4">FreelanceHub</h2>
            <p class="mb-8">Your global marketplace for professional skills.</p>
            <div class="border-t border-gray-800 pt-8 text-sm">
                &copy; {{ date('Y') }} FreelanceHub. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>
