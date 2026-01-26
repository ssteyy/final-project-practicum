<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:from-zinc-950 dark:via-zinc-900 dark:to-zinc-950 py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-10">
                <nav class="flex items-center text-sm font-medium text-zinc-500 mb-2">
                    <a href="{{ route('services.index') }}" class="hover:text-indigo-600 transition-colors">Services</a>
                    <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="text-zinc-900 dark:text-zinc-100">Edit Service</span>
                </nav>
                <div class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest border shadow-sm
                    {{
                        $service->status === 'published' ? 'bg-emerald-50 text-emerald-700 border-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400 dark:border-emerald-500/20' :
                        ($service->status === 'draft' ? 'bg-amber-50 text-amber-700 border-amber-100 dark:bg-amber-500/10 dark:text-amber-400 dark:border-amber-500/20' :
                        'bg-zinc-50 text-zinc-700 border-zinc-100 dark:bg-zinc-500/10 dark:text-zinc-400 dark:border-zinc-500/20')
                    }}">
                    {{ ucfirst($service->status) }}
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white/90 dark:bg-zinc-900/90 border border-zinc-200 dark:border-zinc-800 rounded-3xl shadow-xl overflow-hidden">
                        <div class="p-10">
                            <form method="POST" action="{{ route('services.update', $service) }}" enctype="multipart/form-data" class="space-y-8">
                                @csrf
                                @method('PUT')

                                <!-- Current Image Display -->
                                @if($service->image_path || $service->image_url)
                                <div class="mb-6">
                                    <label class="block text-base font-semibold text-zinc-700 dark:text-zinc-300 mb-2">Current Image</label>
                                    <img src="{{ $service->image_path ? asset('storage/' . $service->image_path) : $service->image_url }}"
                                         alt="{{ $service->title }}"
                                         class="w-full max-w-md h-48 object-cover rounded-2xl border-2 border-zinc-200 dark:border-zinc-800">
                                </div>
                                @endif

                                <!-- Image Upload Section -->
                                <div>
                                    <label class="block text-base font-semibold text-zinc-700 dark:text-zinc-300 mb-2">Update Service Image</label>
                                    <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-3">Upload a new image or provide an image URL</p>

                                    <div class="space-y-4">
                                        <!-- Tab Buttons -->
                                        <div class="flex gap-2 border-b border-zinc-200 dark:border-zinc-800">
                                            <button type="button" onclick="switchImageTabEdit('upload')" id="upload-tab-edit" class="px-4 py-2 text-sm font-semibold border-b-2 border-indigo-600 text-indigo-600">
                                                <i class="fas fa-upload mr-2"></i>Upload File
                                            </button>
                                            <button type="button" onclick="switchImageTabEdit('url')" id="url-tab-edit" class="px-4 py-2 text-sm font-semibold border-b-2 border-transparent text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200">
                                                <i class="fas fa-link mr-2"></i>Image URL
                                            </button>
                                        </div>

                                        <!-- Upload Tab Content -->
                                        <div id="upload-content-edit" class="space-y-3">
                                            <div class="relative">
                                                <input type="file" id="image-edit" name="image" accept="image/*" onchange="previewImageEdit(event)" class="hidden">
                                                <label for="image-edit" class="flex items-center justify-center w-full px-5 py-4 border-2 border-dashed border-zinc-300 dark:border-zinc-700 rounded-2xl cursor-pointer hover:border-indigo-500 hover:bg-indigo-50/50 dark:hover:bg-indigo-900/10 transition-all">
                                                    <div class="text-center">
                                                        <i class="fas fa-cloud-upload-alt text-4xl text-zinc-400 mb-2"></i>
                                                        <p class="text-base font-semibold text-zinc-700 dark:text-zinc-300">Click to upload new image</p>
                                                        <p class="text-xs text-zinc-500 mt-1">or drag and drop</p>
                                                    </div>
                                                </label>
                                                <div id="file-name-edit" class="hidden mt-2 text-sm text-zinc-600 dark:text-zinc-400"></div>
                                            </div>
                                            <p class="text-xs text-zinc-500">Supported formats: JPEG, PNG, JPG, GIF, WEBP (Max: 2MB)</p>
                                            <x-input-error :messages="$errors->get('image')" class="mt-2" />

                                            <!-- Image Preview -->
                                            <div id="image-preview-edit" class="hidden mt-4">
                                                <img id="preview-img-edit" src="" alt="Preview" class="w-full max-w-md h-48 object-cover rounded-2xl border-2 border-zinc-200 dark:border-zinc-800">
                                                <button type="button" onclick="clearImageEdit()" class="mt-2 text-sm text-red-600 hover:text-red-700 font-semibold">
                                                    <i class="fas fa-times mr-1"></i>Remove Image
                                                </button>
                                            </div>
                                        </div>

                                        <!-- URL Tab Content -->
                                        <div id="url-content-edit" class="hidden space-y-3">
                                            <input type="url" id="image_url-edit" name="image_url" value="{{ old('image_url', $service->image_url) }}" placeholder="https://example.com/image.jpg" onchange="previewImageUrlEdit(event)"
                                                class="block w-full px-5 py-4 rounded-2xl border-zinc-200 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 text-lg shadow-sm transition-all placeholder:text-zinc-400">
                                            <p class="text-xs text-zinc-500">Enter a direct link to an image</p>
                                            <x-input-error :messages="$errors->get('image_url')" class="mt-2" />

                                            <!-- URL Image Preview -->
                                            <div id="url-preview-edit" class="hidden mt-4">
                                                <img id="url-preview-img-edit" src="" alt="Preview" class="w-full max-w-md h-48 object-cover rounded-2xl border-2 border-zinc-200 dark:border-zinc-800">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function switchImageTabEdit(tab) {
                                        const uploadTab = document.getElementById('upload-tab-edit');
                                        const urlTab = document.getElementById('url-tab-edit');
                                        const uploadContent = document.getElementById('upload-content-edit');
                                        const urlContent = document.getElementById('url-content-edit');
                                        const imageInput = document.getElementById('image-edit');
                                        const imageUrlInput = document.getElementById('image_url-edit');

                                        if (tab === 'upload') {
                                            uploadTab.classList.add('border-indigo-600', 'text-indigo-600');
                                            uploadTab.classList.remove('border-transparent', 'text-zinc-500');
                                            urlTab.classList.remove('border-indigo-600', 'text-indigo-600');
                                            urlTab.classList.add('border-transparent', 'text-zinc-500');
                                            uploadContent.classList.remove('hidden');
                                            urlContent.classList.add('hidden');
                                            imageUrlInput.value = '';
                                            document.getElementById('url-preview-edit').classList.add('hidden');
                                        } else {
                                            urlTab.classList.add('border-indigo-600', 'text-indigo-600');
                                            urlTab.classList.remove('border-transparent', 'text-zinc-500');
                                            uploadTab.classList.remove('border-indigo-600', 'text-indigo-600');
                                            uploadTab.classList.add('border-transparent', 'text-zinc-500');
                                            urlContent.classList.remove('hidden');
                                            uploadContent.classList.add('hidden');
                                            imageInput.value = '';
                                            document.getElementById('image-preview-edit').classList.add('hidden');
                                        }
                                    }

                                    function previewImageEdit(event) {
                                        const file = event.target.files[0];
                                        if (file) {
                                            // Show filename
                                            const fileNameDiv = document.getElementById('file-name-edit');
                                            fileNameDiv.textContent = '📎 ' + file.name;
                                            fileNameDiv.classList.remove('hidden');

                                            // Show preview
                                            const reader = new FileReader();
                                            reader.onload = function(e) {
                                                document.getElementById('preview-img-edit').src = e.target.result;
                                                document.getElementById('image-preview-edit').classList.remove('hidden');
                                            }
                                            reader.readAsDataURL(file);
                                        }
                                    }

                                    function previewImageUrlEdit(event) {
                                        const url = event.target.value;
                                        if (url) {
                                            document.getElementById('url-preview-img-edit').src = url;
                                            document.getElementById('url-preview-edit').classList.remove('hidden');
                                        }
                                    }

                                    function clearImageEdit() {
                                        document.getElementById('image-edit').value = '';
                                        document.getElementById('image-preview-edit').classList.add('hidden');
                                        document.getElementById('file-name-edit').classList.add('hidden');
                                    }
                                </script>

                                <div>
                                    <label for="title" class="block text-base font-semibold text-zinc-700 dark:text-zinc-300 mb-2">Service Title</label>
                                    <input id="title" type="text" name="title" value="{{ old('title', $service->title) }}" required
                                        class="block w-full px-5 py-4 rounded-2xl border-zinc-200 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 text-lg shadow-sm transition-all">
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>

                                <div>
                                    <label for="description" class="block text-base font-semibold text-zinc-700 dark:text-zinc-300 mb-2">Description</label>
                                    <textarea id="description" name="description" rows="6" required
                                        class="block w-full px-5 py-4 rounded-2xl border-zinc-200 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 text-lg shadow-sm transition-all">{{ old('description', $service->description) }}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div>
                                        <label for="price" class="block text-base font-semibold text-zinc-700 dark:text-zinc-300 mb-2">Price ($)</label>
                                        <div class="relative">
                                            <span class="absolute left-4 top-4 text-zinc-400 font-medium">$</span>
                                            <input id="price" type="number" step="0.01" min="0.01" name="price" value="{{ old('price', $service->price) }}" required
                                                class="block w-full pl-10 pr-4 py-4 rounded-2xl border-zinc-200 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 text-lg shadow-sm transition-all">
                                        </div>
                                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                    </div>

                                    <div>
                                        <label for="category_select" class="block text-base font-semibold text-zinc-700 dark:text-zinc-300 mb-2">Category</label>
                                        <select id="category_select" name="category_select" required onchange="toggleCategoryInputEdit(this.value)"
                                            class="block w-full px-5 py-4 rounded-2xl border-zinc-200 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 text-lg shadow-sm transition-all appearance-none">
                                            <option value="">Select a category</option>
                                            <option value="Web Development" {{ old('category', $service->category) == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                                            <option value="Mobile Development" {{ old('category', $service->category) == 'Mobile Development' ? 'selected' : '' }}>Mobile Development</option>
                                            <option value="Graphic Design" {{ old('category', $service->category) == 'Graphic Design' ? 'selected' : '' }}>Graphic Design</option>
                                            <option value="UI/UX Design" {{ old('category', $service->category) == 'UI/UX Design' ? 'selected' : '' }}>UI/UX Design</option>
                                            <option value="Content Writing" {{ old('category', $service->category) == 'Content Writing' ? 'selected' : '' }}>Content Writing</option>
                                            <option value="Digital Marketing" {{ old('category', $service->category) == 'Digital Marketing' ? 'selected' : '' }}>Digital Marketing</option>
                                            <option value="SEO Services" {{ old('category', $service->category) == 'SEO Services' ? 'selected' : '' }}>SEO Services</option>
                                            <option value="Video Editing" {{ old('category', $service->category) == 'Video Editing' ? 'selected' : '' }}>Video Editing</option>
                                            <option value="Data Entry" {{ old('category', $service->category) == 'Data Entry' ? 'selected' : '' }}>Data Entry</option>
                                            <option value="Virtual Assistant" {{ old('category', $service->category) == 'Virtual Assistant' ? 'selected' : '' }}>Virtual Assistant</option>
                                            <option value="Others">Others (Specify)</option>
                                        </select>
                                        <input type="hidden" id="category" name="category" value="{{ old('category', $service->category) }}">
                                        <input id="category_other" type="text" name="category_other" value="{{ old('category_other') }}" placeholder="Enter your category"
                                            class="hidden mt-3 block w-full px-5 py-4 rounded-2xl border-zinc-200 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 text-lg shadow-sm transition-all">
                                        <x-input-error :messages="$errors->get('category')" class="mt-2" />

                                        <script>
                                            function toggleCategoryInputEdit(value) {
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
                                                const currentCategory = '{{ old("category", $service->category) }}';
                                                const select = document.getElementById('category_select');
                                                const predefinedCategories = ['Web Development', 'Mobile Development', 'Graphic Design', 'UI/UX Design', 'Content Writing', 'Digital Marketing', 'SEO Services', 'Video Editing', 'Data Entry', 'Virtual Assistant'];

                                                if (currentCategory && !predefinedCategories.includes(currentCategory)) {
                                                    select.value = 'Others';
                                                    toggleCategoryInputEdit('Others');
                                                    document.getElementById('category_other').value = currentCategory;
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>

                                <div>
                                    <label for="status" class="block text-base font-semibold text-zinc-700 dark:text-zinc-300 mb-2">Publication Status</label>
                                    <select id="status" name="status" required
                                        class="block w-full px-5 py-4 rounded-2xl border-zinc-200 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 text-lg shadow-sm transition-all appearance-none">
                                        <option value="draft" {{ old('status', $service->status) == 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                                        <option value="published" {{ old('status', $service->status) == 'published' ? 'selected' : '' }}>Published (Live)</option>
                                        <option value="archived" {{ old('status', $service->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                </div>

                                <div class="flex items-center justify-between pt-6 border-t border-zinc-100 dark:border-zinc-800">
                                    <span class="text-xs text-zinc-500">Last updated: {{ $service->updated_at->diffForHumans() }}</span>
                                    <button type="submit" class="px-10 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-base font-bold rounded-2xl shadow-lg hover:scale-[1.03] hover:shadow-xl transition-transform active:scale-100">
                                        <svg class="inline w-5 h-5 mr-2 -mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="bg-white/90 dark:bg-zinc-900/90 border border-zinc-200 dark:border-zinc-800 rounded-3xl p-8 shadow-xl">
                        <form method="POST" action="{{ route('services.update', $service) }}" class="space-y-6">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="title" value="{{ $service->title }}">
                            <input type="hidden" name="description" value="{{ $service->description }}">
                            <div>
                                <label for="price" class="block text-xs font-bold uppercase tracking-wider text-zinc-500 mb-3">Pricing</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-3 text-zinc-400 font-medium">$</span>
                                    <input id="price" type="number" step="0.01" name="price" value="{{ old('price', $service->price) }}"
                                        class="w-full pl-8 pr-4 py-3 rounded-xl border-zinc-100 dark:border-zinc-800 dark:bg-zinc-950 text-lg font-bold">
                                </div>
                            </div>
                            <div>
                                <label for="status" class="block text-xs font-bold uppercase tracking-wider text-zinc-500 mb-3">Visibility</label>
                                <select id="status" name="status" class="w-full px-4 py-3 rounded-xl border-zinc-100 dark:border-zinc-800 dark:bg-zinc-950 text-sm font-medium">
                                    <option value="draft" {{ $service->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ $service->status == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="archived" {{ $service->status == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                            </div>
                            <button type="submit" class="w-full py-3 bg-gradient-to-r from-indigo-50 to-purple-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400 text-sm font-bold rounded-xl hover:bg-indigo-100 dark:hover:bg-indigo-500/20 transition-colors shadow">
                                Update Status
                            </button>
                        </form>
                    </div>
                    <div class="p-8 bg-red-50/70 dark:bg-red-900/10 border border-red-100 dark:border-red-900/20 rounded-3xl shadow-xl">
                        <h3 class="text-base font-bold text-red-800 dark:text-red-400 mb-2">Danger Zone</h3>
                        <p class="text-xs text-red-600 dark:text-red-400/70 mb-4">Deleting this service will remove all associated analytics and history.</p>
                        <button class="w-full py-3 bg-white dark:bg-zinc-950 border border-red-200 dark:border-red-900/50 text-red-600 text-xs font-bold rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors shadow">
                            Delete Service
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
