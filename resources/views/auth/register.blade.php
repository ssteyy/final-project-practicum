<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - FreelanceHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .mesh-gradient {
            background-color: #f8fafc;
            background-image: radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.08) 0, transparent 50%),
                              radial-gradient(at 100% 100%, rgba(99, 102, 241, 0.08) 0, transparent 50%);
        }
    </style>
</head>
<body class="mesh-gradient min-h-screen flex items-center justify-center py-12 px-4">

    <div class="max-w-md w-full">
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-2xl shadow-sm border border-gray-100 mb-4">
                <i class="fas fa-rocket text-2xl text-indigo-600"></i>
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Freelance<span class="text-indigo-600">Hub</span></h1>
            <p class="text-gray-500 mt-2 font-medium">Join the elite network of digital professionals</p>
        </div>

        <div class="bg-white/80 backdrop-blur-xl p-8 rounded-3xl shadow-2xl shadow-indigo-100/50 border border-white">

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-xl">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/register') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-4 text-center">I want to...</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="group relative">
                            <input type="radio" name="role" value="client" class="peer hidden" {{ old('role', 'client') == 'client' ? 'checked' : '' }}>
                            <div class="flex flex-col items-center p-4 rounded-2xl border-2 border-gray-100 bg-white cursor-pointer transition-all duration-200
                                peer-checked:border-indigo-600 peer-checked:bg-indigo-50/50 peer-checked:ring-4 peer-checked:ring-indigo-50 group-hover:border-gray-200">
                                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 mb-2 peer-checked:group-[]:bg-indigo-100 peer-checked:group-[]:text-indigo-600 transition-colors">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <span class="text-sm font-bold text-gray-500 peer-checked:group-[]:text-gray-900">Hire Talent</span>
                            </div>
                        </label>

                        <label class="group relative">
                            <input type="radio" name="role" value="freelancer" class="peer hidden" {{ old('role') == 'freelancer' ? 'checked' : '' }}>
                            <div class="flex flex-col items-center p-4 rounded-2xl border-2 border-gray-100 bg-white cursor-pointer transition-all duration-200
                                peer-checked:border-indigo-600 peer-checked:bg-indigo-50/50 peer-checked:ring-4 peer-checked:ring-indigo-50 group-hover:border-gray-200">
                                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 mb-2 peer-checked:group-[]:bg-indigo-100 peer-checked:group-[]:text-indigo-600 transition-colors">
                                    <i class="fas fa-pen-nib"></i>
                                </div>
                                <span class="text-sm font-bold text-gray-500 peer-checked:group-[]:text-gray-900">Find Work</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 ml-1 mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all" placeholder="John Doe">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 ml-1 mb-1">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all" placeholder="john@example.com">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 ml-1 mb-1">Password</label>
                            <input type="password" name="password" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all" placeholder="••••••••">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 ml-1 mb-1">Confirm</label>
                            <input type="password" name="password_confirmation" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all" placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-4 rounded-xl hover:bg-indigo-700 active:scale-[0.98] transition-all shadow-lg shadow-indigo-200 mt-4">
                    Create Account
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 text-center text-sm text-gray-500 font-medium">
                Already have an account?
                <a href="{{ url('/login') }}" class="text-indigo-600 font-bold hover:text-indigo-800 transition-colors ml-1">Log In</a>
            </div>
        </div>
    </div>

</body>
</html>
