<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Browse Services') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 via-indigo-50/30 to-purple-50/30 dark:bg-gray-900/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar Filters -->
                <aside class="lg:w-72 flex-shrink-0">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 sticky top-24">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Categories
                        </h3>

                        <div class="space-y-2">
                            <a href="{{ route('services.index') }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition {{ !request('category') ? 'bg-indigo-50 dark:bg-indigo-900/30 border-2 border-indigo-500 shadow-sm' : 'border-2 border-transparent' }}">
                                <span class="text-sm font-bold text-gray-700 dark:text-gray-300">All Categories</span>
                                <span class="px-2.5 py-1 text-xs font-bold rounded-full {{ !request('category') ? 'bg-indigo-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }}">
                                    {{ \App\Models\Service::where('status', 'published')->count() }}
                                </span>
                            </a>
                            @foreach($categories as $cat)
                                <a href="{{ route('services.index', ['category' => $cat]) }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition {{ request('category') === $cat ? 'bg-indigo-50 dark:bg-indigo-900/30 border-2 border-indigo-500 shadow-sm' : 'border-2 border-transparent' }}">
                                    <span class="text-sm font-bold text-gray-700 dark:text-gray-300">{{ $cat }}</span>
                                    <span class="px-2.5 py-1 text-xs font-bold rounded-full {{ request('category') === $cat ? 'bg-indigo-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }}">
                                        {{ \App\Models\Service::where('status', 'published')->where('category', $cat)->count() }}
                                    </span>
                                </a>
                            @endforeach
                        </div>

                        @if(request('category'))
                            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <a href="{{ route('services.index') }}" class="flex items-center justify-center w-full px-4 py-2.5 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl font-bold text-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Clear Filter
                                </a>
                            </div>
                        @endif
                    </div>
                </aside>

                <!-- Services Grid -->
                <div class="flex-1">
                    <div class="mb-6 flex items-center justify-between">
                        <p class="text-gray-600 dark:text-gray-400 font-semibold">
                            <span class="text-2xl font-black text-indigo-600 dark:text-indigo-400">{{ $services->count() }}</span>
                            {{ Str::plural('service', $services->count()) }} found
                        </p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @forelse ($services as $service)
                    <div class="group bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-2xl hover:-translate-y-2 hover:border-indigo-300 dark:hover:border-indigo-600 transition-all duration-300 overflow-hidden">
                        <!-- Service Image -->
                        <div class="w-full h-48 overflow-hidden bg-gray-100 dark:bg-gray-700 relative">
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
                                <span class="px-3 py-1.5 text-xs font-bold uppercase tracking-wider rounded-lg bg-indigo-50 text-indigo-600 dark:bg-indigo-900/40 dark:text-indigo-300">
                                    {{ $service->category }}
                                </span>
                                <span class="text-2xl font-black text-gray-900 dark:text-white">
                                    ${{ number_format($service->price, 0) }}
                                </span>
                            </div>

                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors line-clamp-2">
                                {{ $service->title }}
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed line-clamp-2 mb-4">
                                {{ $service->description }}
                            </p>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                                <div class="flex items-center space-x-2">
                                    @if($service->freelancer->profile_picture)
                                        <img src="{{ asset('storage/' . $service->freelancer->profile_picture) }}" alt="{{ $service->freelancer->name }}" class="w-8 h-8 rounded-full object-cover border-2 border-indigo-500">
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-xs text-white font-bold">
                                            {{ substr($service->freelancer->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <span class="text-sm font-semibold text-gray-600 dark:text-gray-300">{{ $service->freelancer->name }}</span>
                                </div>

                                <a href="{{ route('services.show', $service) }}" class="inline-flex items-center text-sm font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 group">
                                    View
                                    <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white dark:bg-gray-800 rounded-3xl border-2 border-dashed border-gray-300 dark:border-gray-700">
                        <svg class="w-20 h-20 text-gray-400 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        <p class="text-gray-500 dark:text-gray-400 text-lg mb-4">No services available yet. Be the first to create one!</p>
                        <a href="{{ route('services.create') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-bold hover:from-indigo-700 hover:to-purple-700 shadow-lg hover:shadow-xl transition">
                            Get Started
                        </a>
                    </div>
                    @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
