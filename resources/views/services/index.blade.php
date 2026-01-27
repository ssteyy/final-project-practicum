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
                        <div class="group relative flex flex-col bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                            
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