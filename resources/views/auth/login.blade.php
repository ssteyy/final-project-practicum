<x-guest-layout>
    <div class="mesh-gradient min-h-screen flex items-center justify-center py-12 px-4">
        <style>
            .mesh-gradient {
                background-color: #f8fafc;
                background-image: radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.08) 0, transparent 50%),
                                  radial-gradient(at 100% 100%, rgba(99, 102, 241, 0.08) 0, transparent 50%);
            }
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
        </style>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <div class="max-w-md w-full">
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-2xl shadow-sm border border-gray-100 mb-4">
                    <i class="fas fa-rocket text-2xl text-indigo-600"></i>
                </div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Freelance<span class="text-indigo-600">Hub</span></h1>
                <p class="text-gray-500 mt-2 font-medium">Welcome back! Please login to your account.</p>
            </div>

            <div class="bg-white/80 backdrop-blur-xl p-8 rounded-3xl shadow-2xl shadow-indigo-100/50 border border-white">

                <x-auth-session-status class="mb-4" :status="session('status')" />

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-xl">
                        <div class="flex">
                            <i class="fas fa-exclamation-circle mt-0.5 mr-2"></i>
                            <div>
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 ml-1 mb-1">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                                class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all placeholder:text-gray-400"
                                placeholder="name@company.com">
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center ml-1 mb-1">
                            <label for="password" class="text-sm font-semibold text-gray-700">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs text-indigo-600 font-bold hover:underline">
                                    Forgot?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" name="password" id="password" required autocomplete="current-password"
                                class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all placeholder:text-gray-400"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div class="flex items-center ml-1">
                        <input id="remember_me" name="remember" type="checkbox"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded cursor-pointer">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-500 font-medium cursor-pointer">
                            Remember me
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full bg-indigo-600 text-white font-bold py-4 rounded-xl hover:bg-indigo-700 active:scale-[0.98] transition-all shadow-lg shadow-indigo-200 mt-2">
                        Sign In
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                    <p class="text-sm text-gray-500 font-medium">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:text-indigo-800 transition-colors ml-1">Create Account</a>
                    </p>
                </div>
            </div>

            <p class="text-center text-gray-400 text-xs mt-8 font-medium">
                &copy; {{ date('Y') }} FreelanceHub. <i class="fas fa-shield-alt ml-1"></i> Secure Encrypted Login.
            </p>
        </div>
    </div>
</x-guest-layout>
