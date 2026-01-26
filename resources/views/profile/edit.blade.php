<x-app-layout>
    <div class="min-h-screen bg-slate-50 dark:bg-zinc-950 py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">Account Settings</h1>
                <p class="text-zinc-500 dark:text-zinc-400">Manage your profile information and security preferences.</p>
            </div>

            <div class="flex flex-col md:flex-row gap-8">
                <aside class="w-full md:w-64 space-y-2">
                    <nav class="flex flex-col space-y-1">
                        <a href="#profile" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl bg-white dark:bg-zinc-900 shadow-sm border border-zinc-200 dark:border-zinc-800 text-indigo-600 dark:text-indigo-400">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Profile Details
                        </a>
                        <a href="#password" class="flex items-center px-4 py-3 text-sm font-medium text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-900 rounded-xl transition-all">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Security
                        </a>
                    </nav>
                </aside>

                <div class="flex-1 space-y-8">

                    <section id="profile" class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl overflow-hidden shadow-sm">
                        <div class="px-6 py-4 border-b border-zinc-100 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-800/50">
                            <h3 class="font-semibold text-zinc-900 dark:text-white">Profile Information</h3>
                        </div>
                        <div class="p-6">
                            <div class="max-w-xl">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                    </section>

                    <section id="password" class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl overflow-hidden shadow-sm">
                        <div class="px-6 py-4 border-b border-zinc-100 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-800/50">
                            <h3 class="font-semibold text-zinc-900 dark:text-white">Update Password</h3>
                        </div>
                        <div class="p-6">
                            <div class="max-w-xl">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                    </section>

                    <section class="bg-red-50/50 dark:bg-red-900/10 border border-red-100 dark:border-red-900/30 rounded-2xl overflow-hidden">
                        <div class="px-6 py-4 border-b border-red-100 dark:border-red-900/30 bg-red-50 dark:bg-red-900/20">
                            <h3 class="font-semibold text-red-800 dark:text-red-400">Danger Zone</h3>
                        </div>
                        <div class="p-6">
                            <div class="max-w-xl">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
