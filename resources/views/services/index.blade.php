<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Browse Services') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50 dark:bg-gray-900/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-0"> <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($services as $service)
                        <div class="group relative flex flex-col bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-2xl hover:-translate-y-2 hover:border-indigo-300 dark:hover:border-indigo-600 transition-all duration-300 overflow-hidden">

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
                                        <svg class="w-20 h-20 text-white opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                <!-- Overlay gradient -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>

                            <div class="p-6 flex-1">
                                <div class="flex justify-between items-start mb-4">
                                    <span class="px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider rounded-md bg-indigo-50 text-indigo-600 dark:bg-indigo-900/40 dark:text-indigo-300">
                                        {{ $service->category }}
                                    </span>
                                    <span class="text-2xl font-black text-gray-900 dark:text-white">
                                        ${{ number_format($service->price, 0) }}
                                    </span>
                                </div>

                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-indigo-600 transition-colors">
                                    {{ $service->title }}
                                </h3>

                                <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed line-clamp-3">
                                    {{ $service->description }}
                                </p>
                            </div>

                            <div class="px-6 py-4 bg-gray-50/50 dark:bg-gray-700/30 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <div class="w-7 h-7 rounded-full bg-indigo-500 flex items-center justify-center text-[10px] text-white font-bold">
                                        {{ substr($service->freelancer->name, 0, 1) }}
                                    </div>
                                    <span class="text-xs font-semibold text-gray-600 dark:text-gray-300">{{ $service->freelancer->name }}</span>
                                </div>

                                <a href="{{ route('services.show', $service) }}" class="text-sm font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 flex items-center group">
                                    Details
                                    <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full flex flex-col items-center justify-center py-20 bg-white dark:bg-gray-800 rounded-3xl border-2 border-dashed border-gray-200 dark:border-gray-700">
                            <p class="text-gray-500 dark:text-gray-400 font-medium">No published services found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
