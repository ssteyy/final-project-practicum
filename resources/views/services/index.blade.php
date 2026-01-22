<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Browse Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($services as $service)
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $service->title }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ Str::limit($service->description, 150) }}</p>
                                <div class="flex justify-between items-center text-sm mb-4">
                                    <span class="font-semibold text-gray-700 dark:text-gray-300">By: {{ $service->freelancer->name }}</span>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300">
                                        {{ $service->category }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-2xl font-extrabold text-green-600 dark:text-green-400">${{ number_format($service->price, 2) }}</span>
                                    <a href="{{ route('services.show', $service) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        {{ __('View Details') }}
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="col-span-3 text-center text-gray-500 dark:text-gray-400">No published services found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
