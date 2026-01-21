<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - FreelanceHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans antialiased">

    <nav class="bg-white border-b py-4 sticky top-0 z-10">
        <div class="max-w-4xl mx-auto px-4 flex justify-between items-center">
            <a href="{{ $user['role'] == 'Freelancer' ? url('/freelancer/dashboard') : url('/dashboard') }}"
               class="text-gray-500 hover:text-indigo-600 flex items-center text-sm font-medium">
                <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
            </a>
            <span class="font-bold text-gray-800">Account Settings</span>
            <div class="w-10"></div>
        </div>
    </nav>

    <main class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

            <div class="p-8 border-b border-gray-100 flex flex-col items-center bg-gray-50/50">
                <div class="relative group">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user['name']) }}&background=6366f1&color=fff&size=128"
                         class="w-32 h-32 rounded-full border-4 border-white shadow-md">
                    <button class="absolute bottom-0 right-0 bg-white p-2 rounded-full shadow-md border border-gray-200 text-gray-600 hover:text-indigo-600">
                        <i class="fas fa-camera text-sm"></i>
                    </button>
                </div>
                <h2 class="mt-4 text-xl font-bold text-gray-900">{{ $user['name'] }}</h2>
                <span class="mt-1 px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-bold uppercase tracking-wider rounded-full">
                    {{ $user['role'] }}
                </span>
            </div>

            <form action="{{ url('/profile/update') }}" method="POST" class="p-8 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ $user['name'] }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ $user['email'] }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Bio / About Me</label>
                    <textarea name="bio" rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition"
                        placeholder="Tell others about your skills and goals...">{{ $user['bio'] }}</textarea>
                </div>

                <div class="p-4 bg-amber-50 rounded-xl border border-amber-100">
                    <div class="flex items-start">
                        <i class="fas fa-shield-alt text-amber-500 mt-1 mr-3"></i>
                        <p class="text-xs text-amber-800 leading-relaxed">
                            To update your **password**, please visit our dedicated security portal. Email changes require verification for security purposes.
                        </p>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-100 flex justify-end gap-4">
                    <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 shadow-lg transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-8 bg-white rounded-2xl shadow-sm border border-red-100 p-6 flex justify-between items-center">
            <div>
                <h3 class="text-sm font-bold text-gray-900">Deactivate Account</h3>
                <p class="text-xs text-gray-500">Temporarily hide your profile and active services.</p>
            </div>
            <button class="text-red-600 text-sm font-bold hover:underline">Deactivate</button>
        </div>
    </main>

</body>
</html>
