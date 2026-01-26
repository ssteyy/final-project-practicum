<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:from-zinc-950 dark:via-zinc-900 dark:to-zinc-950 py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/90 dark:bg-zinc-900/90 border border-zinc-200 dark:border-zinc-800 rounded-3xl shadow-xl shadow-zinc-200/50 dark:shadow-none overflow-hidden">
                <div class="px-10 py-8 border-b border-zinc-100 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-800/50">
                    <h2 class="text-3xl font-extrabold text-zinc-900 dark:text-white">Create New Service</h2>
                    <p class="text-zinc-500 dark:text-zinc-400 text-base mt-2">Fill in the details below to launch your new service offering.</p>
                </div>
                <div class="p-10">
                    <form method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data" class="space-y-8">
                        @csrf

                        <!-- Image Upload Section -->
                        <div>
                            <label class="block text-base font-semibold text-zinc-700 dark:text-zinc-300 mb-2">Service Image</label>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-3">Upload an image from your device or provide an image URL</p>

                            <div class="space-y-4">
                                <!-- Tab Buttons -->
                                <div class="flex gap-2 border-b border-zinc-200 dark:border-zinc-800">
                                    <button type="button" onclick="switchImageTab('upload')" id="upload-tab" class="px-4 py-2 text-sm font-semibold border-b-2 border-indigo-600 text-indigo-600">
                                        <i class="fas fa-upload mr-2"></i>Upload File
                                    </button>
                                    <button type="button" onclick="switchImageTab('url')" id="url-tab" class="px-4 py-2 text-sm font-semibold border-b-2 border-transparent text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200">
                                        <i class="fas fa-link mr-2"></i>Image URL
                                    </button>
                                </div>

                                <!-- Upload Tab Content -->
                                <div id="upload-content" class="space-y-3">
                                    <div class="relative">
                                        <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)" class="hidden">
                                        <label for="image" class="flex items-center justify-center w-full px-5 py-4 border-2 border-dashed border-zinc-300 dark:border-zinc-700 rounded-2xl cursor-pointer hover:border-indigo-500 hover:bg-indigo-50/50 dark:hover:bg-indigo-900/10 transition-all">
                                            <div class="text-center">
                                                <i class="fas fa-cloud-upload-alt text-4xl text-zinc-400 mb-2"></i>
                                                <p class="text-base font-semibold text-zinc-700 dark:text-zinc-300">Click to upload image</p>
                                                <p class="text-xs text-zinc-500 mt-1">or drag and drop</p>
                                            </div>
                                        </label>
                                        <div id="file-name" class="hidden mt-2 text-sm text-zinc-600 dark:text-zinc-400"></div>
                                    </div>
                                    <p class="text-xs text-zinc-500">Supported formats: JPEG, PNG, JPG, GIF, WEBP (Max: 2MB)</p>
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />

                                    <!-- Image Preview -->
                                    <div id="image-preview" class="hidden mt-4">
                                        <img id="preview-img" src="" alt="Preview" class="w-full max-w-md h-48 object-cover rounded-2xl border-2 border-zinc-200 dark:border-zinc-800">
                                        <button type="button" onclick="clearImage()" class="mt-2 text-sm text-red-600 hover:text-red-700 font-semibold">
                                            <i class="fas fa-times mr-1"></i>Remove Image
                                        </button>
                                    </div>
                                </div>

                                <!-- URL Tab Content -->
                                <div id="url-content" class="hidden space-y-3">
                                    <input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}" placeholder="https://example.com/image.jpg" onchange="previewImageUrl(event)"
                                        class="block w-full px-5 py-4 rounded-2xl border-zinc-200 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 text-lg shadow-sm transition-all placeholder:text-zinc-400">
                                    <p class="text-xs text-zinc-500">Enter a direct link to an image</p>
                                    <x-input-error :messages="$errors->get('image_url')" class="mt-2" />

                                    <!-- URL Image Preview -->
                                    <div id="url-preview" class="hidden mt-4">
                                        <img id="url-preview-img" src="" alt="Preview" class="w-full max-w-md h-48 object-cover rounded-2xl border-2 border-zinc-200 dark:border-zinc-800">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            function switchImageTab(tab) {
                                const uploadTab = document.getElementById('upload-tab');
                                const urlTab = document.getElementById('url-tab');
                                const uploadContent = document.getElementById('upload-content');
                                const urlContent = document.getElementById('url-content');
                                const imageInput = document.getElementById('image');
                                const imageUrlInput = document.getElementById('image_url');

                                if (tab === 'upload') {
                                    uploadTab.classList.add('border-indigo-600', 'text-indigo-600');
                                    uploadTab.classList.remove('border-transparent', 'text-zinc-500');
                                    urlTab.classList.remove('border-indigo-600', 'text-indigo-600');
                                    urlTab.classList.add('border-transparent', 'text-zinc-500');
                                    uploadContent.classList.remove('hidden');
                                    urlContent.classList.add('hidden');
                                    imageUrlInput.value = '';
                                    document.getElementById('url-preview').classList.add('hidden');
                                } else {
                                    urlTab.classList.add('border-indigo-600', 'text-indigo-600');
                                    urlTab.classList.remove('border-transparent', 'text-zinc-500');
                                    uploadTab.classList.remove('border-indigo-600', 'text-indigo-600');
                                    uploadTab.classList.add('border-transparent', 'text-zinc-500');
                                    urlContent.classList.remove('hidden');
                                    uploadContent.classList.add('hidden');
                                    imageInput.value = '';
                                    document.getElementById('image-preview').classList.add('hidden');
                                }
                            }

                            function previewImage(event) {
                                const file = event.target.files[0];
                                if (file) {
                                    // Show filename
                                    const fileNameDiv = document.getElementById('file-name');
                                    fileNameDiv.textContent = '📎 ' + file.name;
                                    fileNameDiv.classList.remove('hidden');

                                    // Show preview
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        document.getElementById('preview-img').src = e.target.result;
                                        document.getElementById('image-preview').classList.remove('hidden');
                                    }
                                    reader.readAsDataURL(file);
                                }
                            }

                            function previewImageUrl(event) {
                                const url = event.target.value;
                                if (url) {
                                    document.getElementById('url-preview-img').src = url;
                                    document.getElementById('url-preview').classList.remove('hidden');
                                }
                            }

                            function clearImage() {
                                document.getElementById('image').value = '';
                                document.getElementById('image-preview').classList.add('hidden');
                                document.getElementById('file-name').classList.add('hidden');
                            }
                        </script>

                        <div>
                            <label for="title" class="block text-base font-semibold text-zinc-700 dark:text-zinc-300 mb-2">Service Title</label>
                            <input id="title" type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Premium Web Design" required autofocus
                                class="block w-full px-5 py-4 rounded-2xl border-zinc-200 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 text-lg shadow-sm transition-all placeholder:text-zinc-400">
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div>
                            <label for="description" class="block text-base font-semibold text-zinc-700 dark:text-zinc-300 mb-2">Detailed Description</label>
                            <textarea id="description" name="description" rows="5" placeholder="Describe what the client receives..." required
                                class="block w-full px-5 py-4 rounded-2xl border-zinc-200 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 text-lg shadow-sm transition-all placeholder:text-zinc-400">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="price" class="block text-base font-semibold text-zinc-700 dark:text-zinc-300 mb-2">Price ($)</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-4 text-zinc-400 font-medium">$</span>
                                    <input id="price" type="number" step="0.01" min="0.01" name="price" value="{{ old('price') }}" required
                                        class="block w-full pl-10 pr-4 py-4 rounded-2xl border-zinc-200 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 text-lg shadow-sm transition-all">
                                </div>
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                            <div>
                                <label for="category_select" class="block text-base font-semibold text-zinc-700 dark:text-zinc-300 mb-2">Category</label>
                                <select id="category_select" name="category_select" required onchange="toggleCategoryInput(this.value)"
                                    class="block w-full px-5 py-4 rounded-2xl border-zinc-200 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 text-lg shadow-sm transition-all appearance-none">
                                    <option value="">Select a category</option>
                                    <option value="Web Development" {{ old('category') == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                                    <option value="Mobile Development" {{ old('category') == 'Mobile Development' ? 'selected' : '' }}>Mobile Development</option>
                                    <option value="Graphic Design" {{ old('category') == 'Graphic Design' ? 'selected' : '' }}>Graphic Design</option>
                                    <option value="UI/UX Design" {{ old('category') == 'UI/UX Design' ? 'selected' : '' }}>UI/UX Design</option>
                                    <option value="Content Writing" {{ old('category') == 'Content Writing' ? 'selected' : '' }}>Content Writing</option>
                                    <option value="Digital Marketing" {{ old('category') == 'Digital Marketing' ? 'selected' : '' }}>Digital Marketing</option>
                                    <option value="SEO Services" {{ old('category') == 'SEO Services' ? 'selected' : '' }}>SEO Services</option>
                                    <option value="Video Editing" {{ old('category') == 'Video Editing' ? 'selected' : '' }}>Video Editing</option>
                                    <option value="Data Entry" {{ old('category') == 'Data Entry' ? 'selected' : '' }}>Data Entry</option>
                                    <option value="Virtual Assistant" {{ old('category') == 'Virtual Assistant' ? 'selected' : '' }}>Virtual Assistant</option>
                                    <option value="Others">Others (Specify)</option>
                                </select>
                                <input type="hidden" id="category" name="category" value="{{ old('category') }}">
                                <input id="category_other" type="text" name="category_other" value="{{ old('category_other') }}" placeholder="Enter your category"
                                    class="hidden mt-3 block w-full px-5 py-4 rounded-2xl border-zinc-200 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 text-lg shadow-sm transition-all">
                                <x-input-error :messages="$errors->get('category')" class="mt-2" />

                                <script>
                                    function toggleCategoryInput(value) {
                                        const categoryOther = document.getElementById('category_other');
                                        const categoryHidden = document.getElementById('category');

                                        if (value === 'Others') {
                                            categoryOther.classList.remove('hidden');
                                            categoryOther.required = true;
                                            categoryHidden.value = '';
                                        } else {
                                            categoryOther.classList.add('hidden');
                                            categoryOther.required = false;
                                            categoryHidden.value = value;
                                        }
                                    }

                                    // Update hidden field when typing in "Others" input
                                    document.getElementById('category_other').addEventListener('input', function() {
                                        document.getElementById('category').value = this.value;
                                    });

                                    // Initialize on page load
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const oldCategory = '{{ old("category") }}';
                                        const select = document.getElementById('category_select');
                                        const predefinedCategories = ['Web Development', 'Mobile Development', 'Graphic Design', 'UI/UX Design', 'Content Writing', 'Digital Marketing', 'SEO Services', 'Video Editing', 'Data Entry', 'Virtual Assistant'];

                                        if (oldCategory && !predefinedCategories.includes(oldCategory)) {
                                            select.value = 'Others';
                                            toggleCategoryInput('Others');
                                            document.getElementById('category_other').value = oldCategory;
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                        <div>
                            <label for="status" class="block text-base font-semibold text-zinc-700 dark:text-zinc-300 mb-2">Publication Status</label>
                            <select id="status" name="status" required
                                class="block w-full px-5 py-4 rounded-2xl border-zinc-200 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 text-lg shadow-sm transition-all appearance-none">
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Live)</option>
                                <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                        <div class="pt-8 flex items-center justify-end border-t border-zinc-100 dark:border-zinc-800 gap-4">
                            <button type="button" onclick="window.history.back()" class="px-8 py-3 text-base font-semibold text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-colors rounded-xl">
                                Cancel
                            </button>
                            <button type="submit" class="px-10 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-base font-bold rounded-2xl shadow-lg hover:scale-[1.03] hover:shadow-xl transition-transform active:scale-100">
                                <svg class="inline w-5 h-5 mr-2 -mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                Create Service
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
