<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Service: ') . $service->title }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 via-indigo-50/20 to-purple-50/20 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-6 text-center">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Edit Your Service</h1>
                <p class="text-gray-600 dark:text-gray-400">Update your service details and settings</p>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-200 dark:border-gray-700">
                <div class="p-8 lg:p-10 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('services.update', $service) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Service Image Section -->
                        <div class="mb-8 p-6 bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-gray-700 dark:to-gray-800 rounded-xl border-2 border-dashed border-indigo-300 dark:border-indigo-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Service Image
                            </h3>

                            <!-- Current Image Display -->
                            @if($service->image_path || $service->image_url)
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2 font-medium">Current Image:</p>
                                <div class="relative group">
                                    @if($service->image_path)
                                        <img src="{{ asset('storage/' . $service->image_path) }}" alt="{{ $service->title }}" class="w-full h-64 object-cover rounded-lg shadow-lg">
                                    @elseif($service->image_url)
                                        <img src="{{ $service->image_url }}" alt="{{ $service->title }}" class="w-full h-64 object-cover rounded-lg shadow-lg">
                                    @endif
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-200 rounded-lg flex items-center justify-center">
                                        <p class="text-white opacity-0 group-hover:opacity-100 transition-opacity duration-200 font-semibold">Upload new image to replace</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Image Preview Area for New Upload -->
                            <div id="imagePreview" class="hidden mb-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2 font-medium">New Image Preview:</p>
                                <img id="previewImg" src="" alt="Preview" class="w-full h-64 object-cover rounded-lg shadow-lg">
                            </div>

                            <!-- Image Upload (File) -->
                            <div class="mb-4">
                                <label for="image_path" class="flex flex-col items-center justify-center w-full h-48 border-2 border-indigo-300 dark:border-indigo-600 border-dashed rounded-lg cursor-pointer bg-white dark:bg-gray-900 hover:bg-indigo-50 dark:hover:bg-gray-800 transition-all duration-200">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-12 h-12 mb-3 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-700 dark:text-gray-300 font-semibold">
                                            <span class="text-indigo-600 dark:text-indigo-400">Click to upload new image</span> or drag and drop
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF, SVG up to 2MB</p>
                                    </div>
                                    <input id="image_path" name="image_path" type="file" class="hidden" accept="image/*" onchange="previewImage(event)" />
                                </label>
                                <x-input-error :messages="$errors->get('image_path')" class="mt-2" />
                            </div>

                            <!-- Divider -->
                            <div class="relative my-6">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-indigo-300 dark:border-indigo-600"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-4 bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-gray-700 dark:to-gray-800 text-gray-600 dark:text-gray-300 font-medium">OR</span>
                                </div>
                            </div>

                            <!-- Image URL -->
                            <div>
                                <x-input-label for="image_url" :value="__('Image URL')" class="text-gray-700 dark:text-gray-300" />
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                        </svg>
                                    </div>
                                    <input id="image_url" name="image_url" type="url" value="{{ old('image_url', $service->image_url) }}" placeholder="https://example.com/image.jpg" class="pl-10 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" />
                                </div>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Paste an image URL as an alternative to uploading</p>
                                <x-input-error :messages="$errors->get('image_url')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Service Information Section -->
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Service Information
                            </h3>

                            <!-- Title -->
                            <div class="mb-6">
                                <x-input-label for="title" :value="__('Service Title')" class="text-base font-semibold" />
                                <x-text-input id="title" class="block mt-2 w-full text-lg" type="text" name="title" :value="old('title', $service->title)" required autofocus />
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Choose a clear, descriptive title that highlights your service</p>
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <!-- Description -->
                            <div>
                                <x-input-label for="description" :value="__('Description')" class="text-base font-semibold" />
                                <textarea id="description" name="description" rows="6" class="block mt-2 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm" required>{{ old('description', $service->description) }}</textarea>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Provide a detailed description to help clients understand what you offer</p>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Pricing & Category Section -->
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                Pricing & Category
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Price -->
                                <div>
                                    <x-input-label for="price" :value="__('Service Price ($)')" class="text-base font-semibold" />
                                    <div class="mt-2 relative rounded-xl shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <span class="text-gray-500 dark:text-gray-400 text-lg font-bold">$</span>
                                        </div>
                                        <input id="price" type="number" step="0.01" min="0.01" name="price" value="{{ old('price', $service->price) }}" required class="pl-8 block w-full text-lg font-semibold border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm" />
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Set a competitive price for your service</p>
                                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                </div>

                                <!-- Category -->
                                <div>
                                    <x-input-label for="category" :value="__('Category')" class="text-base font-semibold" />
                                <select id="category_select" class="mt-2 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm text-base" onchange="toggleCategoryInput()" required>
                                    <option value="">Select a category</option>
                                    <option value="Web Development" {{ old('category', $service->category) == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                                    <option value="Mobile Development" {{ old('category', $service->category) == 'Mobile Development' ? 'selected' : '' }}>Mobile Development</option>
                                    <option value="Graphic Design" {{ old('category', $service->category) == 'Graphic Design' ? 'selected' : '' }}>Graphic Design</option>
                                    <option value="UI/UX Design" {{ old('category', $service->category) == 'UI/UX Design' ? 'selected' : '' }}>UI/UX Design</option>
                                    <option value="Content Writing" {{ old('category', $service->category) == 'Content Writing' ? 'selected' : '' }}>Content Writing</option>
                                    <option value="Digital Marketing" {{ old('category', $service->category) == 'Digital Marketing' ? 'selected' : '' }}>Digital Marketing</option>
                                    <option value="Video Editing" {{ old('category', $service->category) == 'Video Editing' ? 'selected' : '' }}>Video Editing</option>
                                    <option value="Data Entry" {{ old('category', $service->category) == 'Data Entry' ? 'selected' : '' }}>Data Entry</option>
                                    <option value="Virtual Assistant" {{ old('category', $service->category) == 'Virtual Assistant' ? 'selected' : '' }}>Virtual Assistant</option>
                                    <option value="Others" {{ old('category', $service->category) && !in_array(old('category', $service->category), ['Web Development', 'Mobile Development', 'Graphic Design', 'UI/UX Design', 'Content Writing', 'Digital Marketing', 'Video Editing', 'Data Entry', 'Virtual Assistant']) ? 'selected' : '' }}>Others</option>
                                </select>
                                <input type="text" id="category_input" name="category" class="hidden mt-2 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm text-base" placeholder="Enter custom category" value="{{ old('category', $service->category) }}" />
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Choose the category that best fits your service</p>
                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Publication Settings Section -->
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                Publication Settings
                            </h3>

                            <!-- Status -->
                            <div>
                                <x-input-label for="status" :value="__('Visibility Status')" class="text-base font-semibold" />
                                <select id="status" name="status" class="mt-2 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm text-base" required>
                                    <option value="draft" {{ old('status', $service->status) == 'draft' ? 'selected' : '' }}>Draft - Save for later</option>
                                    <option value="published" {{ old('status', $service->status) == 'published' ? 'selected' : '' }}>Published - Visible to clients</option>
                                    <option value="archived" {{ old('status', $service->status) == 'archived' ? 'selected' : '' }}>Archived - Hidden from clients</option>
                                </select>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Control who can see your service</p>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between pt-8 border-t-2 border-gray-200 dark:border-gray-700">
                            <a href="{{ route('services.index') }}" class="inline-flex items-center px-6 py-3 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-xl font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-xl font-bold text-base text-white uppercase tracking-wider hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                {{ __('Update Service') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        function toggleCategoryInput() {
            const select = document.getElementById('category_select');
            const input = document.getElementById('category_input');

            if (select.value === 'Others') {
                input.classList.remove('hidden');
                input.required = true;
                // Keep the current value if it's a custom category
                if (!['Web Development', 'Mobile Development', 'Graphic Design', 'UI/UX Design', 'Content Writing', 'Digital Marketing', 'Video Editing', 'Data Entry', 'Virtual Assistant'].includes(input.value)) {
                    // Value is already set from old() or $service->category
                } else {
                    input.value = '';
                }
            } else {
                input.classList.add('hidden');
                input.required = false;
                input.value = select.value;
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleCategoryInput();
        });
    </script>
</x-app-layout>
