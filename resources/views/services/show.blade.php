<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Details - FreelanceHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">

    <nav class="bg-white shadow-sm mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo-600">FreelanceHub</a>
            <div class="flex space-x-6">
                <a href="{{ url('/services') }}" class="text-gray-600 hover:text-indigo-600">Back to Browse</a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-12">

            <div class="lg:w-2/3">
                <nav class="flex mb-4 text-sm text-gray-500 uppercase font-bold tracking-wider">
                    <a href="#" class="hover:text-indigo-600">Services</a>
                    <span class="mx-2">/</span>
                    <span class="text-indigo-600">Web Development</span>
                </nav>

                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6">
                    I will build a professional Laravel Web Application for your business
                </h1>

                <div class="rounded-xl overflow-hidden mb-8 shadow-lg">
                    <img src="https://images.unsplash.com/photo-1587620962725-abab7fe55159?auto=format&fit=crop&w=1200&q=80" alt="Service Header" class="w-full h-auto">
                </div>

                <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">About This Service</h2>
                    <div class="text-gray-600 leading-relaxed space-y-4">
                        <p>Are you looking for a robust, scalable, and secure web application? I specialize in building custom solutions using the Laravel framework and Tailwind CSS.</p>
                        <p><strong>What you will get:</strong></p>
                        <ul class="list-disc ml-5 space-y-2">
                            <li>Responsive Design (Mobile/Tablet/Desktop)</li>
                            <li>Clean & Commented Code</li>
                            <li>Database Integration (MySQL/PostgreSQL)</li>
                            <li>API Integration & Custom Logic</li>
                            <li>SEO Optimized Structure</li>
                        </ul>
                        <p>Please contact me before placing an order to discuss your specific requirements and timeline.</p>
                    </div>
                </div>
            </div>

            <div class="lg:w-1/3">
                <div class="sticky top-24 space-y-6">
                    <div class="bg-white p-6 rounded-xl shadow-md border-2 border-indigo-500">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-gray-500 font-medium">Standard Package</span>
                            <span class="text-3xl font-bold text-gray-900">$500</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">Includes full application development, 5 pages, and 1 month of support.</p>

                        <a href="{{ url('/order/create/1') }}" class="block w-full text-center bg-indigo-600 text-white font-bold py-4 rounded-lg hover:bg-indigo-700 transition">
                            Order Now <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                        <p class="text-center text-xs text-gray-400 mt-4 italic">Login required to place order</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="font-bold text-gray-800 mb-4">About the Freelancer</h3>
                        <div class="flex items-center gap-4">
                            <img src="https://ui-avatars.com/api/?name=Sarah+Chen&background=6366f1&color=fff" alt="Freelancer" class="w-16 h-16 rounded-full">
                            <div>
                                <h4 class="font-bold text-lg">Sarah Chen</h4>
                                <p class="text-gray-500 text-sm">Full Stack Developer</p>
                                <div class="flex text-yellow-400 text-xs mt-1">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <span class="ml-2 text-gray-400 font-medium">(142 reviews)</span>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="block text-center mt-6 text-sm font-semibold text-indigo-600 hover:text-indigo-800">
                            View Profile
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <footer class="mt-20 bg-gray-900 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-400 text-sm">
            &copy; {{ date('Y') }} FreelanceHub. All rights reserved.
        </div>
    </footer>

</body>
</html>
