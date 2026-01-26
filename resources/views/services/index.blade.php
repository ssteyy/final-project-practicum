<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-zinc-900 dark:text-white leading-tight tracking-tight">
            {{ __('Browse Services') }}
        </h2>
    </x-slot>
    <div class="py-12 bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:from-zinc-950 dark:via-zinc-900 dark:to-zinc-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 dark:bg-zinc-900/90 overflow-hidden shadow-2xl sm:rounded-3xl border border-zinc-200 dark:border-zinc-800">
                <div class="p-10 text-zinc-900 dark:text-zinc-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                        @forelse ($services as $service)
                            <div class="bg-white border border-gray-200 rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 overflow-hidden flex flex-col">
                                @if($service->image_path || $service->image_url)
                                    <img src="{{ $service->image_path ? asset('storage/' . $service->image_path) : $service->image_url }}"
                                         alt="{{ $service->title }}"
                                         class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center">
                                        <i class="fas fa-image text-indigo-300 text-5xl"></i>
                                    </div>
                                @endif
                                <div class="p-6 flex flex-col flex-grow">
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $service->title }}</h3>
                                        <p class="text-base text-gray-600 mb-4">{{ Str::limit($service->description, 120) }}</p>
                                    </div>
                                    <div class="flex justify-between items-center text-sm mb-4">
                                        <span class="font-semibold text-gray-700">By: {{ $service->freelancer->name }}</span>
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                            {{ $service->category }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center mt-auto pt-2">
                                        <span class="text-2xl font-extrabold text-green-600">${{ number_format($service->price, 2) }}</span>
                                        <a href="{{ route('services.show', $service) }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-xl font-semibold text-base text-white uppercase tracking-widest hover:scale-105 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all">
                                            {{ __('View Details') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="col-span-3 text-center text-zinc-500 dark:text-zinc-400">No published services found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
