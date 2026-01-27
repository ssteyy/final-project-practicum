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
                    <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo-600">FreelanceHub</a>
                </div>
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ url('/services') }}" class="text-gray-600 hover:text-indigo-600">Find Services</a>
                    <a href="{{ url('/how-it-works') }}" class="text-gray-600 hover:text-indigo-600">How it Works</a>
                    <a href="{{ url('/register') }}" class="bg-indigo-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-indigo-700 transition">Join Now</a>
                </div>
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
                    Connect with world-class freelancers to move your business forward.
                </p>

                <div class="mt-10 flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                    <a href="{{ route('services.index') }}" class="px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:text-lg">
                        Find Services
                    </a>
                    <a href="{{ route('register') }}" class="px-8 py-3 border border-indigo-600 text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50 md:text-lg">
                        Become a Freelancer
                    </a>
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
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="font-semibold">1. Client Posts Job</h3>
                    <p class="text-gray-500 text-sm mt-2">Clients describe their needs and budget.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="font-semibold">2. Freelancer Bids</h3>
                    <p class="text-gray-500 text-sm mt-2">Experts offer their services and expertise.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-sm">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3 class="font-semibold">3. Work Completed</h3>
                    <p class="text-gray-500 text-sm mt-2">Safe payment release after work approval.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-gray-300 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; <?php echo date('Y'); ?> FreelanceHub. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
