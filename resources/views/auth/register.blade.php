<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join FreelanceHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        /* Style for selected role cards */
        input[type="radio"]:checked + div {
            border-color: #4f46e5;
            background-color: #f5f3ff;
            ring: 2px;
            ring-color: #4f46e5;
        }
    </style>
</head>
<body class="bg-white antialiased">

    <div class="flex min-h-screen">

        <div class="hidden lg:flex lg:w-2/5 relative bg-slate-900 items-center justify-center p-12 overflow-hidden">
            <div class="absolute top-0 right-0 w-full h-full opacity-10">
                <svg width="100%" height="100%"><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern><rect width="100%" height="100%" fill="url(#grid)" /></svg>
            </div>

            <div class="relative z-10 max-w-md">
                <a href="/" class="inline-flex items-center gap-2 mb-12">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-bolt text-white"></i>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-white">FreelanceHub</span>
                </a>

                <h1 class="text-4xl font-extrabold text-white mb-6 leading-[1.1]">
                    Start your journey with the <span class="text-indigo-400">best in the business.</span>
                </h1>

                <ul class="space-y-6 mt-10">
                    <li class="flex items-start gap-4">
                        <div class="mt-1 w-6 h-6 rounded-full bg-indigo-500/20 flex items-center justify-center text-indigo-400 border border-indigo-500/30">
                            <i class="fas fa-check text-[10px]"></i>
                        </div>
                        <p class="text-slate-300 text-sm font-medium">Verified professional network of experts.</p>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="mt-1 w-6 h-6 rounded-full bg-indigo-500/20 flex items-center justify-center text-indigo-400 border border-indigo-500/30">
                            <i class="fas fa-check text-[10px]"></i>
                        </div>
                        <p class="text-slate-300 text-sm font-medium">Secure payment protection for every project.</p>
                    </li>
                </ul>
            </div>
        </div>

        <div class="w-full lg:w-3/5 flex items-center justify-center p-8 sm:p-12 lg:p-20 bg-slate-50">
            <div class="w-full max-w-xl">

                <div class="mb-10">
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Create your account</h2>
                    <p class="text-slate-500 mt-2 font-medium">Join our community and start building today.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-3.5 bg-white border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none text-slate-600 placeholder:text-slate-400"
                                placeholder="John Doe">
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-3.5 bg-white border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none text-slate-600 placeholder:text-slate-400"
                                placeholder="john@example.com">
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3 ml-1">I want to...</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="role" value="client" class="peer hidden" {{ old('role', 'client') == 'client' ? 'checked' : '' }}>
                                <div class="p-4 border-2 border-slate-200 rounded-2xl bg-white hover:border-indigo-200 transition-all peer-checked:border-indigo-600 peer-checked:bg-indigo-50/50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500 group-hover:text-indigo-600 transition-colors peer-checked:bg-indigo-600 peer-checked:text-white">
                                            <i class="fas fa-briefcase"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900 text-sm">Hire Talent</p>
                                            <p class="text-xs text-slate-500">I'm a client looking for help</p>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <label class="relative cursor-pointer group">
                                <input type="radio" name="role" value="freelancer" class="peer hidden" {{ old('role') == 'freelancer' ? 'checked' : '' }}>
                                <div class="p-4 border-2 border-slate-200 rounded-2xl bg-white hover:border-indigo-200 transition-all peer-checked:border-indigo-600 peer-checked:bg-indigo-50/50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500 group-hover:text-indigo-600 transition-colors">
                                            <i class="fas fa-laptop-code"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900 text-sm">Work as Expert</p>
                                            <p class="text-xs text-slate-500">I'm a freelancer finding work</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-data="{ showPassword: false, showConfirmPassword: false }">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Password</label>
                            <div class="relative">
                                <input :type="showPassword ? 'text' : 'password'" name="password" required
                                    class="w-full px-4 pr-12 py-3.5 bg-white border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none text-slate-600 placeholder:text-slate-400"
                                    placeholder="••••••••">
                                <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition">
                                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Confirm Password</label>
                            <div class="relative">
                                <input :type="showConfirmPassword ? 'text' : 'password'" name="password_confirmation" required
                                    class="w-full px-4 pr-12 py-3.5 bg-white border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none text-slate-600 placeholder:text-slate-400"
                                    placeholder="••••••••">
                                <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition">
                                    <svg x-show="!showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg x-show="showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-indigo-600 text-white font-bold py-4 rounded-2xl hover:bg-indigo-700 active:scale-[0.98] transition-all shadow-xl shadow-indigo-100 flex items-center justify-center gap-2">
                        <span>Create My Account</span>
                        <i class="fas fa-arrow-right text-[10px]"></i>
                    </button>
                </form>

                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-200"></div></div>
                    <div class="relative flex justify-center text-sm"><span class="px-4 bg-slate-50 text-slate-400 font-medium">Or continue with</span></div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('auth.google') }}" class="flex items-center justify-center gap-2 py-3 border border-slate-200 bg-white rounded-2xl hover:bg-slate-50 transition font-bold text-slate-700 text-sm">
                        <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-4 h-4" alt="Google">
                        Google
                    </a>
                    <button class="flex items-center justify-center gap-2 py-3 border border-slate-200 bg-white rounded-2xl hover:bg-slate-50 transition font-bold text-slate-700 text-sm opacity-50 cursor-not-allowed" disabled>
                        <i class="fab fa-github"></i>
                        GitHub
                    </button>
                </div>

                <p class="mt-8 text-center text-sm text-slate-500 font-medium">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-indigo-600 font-extrabold hover:underline underline-offset-4">Log in here</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>
