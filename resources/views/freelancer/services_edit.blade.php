<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service - FreelanceHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans antialiased">

    <nav class="bg-white border-b py-4">
        <div class="max-w-4xl mx-auto px-4 flex justify-between items-center">
            <a href="{{ url('/freelancer/services') }}" class="text-gray-500 hover:text-indigo-600 flex items-center text-sm font-medium">
                <i class="fas fa-arrow-left mr-2"></i> Cancel Changes
            </a>
            <span class="font-bold text-gray-800 uppercase tracking-widest text-xs">Editing Service ID: #{{ $service['id'] }}</span>
            <div class="w-20"></div>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto px-4 py-12">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-8 border-b border-gray-100 bg-amber-50/30">
                <h1 class="text-2xl font-bold text-gray-900">Update Service Details</h1>
                <p class="text-gray-500 text-sm mt-1">Refine your service information to attract more clients.</p>
            </div>

            <form action="{{ url('/freelancer/services/update/'.$service['id']) }}" method="POST" class="p-8 space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Service Title</label>
                    <input type="text" name="title" value="{{ $service['title'] }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Category</label>
                        <select name="category" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none">
                            <option value="web-dev" {{ $service['category'] == 'web-dev' ? 'selected' : '' }}>Web Development</option>
                            <option value="design" {{ $service['category'] == 'design' ? 'selected' : '' }}>Graphic Design</option>
                            <option value="writing" {{ $service['category'] == 'writing' ? 'selected' : '' }}>Content Writing</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Price ($)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500">$</span>
                            <input type="number" name="price" value="{{ $service['price'] }}" required
                                class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Full Description</label>
                    <textarea name="description" rows="8" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none">{{ $service['description'] }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-3">Publishing Status</label>
                    <div class="flex gap-4">
                        <label class="flex-1 flex items-center justify-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition {{ $service['status'] == 'published' ? 'border-indigo-600 bg-indigo-50' : 'border-gray-200' }}">
                            <input type="radio" name="status" value="published" class="hidden" {{ $service['status'] == 'published' ? 'checked' : '' }}>
                            <span class="text-sm font-semibold text-gray-700">Published</span>
                        </label>
                        <label class="flex-1 flex items-center justify-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition {{ $service['status'] == 'draft' ? 'border-indigo-600 bg-indigo-50' : 'border-gray-200' }}">
                            <input type="radio" name="status" value="draft" class="hidden" {{ $service['status'] == 'draft' ? 'checked' : '' }}>
                            <span class="text-sm font-semibold text-gray-700">Save as Draft</span>
                        </label>
                    </div>
                </div>

                <div class="p-4 bg-red-50 rounded-xl border border-red-100 mt-8">
                    <h3 class="text-red-800 text-sm font-bold mb-1">Danger Zone</h3>
                    <p class="text-red-600 text-xs">Deleting this service will remove it permanently from the marketplace.</p>
                    <a href="{{ url('/freelancer/services/delete/'.$service['id']) }}" class="text-red-700 text-xs font-bold underline mt-2 block" onclick="return confirm('Delete this service permanently?')">
                        Delete Service
                    </a>
                </div>

                <div class="pt-6 border-t border-gray-100 flex items-center justify-end space-x-4">
                    <button type="submit" class="bg-indigo-600 text-white px-10 py-3 rounded-xl font-bold hover:bg-indigo-700 shadow-lg transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
