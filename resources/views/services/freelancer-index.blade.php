<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('services.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('Create New Service') }}
                        </a>
                    </div>

                    @if (session('status'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('status') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($services as $service)
                            <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition duration-300 overflow-hidden">
                                @if($service->image_path || $service->image_url)
                                    <img src="{{ $service->image_path ? asset('storage/' . $service->image_path) : $service->image_url }}"
                                         alt="{{ $service->title }}"
                                         class="w-full h-40 object-cover">
                                @else
                                    <div class="w-full h-40 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-300 text-4xl"></i>
                                    </div>
                                @endif
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold mb-2 text-gray-900">{{ $service->title }}</h3>
                                    <p class="text-sm text-gray-600 mb-3">{{ Str::limit($service->description, 100) }}</p>
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="font-bold text-indigo-600">${{ number_format($service->price, 2) }}</span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $service->status === 'published' ? 'bg-green-200 text-green-800' : ($service->status === 'draft' ? 'bg-yellow-200 text-yellow-800' : 'bg-red-200 text-red-800') }}">
                                            {{ ucfirst($service->status) }}
                                        </span>
                                    </div>
                                    <div class="mt-4 flex space-x-2">
                                        <a href="{{ route('services.edit', $service) }}" class="text-sm text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <form action="{{ route('services.destroy', $service) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="col-span-3 text-center text-gray-500 dark:text-gray-400">You have not created any services yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
