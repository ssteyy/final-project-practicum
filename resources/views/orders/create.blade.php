<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Place Order for: ') . $service->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6 p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg border border-indigo-200 dark:border-indigo-900">
                        <h3 class="text-lg font-semibold text-indigo-800 dark:text-indigo-200">Service Details</h3>
                        <p class="text-sm text-gray-700 dark:text-gray-300">Freelancer: {{ $service->freelancer->name }}</p>
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">Price: ${{ number_format($service->price, 2) }}</p>
                    </div>

                    <form method="POST" action="{{ route('orders.store') }}">
                        @csrf
                        <input type="hidden" name="service_id" value="{{ $service->id }}">

                        <!-- Requirements -->
                        <div>
                            <x-input-label for="requirements" :value="__('Your Requirements (Be specific)')" />
                            <textarea id="requirements" name="requirements" rows="6" class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('requirements') }}</textarea>
                            <x-input-error :messages="$errors->get('requirements')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Confirm Order') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
