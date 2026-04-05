<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            <svg class="w-6 h-6 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl border border-gray-200 dark:border-gray-700 overflow-hidden flex" style="height: calc(100vh - 200px); min-height: 600px;">

                <!-- Left Sidebar - Conversations List -->
                <div class="w-full md:w-96 border-r border-gray-200 dark:border-gray-700 flex flex-col">
                    <!-- Sidebar Header -->
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-4 border-b border-indigo-700 flex-shrink-0">
                        <h3 class="text-lg font-bold text-white flex items-center justify-between">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"></path>
                                    <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z"></path>
                                </svg>
                                Chats
                            </span>
                            <span class="px-2.5 py-1 bg-white/20 backdrop-blur-sm rounded-full text-xs font-bold text-white">
                                {{ $conversations->count() }}
                            </span>
                        </h3>
                    </div>

                    <!-- Conversations List -->
                    @if($conversations->count() > 0)
                        <div class="flex-1 overflow-y-auto">
                            @foreach($conversations as $conversation)
                                <a href="{{ route('messages.index', ['order_id' => $conversation['order']->id]) }}"
                                   class="flex items-center px-4 py-3 border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150 {{ $selectedOrder && $selectedOrder->id === $conversation['order']->id ? 'bg-indigo-50 dark:bg-indigo-900/20 border-l-4 border-l-indigo-600' : '' }} {{ $conversation['unread_count'] > 0 && (!$selectedOrder || $selectedOrder->id !== $conversation['order']->id) ? 'bg-indigo-50/30 dark:bg-indigo-900/10' : '' }}">
                                    <!-- Profile Picture -->
                                    <div class="relative flex-shrink-0 mr-3">
                                        @if($conversation['other_party']->profile_picture)
                                            <img src="{{ asset('storage/' . $conversation['other_party']->profile_picture) }}"
                                                 alt="{{ $conversation['other_party']->name }}"
                                                 class="w-12 h-12 rounded-full object-cover {{ $conversation['unread_count'] > 0 ? 'ring-2 ring-indigo-500' : '' }}">
                                        @else
                                            <div class="w-12 h-12 rounded-full {{ $conversation['unread_count'] > 0 ? 'bg-indigo-500 ring-2 ring-indigo-400' : 'bg-gray-400 dark:bg-gray-600' }} flex items-center justify-center text-white font-bold">
                                                {{ substr($conversation['other_party']->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <!-- Online Status -->
                                        <div class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-500 border-2 border-white dark:border-gray-800 rounded-full"></div>
                                    </div>

                                    <!-- Conversation Info -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-0.5">
                                            <h4 class="text-sm font-bold text-gray-900 dark:text-white truncate">
                                                {{ $conversation['other_party']->name }}
                                            </h4>
                                            @if($conversation['last_message'])
                                                <span class="text-xs text-gray-500 dark:text-gray-400 ml-2 flex-shrink-0">
                                                    {{ $conversation['last_message']->created_at->diffForHumans(null, true) }}
                                                </span>
                                            @endif
                                        </div>

                                        @if($conversation['last_message'])
                                            <p class="text-xs text-gray-600 dark:text-gray-400 truncate {{ $conversation['unread_count'] > 0 ? 'font-semibold text-gray-900 dark:text-white' : '' }}">
                                                @if($conversation['last_message']->sender_id === Auth::id())
                                                    <span class="text-gray-500 dark:text-gray-500">You: </span>
                                                @endif
                                                {{ Str::limit($conversation['last_message']->message, 35) }}
                                            </p>
                                        @else
                                            <p class="text-xs text-gray-400 dark:text-gray-500 italic">
                                                Start conversation
                                            </p>
                                        @endif
                                    </div>

                                    <!-- Unread Badge -->
                                    @if($conversation['unread_count'] > 0 && (!$selectedOrder || $selectedOrder->id !== $conversation['order']->id))
                                        <div class="flex-shrink-0 ml-2">
                                            <span class="inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-indigo-600 rounded-full">
                                                {{ $conversation['unread_count'] > 9 ? '9+' : $conversation['unread_count'] }}
                                            </span>
                                        </div>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="flex-1 flex items-center justify-center p-6">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white mb-1">No Conversations</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Place or accept an order to start chatting</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Side - Chat Area -->
                <div class="flex-1 flex flex-col">
                    @if($selectedOrder && $otherParty)
                        <!-- Chat Header -->
                        <div class="bg-white dark:bg-gray-800 px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    @if($otherParty->profile_picture)
                                        <img src="{{ asset('storage/' . $otherParty->profile_picture) }}" alt="{{ $otherParty->name }}" class="w-10 h-10 rounded-full object-cover border-2 border-indigo-500">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold">
                                            {{ substr($otherParty->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div>
                                        <h3 class="text-base font-bold text-gray-900 dark:text-white">{{ $otherParty->name }}</h3>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 flex items-center">
                                            <span class="w-2 h-2 bg-emerald-500 rounded-full mr-1.5"></span>
                                            {{ ucfirst($otherParty->role) }}
                                        </p>
                                    </div>
                                </div>
                                <a href="{{ route('orders.show', $selectedOrder) }}" class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline font-semibold flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                    Order #{{ $selectedOrder->id }}
                                </a>
                            </div>
                        </div>

                        <!-- Chat Messages -->
                        <div id="chat-messages" class="flex-1 overflow-y-auto bg-gray-50 dark:bg-gray-900 p-4 space-y-3" style="scroll-behavior: smooth;">
                            @forelse($messages as $message)
                                @if($message->sender_id === Auth::id())
                                    <!-- Sent Message -->
                                    <div class="flex justify-end">
                                        <div class="max-w-xs lg:max-w-md">
                                            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-2xl rounded-tr-md px-4 py-2.5 shadow-md">
                                                @if($message->message_type === 'image')
                                                    <img src="{{ asset('storage/' . $message->file_path) }}" alt="Image" class="rounded-lg max-w-full h-auto mb-2">
                                                    @if($message->message)
                                                        <p class="text-sm leading-relaxed break-words">{{ $message->message }}</p>
                                                    @endif
                                                @elseif($message->message_type === 'video')
                                                    <video controls class="rounded-lg max-w-full h-auto mb-2">
                                                        <source src="{{ asset('storage/' . $message->file_path) }}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                    @if($message->message)
                                                        <p class="text-sm leading-relaxed break-words">{{ $message->message }}</p>
                                                    @endif
                                                @elseif($message->message_type === 'voice')
                                                    <audio controls class="w-full mb-2">
                                                        <source src="{{ asset('storage/' . $message->file_path) }}" type="audio/mpeg">
                                                        Your browser does not support the audio tag.
                                                    </audio>
                                                    @if($message->message)
                                                        <p class="text-sm leading-relaxed break-words">{{ $message->message }}</p>
                                                    @endif
                                                @else
                                                    <p class="text-sm leading-relaxed break-words">{{ $message->message }}</p>
                                                @endif
                                            </div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 text-right px-2">
                                                {{ $message->created_at->format('g:i A') }}
                                            </p>
                                        </div>
                                    </div>
                                @else
                                    <!-- Received Message -->
                                    <div class="flex justify-start">
                                        <div class="flex items-end space-x-2 max-w-xs lg:max-w-md">
                                            @if($otherParty->profile_picture)
                                                <img src="{{ asset('storage/' . $otherParty->profile_picture) }}" alt="{{ $otherParty->name }}" class="w-8 h-8 rounded-full object-cover flex-shrink-0">
                                            @else
                                                <div class="w-8 h-8 rounded-full bg-gray-400 dark:bg-gray-600 flex items-center justify-center text-white font-bold text-xs flex-shrink-0">
                                                    {{ substr($otherParty->name, 0, 1) }}
                                                </div>
                                            @endif
                                            <div class="flex-1">
                                                <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-2xl rounded-tl-md px-4 py-2.5 shadow-md border border-gray-200 dark:border-gray-700">
                                                    @if($message->message_type === 'image')
                                                        <img src="{{ asset('storage/' . $message->file_path) }}" alt="Image" class="rounded-lg max-w-full h-auto mb-2">
                                                        @if($message->message)
                                                            <p class="text-sm leading-relaxed break-words">{{ $message->message }}</p>
                                                        @endif
                                                    @elseif($message->message_type === 'video')
                                                        <video controls class="rounded-lg max-w-full h-auto mb-2">
                                                            <source src="{{ asset('storage/' . $message->file_path) }}" type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                        @if($message->message)
                                                            <p class="text-sm leading-relaxed break-words">{{ $message->message }}</p>
                                                        @endif
                                                    @elseif($message->message_type === 'voice')
                                                        <audio controls class="w-full mb-2">
                                                            <source src="{{ asset('storage/' . $message->file_path) }}" type="audio/mpeg">
                                                            Your browser does not support the audio tag.
                                                        </audio>
                                                        @if($message->message)
                                                            <p class="text-sm leading-relaxed break-words">{{ $message->message }}</p>
                                                        @endif
                                                    @else
                                                        <p class="text-sm leading-relaxed break-words">{{ $message->message }}</p>
                                                    @endif
                                                </div>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 px-2">
                                                    {{ $message->created_at->format('g:i A') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <div class="flex items-center justify-center h-full">
                                    <div class="text-center">
                                        <div class="w-20 h-20 bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-gray-700 dark:to-gray-800 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-10 h-10 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 dark:text-gray-400 font-semibold">No messages yet</p>
                                        <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Send a message to start</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <!-- Message Input -->
                        <div class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 p-4 flex-shrink-0">
                            <!-- File Preview Area -->
                            <div id="file-preview" class="hidden mb-3 p-3 bg-gray-100 dark:bg-gray-700 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                        </svg>
                                        <span id="file-name" class="text-sm text-gray-700 dark:text-gray-300"></span>
                                    </div>
                                    <button type="button" onclick="clearFileSelection()" class="text-red-600 hover:text-red-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <form id="chat-form" method="POST" action="{{ route('chat.store', $selectedOrder) }}" enctype="multipart/form-data" class="space-y-3">
                                @csrf
                                <input type="hidden" id="message-type" name="message_type" value="text">
                                <input type="file" id="file-input" name="file" class="hidden" accept="image/*,video/*,audio/*">

                                <div class="flex items-end space-x-2">
                                    <!-- Attachment Buttons -->
                                    <div class="flex space-x-1">
                                        <!-- Image Button -->
                                        <button type="button" onclick="selectFile('image')" class="flex-shrink-0 w-10 h-10 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-indigo-100 dark:hover:bg-indigo-900 transition" title="Send Image">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </button>
                                        <!-- Video Button -->
                                        <button type="button" onclick="selectFile('video')" class="flex-shrink-0 w-10 h-10 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-indigo-100 dark:hover:bg-indigo-900 transition" title="Send Video">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                            </svg>
                                        </button>
                                        <!-- Voice Button -->
                                        <button type="button" onclick="selectFile('voice')" class="flex-shrink-0 w-10 h-10 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-indigo-100 dark:hover:bg-indigo-900 transition" title="Send Voice">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Text Input -->
                                    <div class="flex-1">
                                        <textarea
                                            id="message-input"
                                            name="message"
                                            rows="1"
                                            placeholder="Type a message..."
                                            class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-full shadow-sm resize-none px-5 py-3 text-sm"
                                            style="max-height: 120px;"
                                            onkeydown="if(event.key === 'Enter' && !event.shiftKey) { event.preventDefault(); this.form.dispatchEvent(new Event('submit', {cancelable: true})); }"
                                            oninput="this.style.height = 'auto'; this.style.height = Math.min(this.scrollHeight, 120) + 'px';"
                                        ></textarea>
                                    </div>

                                    <!-- Send Button -->
                                    <button
                                        type="submit"
                                        class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full flex items-center justify-center text-white hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition shadow-lg hover:shadow-xl transform hover:scale-105"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @else
                        <!-- Empty State - No Conversation Selected -->
                        <div class="flex-1 flex items-center justify-center bg-gray-50 dark:bg-gray-900">
                            <div class="text-center px-6">
                                <div class="w-24 h-24 bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-gray-700 dark:to-gray-800 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-12 h-12 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Select a Conversation</h3>
                                <p class="text-gray-500 dark:text-gray-400">Choose a conversation from the list to start messaging</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($selectedOrder && $otherParty)
        @push('scripts')
        <script>
            // File selection handling
            function selectFile(type) {
                const fileInput = document.getElementById('file-input');
                const messageType = document.getElementById('message-type');

                // Set accept attribute based on type
                if (type === 'image') {
                    fileInput.accept = 'image/*';
                } else if (type === 'video') {
                    fileInput.accept = 'video/*';
                } else if (type === 'voice') {
                    fileInput.accept = 'audio/*';
                }

                messageType.value = type;
                fileInput.click();
            }

            // Handle file selection
            document.getElementById('file-input').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    document.getElementById('file-name').textContent = file.name;
                    document.getElementById('file-preview').classList.remove('hidden');
                }
            });

            // Clear file selection
            function clearFileSelection() {
                document.getElementById('file-input').value = '';
                document.getElementById('file-preview').classList.add('hidden');
                document.getElementById('message-type').value = 'text';
            }

            // Auto-scroll to bottom of chat
            function scrollToBottom() {
                const chatMessages = document.getElementById('chat-messages');
                if (chatMessages) {
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }
            }

            // Scroll to bottom on page load
            scrollToBottom();

            // Handle form submission with FormData for file uploads
            const chatForm = document.getElementById('chat-form');
            if (chatForm) {
                chatForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const form = this;
                    const messageInput = document.getElementById('message-input');
                    const fileInput = document.getElementById('file-input');
                    const message = messageInput.value.trim();
                    const hasFile = fileInput.files.length > 0;

                    // Require either message or file
                    if (!message && !hasFile) return;

                    // Disable submit button temporarily
                    const submitButton = form.querySelector('button[type="submit"]');
                    submitButton.disabled = true;

                    // Create FormData for file upload
                    const formData = new FormData(form);

                    // Send message via AJAX
                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Reload page to show new message with proper formatting
                            window.location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to send message. Please try again.');
                    })
                    .finally(() => {
                        submitButton.disabled = false;
                    });
                });
            }

            // Poll for new messages every 3 seconds
            let lastMessageId = {{ $messages->last()->id ?? 0 }};

            setInterval(function() {
                fetch('{{ route('chat.messages', $selectedOrder) }}?last_message_id=' + lastMessageId)
                    .then(response => response.json())
                    .then(data => {
                        if (data.messages && data.messages.length > 0) {
                            const chatMessages = document.getElementById('chat-messages');

                            data.messages.forEach(message => {
                                const messageDiv = document.createElement('div');
                                messageDiv.className = 'flex justify-start';
                                messageDiv.innerHTML = `
                                    <div class="flex items-end space-x-2 max-w-xs lg:max-w-md">
                                        ${getProfilePicture()}
                                        <div class="flex-1">
                                            <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-2xl rounded-tl-md px-4 py-2.5 shadow-md border border-gray-200 dark:border-gray-700">
                                                <p class="text-sm leading-relaxed break-words">${escapeHtml(message.message)}</p>
                                            </div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 px-2">
                                                ${formatTime(message.created_at)}
                                            </p>
                                        </div>
                                    </div>
                                `;
                                chatMessages.appendChild(messageDiv);
                                lastMessageId = message.id;
                            });

                            scrollToBottom();
                        }
                    })
                    .catch(error => console.error('Error polling messages:', error));
            }, 3000);

            // Helper function to get profile picture HTML
            function getProfilePicture() {
                @if($otherParty->profile_picture)
                    return '<img src="{{ asset('storage/' . $otherParty->profile_picture) }}" alt="{{ $otherParty->name }}" class="w-8 h-8 rounded-full object-cover flex-shrink-0">';
                @else
                    return '<div class="w-8 h-8 rounded-full bg-gray-400 dark:bg-gray-600 flex items-center justify-center text-white font-bold text-xs flex-shrink-0">{{ substr($otherParty->name, 0, 1) }}</div>';
                @endif
            }

            // Helper function to escape HTML
            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            // Helper function to format time
            function formatTime(dateString) {
                const date = new Date(dateString);
                return date.toLocaleString('en-US', {
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true
                });
            }
        </script>
        @endpush
    @endif
</x-app-layout>
