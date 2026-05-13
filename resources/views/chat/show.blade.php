<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('messages.index') }}" class="mr-4 text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $otherParty->name }}
                </h2>
            </div>
            <a href="{{ route('orders.show', $order) }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline font-semibold">
                View Order #{{ $order->id }}
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl border border-gray-200 dark:border-gray-700 overflow-hidden" style="height: calc(100vh - 200px); min-height: 600px; display: flex; flex-direction: column;">

                <!-- Chat Header -->
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4 border-b border-indigo-700 flex-shrink-0">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            @if($otherParty->profile_picture)
                                <img src="{{ asset('storage/' . $otherParty->profile_picture) }}" alt="{{ $otherParty->name }}" class="w-12 h-12 rounded-full object-cover border-2 border-white/50 shadow-lg">
                            @else
                                <div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white font-bold text-lg border-2 border-white/50 shadow-lg">
                                    {{ substr($otherParty->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h3 class="text-lg font-bold text-white">{{ $otherParty->name }}</h3>
                                <p class="text-sm text-white/80 flex items-center">
                                    <span class="w-2 h-2 bg-emerald-400 rounded-full mr-2"></span>
                                    {{ ucfirst($otherParty->role) }}
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-white/70 font-medium">Order Amount</p>
                            <p class="text-xl font-black text-white">${{ number_format($order->amount, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Chat Messages -->
                <div id="chat-messages" class="flex-1 overflow-y-auto bg-gray-50 dark:bg-gray-900 p-4 space-y-3" style="scroll-behavior: smooth;">
                    @forelse($messages as $message)
                        @if($message->sender_id === Auth::id())
                            <!-- Sent Message (Right) -->
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
                                            {{-- <audio controls class="w-full mb-2">
                                                <source src="{{ asset('storage/' . $message->file_path) }}" type="audio/mpeg">
                                                Your browser does not support the audio tag.
                                            </audio> --}}
                                            @if($message->message)
                                                <p class="text-sm leading-relaxed break-words">{{ $message->message }}</p>
                                            @endif
                                        @else
                                            <p class="text-sm leading-relaxed break-words">{{ $message->message }}</p>
                                        @endif
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 text-right px-2 flex items-center justify-end gap-1">
                                        {{ $message->created_at->setTimezone('Asia/Bangkok')->format('g:i A') }}
                                        @if($message->is_read)
                                            <!-- Double check mark for read messages -->
                                            <svg class="w-3 h-3 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                <path fill-rule="evenodd" d="M20.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L12 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        @else
                                            <!-- Single check mark for unread messages -->
                                            <svg class="w-3 h-3 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @else
                            <!-- Received Message (Left) -->
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
                                            <p class="text-sm leading-relaxed break-words">{{ $message->message }}</p>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 px-2">
                                            {{ $message->created_at->setTimezone('Asia/Phnom_Penh')->format('H:i') }}
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
                                <p class="text-gray-500 dark:text-gray-400 text-lg font-semibold">No messages yet</p>
                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-2">Send a message to start the conversation</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Message Input -->
                <div class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 p-4 flex-shrink-0">
                    <form id="chat-form" method="POST" action="{{ route('chat.store', $order) }}" enctype="multipart/form-data" class="space-y-3">
                        @csrf

                        <div class="flex items-end space-x-2">

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
                                class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-orange-500 to-red-600 rounded-full flex items-center justify-center text-white hover:from-orange-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition shadow-lg hover:shadow-xl transform hover:scale-105 group"
                            >
                                <!-- Right-pointing Arrow Icon -->
                                <svg
                                    class="w-6 h-6 transform transition-transform group-hover:translate-x-1"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2.5"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6"
                                    />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>


        // Auto-scroll to bottom of chat
        function scrollToBottom() {
            const chatMessages = document.getElementById('chat-messages');
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Scroll to bottom on page load
        setTimeout(scrollToBottom, 100);

        // Handle form submission with FormData for file uploads
        document.getElementById('chat-form').addEventListener('submit', function(e) {
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

            // Create FormData for the message
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
                    // Scroll to bottom first, then reload page to show new message with proper formatting
                    scrollToBottom();
                    setTimeout(() => {
                        window.location.reload();
                    }, 200);
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

        // Poll for new messages every 3 seconds
        let lastMessageId = {{ $messages->last()->id ?? 0 }};

        setInterval(function() {
            fetch('{{ route('chat.messages', $order) }}?last_message_id=' + lastMessageId)
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
</x-app-layout>
