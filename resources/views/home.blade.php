<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreelanceHub - Connect & Create</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white font-sans antialiased">

    <!-- Navigation -->
    <nav class="bg-white/95 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-bolt text-white"></i>
                    </div>
                    <a href="{{ url('/') }}" class="text-2xl font-bold text-gray-900">FreelanceHub</a>
                </div>
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ url('/services') }}" class="text-gray-600 hover:text-indigo-600 font-medium transition">Find Services</a>
                    <a href="#how-it-works" class="text-gray-600 hover:text-indigo-600 font-medium transition">How it Works</a>
                    <a href="{{ url('/register') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2.5 rounded-xl font-semibold hover:from-indigo-700 hover:to-purple-700 transition shadow-lg hover:shadow-xl">Join Now</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="relative bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-20 lg:py-32 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 -mr-40 -mt-40 w-96 h-96 bg-indigo-200 rounded-full blur-3xl opacity-30"></div>
        <div class="absolute bottom-0 left-0 -ml-40 -mb-40 w-96 h-96 bg-purple-200 rounded-full blur-3xl opacity-30"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center gap-12">
            <div class="lg:w-1/2 text-center lg:text-left">
                <div class="inline-flex items-center px-4 py-2 bg-indigo-100 text-indigo-700 rounded-full text-sm font-semibold mb-6">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    Trusted by 10,000+ professionals
                </div>

                <h1 class="text-5xl lg:text-6xl tracking-tight font-extrabold text-gray-900 mb-6">
                    Your vision, <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600">realized by experts.</span>
                </h1>
                <p class="text-xl text-gray-600 mb-10 leading-relaxed">
                    Connect with world-class freelancers to move your business forward. Quality work, delivered on time.
                </p>

                <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                    <a href="{{ route('services.index') }}" class="group inline-flex items-center justify-center px-8 py-4 text-base font-bold rounded-xl text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 shadow-xl hover:shadow-2xl transition-all duration-200">
                        Find Services
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold rounded-xl text-indigo-600 bg-white border-2 border-indigo-600 hover:bg-indigo-50 shadow-lg hover:shadow-xl transition-all duration-200">
                        Become a Freelancer
                    </a>
                </div>

                <!-- Stats -->
                <div class="mt-12 grid grid-cols-3 gap-6">
                    <div class="text-center lg:text-left">
                        <p class="text-3xl font-black text-gray-900">10K+</p>
                        <p class="text-sm text-gray-600">Freelancers</p>
                    </div>
                    <div class="text-center lg:text-left">
                        <p class="text-3xl font-black text-gray-900">50K+</p>
                        <p class="text-sm text-gray-600">Projects Done</p>
                    </div>
                    <div class="text-center lg:text-left">
                        <p class="text-3xl font-black text-gray-900">98%</p>
                        <p class="text-sm text-gray-600">Satisfaction</p>
                    </div>
                </div>
            </div>

            <div class="lg:w-1/2">
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-3xl blur-2xl opacity-20"></div>
                    <img class="relative w-full rounded-2xl shadow-2xl" src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80" alt="Team working">
                </div>
            </div>
        </div>
    </header>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">How It Works</h2>
                <p class="text-xl text-gray-600">Get started in three simple steps</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8" x-data="{ activeStep: null }">
                <!-- Step 1 -->
                <div @mouseenter="activeStep = 1" @mouseleave="activeStep = null"
                     class="group relative bg-white p-8 rounded-2xl border-2 border-gray-200 hover:border-indigo-500 shadow-sm hover:shadow-2xl transition-all duration-300 cursor-pointer"
                     :class="{ 'scale-105 border-indigo-500 shadow-2xl': activeStep === 1 }">
                    <div class="absolute -top-6 left-8 w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 text-white rounded-xl flex items-center justify-center text-xl font-bold shadow-lg">
                        1
                    </div>
                    <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-briefcase text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Freelancer Posts Service</h3>
                    <p class="text-gray-600 leading-relaxed">Freelancers create and publish their services with descriptions, pricing, and portfolio images to showcase their expertise.</p>
                    <div class="mt-6 flex items-center text-indigo-600 font-semibold opacity-0 group-hover:opacity-100 transition-opacity">
                        Learn more
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </div>

                <!-- Step 2 -->
                <div @mouseenter="activeStep = 2" @mouseleave="activeStep = null"
                     class="group relative bg-white p-8 rounded-2xl border-2 border-gray-200 hover:border-purple-500 shadow-sm hover:shadow-2xl transition-all duration-300 cursor-pointer"
                     :class="{ 'scale-105 border-purple-500 shadow-2xl': activeStep === 2 }">
                    <div class="absolute -top-6 left-8 w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 text-white rounded-xl flex items-center justify-center text-xl font-bold shadow-lg">
                        2
                    </div>
                    <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-shopping-cart text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Client Places Order</h3>
                    <p class="text-gray-600 leading-relaxed">Clients browse services, select what they need, and place orders with specific requirements and project details.</p>
                    <div class="mt-6 flex items-center text-purple-600 font-semibold opacity-0 group-hover:opacity-100 transition-opacity">
                        Learn more
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </div>

                <!-- Step 3 -->
                <div @mouseenter="activeStep = 3" @mouseleave="activeStep = null"
                     class="group relative bg-white p-8 rounded-2xl border-2 border-gray-200 hover:border-emerald-500 shadow-sm hover:shadow-2xl transition-all duration-300 cursor-pointer"
                     :class="{ 'scale-105 border-emerald-500 shadow-2xl': activeStep === 3 }">
                    <div class="absolute -top-6 left-8 w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 text-white rounded-xl flex items-center justify-center text-xl font-bold shadow-lg">
                        3
                    </div>
                    <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Work Completed</h3>
                    <p class="text-gray-600 leading-relaxed">Freelancer delivers quality work through the platform. Client reviews and marks the order as completed with satisfaction.</p>
                    <div class="mt-6 flex items-center text-emerald-600 font-semibold opacity-0 group-hover:opacity-100 transition-opacity">
                        Learn more
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Services Section -->
    <section class="py-20 bg-gradient-to-br from-gray-50 via-indigo-50/30 to-purple-50/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Services</h2>
                <p class="text-xl text-gray-600">Discover top-rated services from our talented freelancers</p>
            </div>

            @if($services->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                <div class="group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-2xl hover:-translate-y-2 hover:border-indigo-300 transition-all duration-300 overflow-hidden">
                    <!-- Service Image -->
                    <div class="w-full h-48 overflow-hidden bg-gray-100 relative">
                        @if($service->image_path || $service->image_url)
                            @if($service->image_path)
                                <img src="{{ asset('storage/' . $service->image_path) }}" alt="{{ $service->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @elseif($service->image_url)
                                <img src="{{ $service->image_url }}" alt="{{ $service->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @endif
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center">
                                <i class="fas fa-briefcase text-white text-5xl opacity-30"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="px-3 py-1.5 text-xs font-bold uppercase tracking-wider rounded-lg bg-indigo-50 text-indigo-600">
                                {{ $service->category }}
                            </span>
                            <span class="text-2xl font-black text-gray-900">
                                ${{ number_format($service->price, 0) }}
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors line-clamp-2">
                            {{ $service->title }}
                        </h3>

                        <p class="text-sm text-gray-500 leading-relaxed line-clamp-2 mb-4">
                            {{ $service->description }}
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center space-x-2">
                                @if($service->freelancer->profile_picture)
                                    <img src="{{ asset('storage/' . $service->freelancer->profile_picture) }}" alt="{{ $service->freelancer->name }}" class="w-8 h-8 rounded-full object-cover border-2 border-indigo-500">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-xs text-white font-bold">
                                        {{ substr($service->freelancer->name, 0, 1) }}
                                    </div>
                                @endif
                                <span class="text-sm font-semibold text-gray-600">{{ $service->freelancer->name }}</span>
                            </div>

                            <a href="{{ route('services.show', $service) }}" class="inline-flex items-center text-sm font-bold text-indigo-600 hover:text-indigo-700 group">
                                View
                                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('services.index') }}" class="inline-flex items-center px-8 py-4 border-2 border-indigo-600 text-base font-bold rounded-xl text-indigo-600 bg-white hover:bg-indigo-50 shadow-lg hover:shadow-xl transition-all">
                    View All Services
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
            @else
            <div class="text-center py-16 bg-white rounded-3xl border-2 border-dashed border-gray-300">
                <svg class="w-20 h-20 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                <p class="text-gray-500 text-lg mb-4">No services available yet. Be the first to create one!</p>
                <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-bold hover:from-indigo-700 hover:to-purple-700 shadow-lg hover:shadow-xl transition">
                    Get Started
                </a>
            </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">Ready to get started?</h2>
            <p class="text-xl text-white/90 mb-10">Join thousands of freelancers and clients already working together</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-indigo-600 rounded-xl font-bold text-lg hover:bg-gray-100 shadow-2xl hover:shadow-3xl transition-all">
                    Sign Up Free
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
                <a href="{{ route('services.index') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white border-2 border-white/30 rounded-xl font-bold text-lg hover:bg-white/20 transition-all">
                    Browse Services
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-bolt text-white"></i>
                        </div>
                        <span class="text-2xl font-bold text-white">FreelanceHub</span>
                    </div>
                    <p class="text-gray-400 mb-4">Connecting talented freelancers with clients worldwide. Quality work, delivered on time.</p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('services.index') }}" class="hover:text-white transition">Browse Services</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white transition">Become a Freelancer</a></li>
                        <li><a href="#how-it-works" class="hover:text-white transition">How It Works</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Support</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center">
                <p>&copy; <?php echo date('Y'); ?> FreelanceHub. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
