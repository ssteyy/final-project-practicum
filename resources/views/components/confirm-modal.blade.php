@props([
    'name', 
    'title' => 'Are you sure?', 
    'message' => 'This action cannot be undone.', 
    'confirmText' => 'Confirm', 
    'type' => 'danger'
])

<div 
    x-data="{ 
        show: false, 
        postUrl: '',
        open(url) { 
            this.postUrl = url; 
            this.show = true; 
        } 
    }"
    x-on:open-modal.window="if ($event.detail.name === '{{ $name }}') open($event.detail.url)"
    x-show="show"
    class="fixed inset-0 z-[100] overflow-y-auto"
    x-cloak
>
    <div x-show="show" x-transition.opacity class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm"></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center">
        <div 
            x-show="show" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            @click.away="show = false"
            class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md"
        >
            <div class="p-6">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full {{ $type === 'danger' ? 'bg-red-100 dark:bg-red-900/30 text-red-600' : 'bg-amber-100 text-amber-600' }}">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $title }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $message }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 flex flex-col sm:flex-row-reverse gap-2">
                <form :action="postUrl" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full inline-flex justify-center rounded-xl px-4 py-2 text-sm font-semibold text-white shadow-sm transition-all {{ $type === 'danger' ? 'bg-red-600 hover:bg-red-700' : 'bg-amber-600 hover:bg-amber-700' }}">
                        {{ $confirmText }}
                    </button>
                </form>
                <button @click="show = false" type="button" class="flex-1 inline-flex justify-center rounded-xl bg-white dark:bg-gray-800 px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-300 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>