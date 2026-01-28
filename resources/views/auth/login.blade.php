<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | FreelanceHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-white antialiased">

    <div class="flex min-h-screen">

        <div class="hidden lg:flex lg:w-1/2 relative bg-indigo-600 items-center justify-center p-12 overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full opacity-20">
                <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-white rounded-full blur-3xl"></div>
                <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-indigo-400 rounded-full blur-3xl"></div>
            </div>

            <div class="relative z-10 max-w-lg text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/10 backdrop-blur-lg rounded-3xl mb-8 border border-white/20">
                    <i class="fas fa-bolt text-white text-3xl"></i>
                </div>
                <h1 class="text-4xl font-extrabold text-white mb-6 leading-tight">
                    The world's best talent is just a click away.
                </h1>
                <p class="text-indigo-100 text-lg">
                    Join over 20,000+ businesses using FreelanceHub to scale their creative and technical teams.
                </p>

                <div class="mt-12 p-6 bg-white/5 backdrop-blur-md rounded-2xl border border-white/10 text-left">
                    <p class="text-white italic mb-4">"This platform changed how we hire. The quality of freelancers is unmatched."</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-indigo-300"></div>
                        <div>
                            <p class="text-white font-bold text-sm">Sarah Jenkins</p>
                            <p class="text-indigo-200 text-xs">CTO at TechFlow</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-24 bg-slate-50">
            <div class="w-full max-w-md">

                <div class="lg:hidden mb-8 flex items-center gap-2">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-bolt text-white"></i>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-slate-900">FreelanceHub</span>
                </div>

                <div class="mb-10">
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Login to your account</h2>
                    <p class="text-slate-500 mt-3 font-medium">Welcome back! Please enter your details.</p>
                </div>

                @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl flex items-center gap-3 text-red-600 text-sm">
                    <i class="fas fa-circle-exclamation"></i>
                    <p>Invalid credentials. Please try again.</p>
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2 ml-1">Email Address</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors">
                                <i class="fas fa-envelope text-slate-400 group-focus-within:text-indigo-600"></i>
                            </div>
                            <input type="email" name="email" id="email" required
                                class="block w-full pl-11 pr-4 py-3.5 bg-white border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none text-slate-600"
                                placeholder="you@company.com">
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2 ml-1">
                            <label for="password" class="text-sm font-bold text-slate-700">Password</label>
                            <a href="{{ route('password.request') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition">Forgot password?</a>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors">
                                <i class="fas fa-lock text-slate-400 group-focus-within:text-indigo-600"></i>
                            </div>
                            <input type="password" name="password" id="password" required
                                class="block w-full pl-11 pr-4 py-3.5 bg-white border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 transition-all outline-none text-slate-600"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded cursor-pointer">
                        <label for="remember" class="ml-2 block text-sm text-slate-600 font-medium cursor-pointer">
                            Keep me logged in
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full bg-slate-900 text-white font-bold py-4 rounded-2xl hover:bg-indigo-600 active:scale-[0.98] transition-all shadow-xl shadow-slate-200 flex items-center justify-center gap-2">
                        <span>Sign In</span>
                        <i class="fas fa-chevron-right text-[10px]"></i>
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

                <p class="mt-10 text-center text-sm text-slate-500 font-medium">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-indigo-600 font-extrabold hover:underline underline-offset-4">Create account</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>
