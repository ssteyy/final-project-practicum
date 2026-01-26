<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white/80 dark:bg-zinc-950/80 backdrop-blur-md border-b border-zinc-200/50 dark:border-zinc-800/50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20"> <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="transition-transform hover:scale-105">
                        <x-application-logo class="block h-10 w-auto fill-current text-indigo-600 dark:text-indigo-400" />
                    </a>
                </div>

                <div class="hidden space-x-2 sm:ms-12 sm:flex">
                    @php
                        $links = [
                            ['route' => 'services.index', 'label' => 'Services'],
                            ['route' => 'orders.index', 'label' => 'Orders'],
                            ['route' => 'dashboard', 'label' => 'Dashboard'],
                        ];
                    @endphp

                    @foreach($links as $link)
                        <a href="{{ route($link['route']) }}"
                           class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 {{ request()->routeIs($link['route'])
                                ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-400'
                                : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100 hover:bg-zinc-100 dark:hover:bg-zinc-900' }}">
                            {{ __($link['label']) }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-1 py-1 border border-zinc-200 dark:border-zinc-800 rounded-full bg-zinc-50 dark:bg-zinc-900 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition duration-200 focus:outline-none">
                            <div class="h-8 w-8 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white text-xs font-bold mr-2 shadow-inner">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-semibold text-zinc-700 dark:text-zinc-300 pr-3">{{ Auth::user()->name }}</span>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="p-1">
                            <x-dropdown-link :href="route('profile.edit')" class="rounded-lg">
                                {{ __('Profile Settings') }}
                            </x-dropdown-link>

                            <div class="border-t border-zinc-100 dark:border-zinc-800 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        class="rounded-lg text-red-600 dark:text-red-400"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-xl text-zinc-500 hover:bg-zinc-100 dark:hover:bg-zinc-900 focus:outline-none transition duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="sm:hidden bg-white dark:bg-zinc-950 border-b border-zinc-200 dark:border-zinc-800">
        <div class="pt-2 pb-3 space-y-1 px-4">
            @foreach($links as $link)
                <x-responsive-nav-link :href="route($link['route'])" :active="request()->routeIs($link['route'])" class="rounded-xl">
                    {{ __($link['label']) }}
                </x-responsive-nav-link>
            @endforeach
        </div>

        <div class="pt-4 pb-1 border-t border-zinc-200 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-900/50">
            <div class="px-6 flex items-center">
                <div class="h-10 w-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold mr-3">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-bold text-zinc-800 dark:text-zinc-200">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-zinc-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 px-4 pb-4 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-xl">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            class="rounded-xl text-red-500"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
