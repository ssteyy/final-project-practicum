<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    @if($conversations->count() > 0)
                        <div class="space-y-4">
                            @foreach($conversations as $conversation)
                                <a href="{{ route('chat.show', $conversation['order']) }}"
                                   class="block group hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-2xl p-5 border-2 {{ $conversation['unread_count'] > 0 ? 'border-indigo-300 dark:border-indigo-700 bg-indigo-50/30 dark:bg-indigo-900/10' : 'border-gray-200 dark:border-gray-700' }} transition-all duration-200 hover:shadow-md">
                                    <div class="flex items-center space-x-4">
                                        <!-- Profile Picture -->
                                        <div class="flex-shrink-0">
                                            @if($conversation['other_party']->profile_picture)
                                                <img src="{{ asset('storage/' . $conversation['other_party']->profile_picture) }}"
                                                     alt="{{ $conversation['other_party']->name }}"
                                                     class="w-16 h-16 rounded-full object-cover border-2 {{ $conversation['unread_count'] > 0 ? 'border-indigo-500' : 'border-gray-300 dark:border-gray-600' }} shadow-md">
                                            @else
                                                <div class="w-16 h-16 rounded-full {{ $conversation['unread_count'] > 0 ? 'bg-indigo-500' : 'bg-gray-500' }} flex items-center justify-center text-white font-bold text-xl shadow-md">
                                                    {{ substr($conversation['other_party']->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Conversation Details -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between mb-1">
                                                <h3 class="text-lg font-bold text-gray-900 dark:text-white truncate">
                                                    {{ $conversation['other_party']->name }}
                                                </h3>
                                                @if($conversation['last_message'])
                                                    <span class="text-xs text-gray-500 dark:text-gray-400 ml-2 flex-shrink-0">
                                                        {{ $conversation['last_message']->created_at->diffForHumans() }}
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="flex items-center space-x-2 mb-2">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $conversation['unread_count'] > 0 ? 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/40 dark:text-indigo-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                                    {{ ucfirst($conversation['other_party']->role) }}
                                                </span>
                                                <span class="text-sm text-gray-600 dark:text-gray-400">
                                                    Order #{{ $conversation['order']->id }}
                                                </span>
                                            </div>

                                            @if($conversation['last_message'])
                                                <p class="text-sm text-gray-600 dark:text-gray-400 truncate {{ $conversation['unread_count'] > 0 ? 'font-semibold' : '' }}">
                                                    @if($conversation['last_message']->sender_id === Auth::id())
                                                        <span class="text-gray-500 dark:text-gray-500">You:</span>
                                                    @endif
                                                    {{ Str::limit($conversation['last_message']->message, 60) }}
                                                </p>
                                            @else
                                                <p class="text-sm text-gray-400 dark:text-gray-500 italic">
                                                    No messages yet
                                                </p>
                                            @endif
                                        </div>

                                        <!-- Unread Badge & Arrow -->
                                        <div class="flex items-center space-x-3">
                                            @if($conversation['unread_count'] > 0)
                                                <span class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-bold text-white bg-red-600 rounded-full min-w-[28px] shadow-lg">
                                                    {{ $conversation['unread_count'] > 99 ? '99+' : $conversation['unread_count'] }}
                                                </span>
                                            @endif
                                            <svg class="w-6 h-6 text-gray-400 dark:text-gray-500 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-16">
                            <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">No Messages Yet</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-lg mb-6">Start a conversation by placing an order or accepting one</p>
                            <div class="flex justify-center space-x-4">
                                <a href="{{ route('services.index') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 shadow-lg">
                                    Browse Services
                                </a>
                                <a href="{{ route('orders.index') }}" class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl font-semibold text-sm text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 shadow-md">
                                    View Orders
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
