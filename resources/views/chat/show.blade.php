<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Chat - Order #') }}{{ $order->id }}
            </h2>
            <a href="{{ route('orders.show', $order) }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                View Order Details
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <!-- Chat Header -->
            <div class="bg-white dark:bg-gray-800 rounded-t-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        @if($otherParty->profile_picture)
                            <img src="{{ asset('storage/' . $otherParty->profile_picture) }}" alt="{{ $otherParty->name }}" class="w-12 h-12 rounded-full object-cover border-2 border-indigo-500">
                        @else
                            <div class="w-12 h-12 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold text-lg">
                                {{ substr($otherParty->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $otherParty->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ ucfirst($otherParty->role) }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Order Amount</p>
                        <p class="text-2xl font-black text-emerald-600 dark:text-emerald-400">${{ number_format($order->amount, 2) }}</p>
                    </div>
                </div>
            </div>

            <!-- Chat Messages -->
            <div id="chat-messages" class="bg-gray-50 dark:bg-gray-900 border-x border-gray-200 dark:border-gray-700 p-6 space-y-4 overflow-y-auto" style="height: 500px;">
                @forelse($messages as $message)
                    @if($message->sender_id === Auth::id())
                        <!-- Sent Message (Right) -->
                        <div class="flex justify-end">
                            <div class="max-w-md">
                                <div class="bg-indigo-600 text-white rounded-2xl rounded-tr-sm px-4 py-3 shadow-md">
                                    <p class="text-sm leading-relaxed">{{ $message->message }}</p>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 text-right">
                                    {{ $message->created_at->format('M d, Y h:i A') }}
                                </p>
                            </div>
                        </div>
                    @else
                        <!-- Received Message (Left) -->
                        <div class="flex justify-start">
                            <div class="max-w-md">
                                <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-2xl rounded-tl-sm px-4 py-3 shadow-md border border-gray-200 dark:border-gray-700">
                                    <p class="text-sm leading-relaxed">{{ $message->message }}</p>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $message->created_at->format('M d, Y h:i A') }}
                                </p>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="flex items-center justify-center h-full">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400 text-lg font-semibold">No messages yet</p>
                            <p class="text-gray-400 dark:text-gray-500 text-sm mt-2">Start the conversation by sending a message below</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Message Input -->
            <div class="bg-white dark:bg-gray-800 rounded-b-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <form id="chat-form" method="POST" action="{{ route('chat.store', $order) }}" class="flex items-end space-x-4">
                    @csrf
                    <div class="flex-1">
                        <textarea
                            id="message-input"
                            name="message"
                            rows="3"
                            required
                            placeholder="Type your message here..."
                            class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm resize-none"
                        ></textarea>
                    </div>
                    <button
                        type="submit"
                        class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 shadow-lg hover:shadow-xl"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Send
                    </button>
                </form>
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
        scrollToBottom();

        // Handle form submission with AJAX
        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const messageInput = document.getElementById('message-input');
            const message = messageInput.value.trim();

            if (!message) return;

            // Send message via AJAX
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ message: message })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Add message to chat
                    const chatMessages = document.getElementById('chat-messages');
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'flex justify-end';
                    messageDiv.innerHTML = `
                        <div class="max-w-md">
                            <div class="bg-indigo-600 text-white rounded-2xl rounded-tr-sm px-4 py-3 shadow-md">
                                <p class="text-sm leading-relaxed">${escapeHtml(message)}</p>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 text-right">
                                Just now
                            </p>
                        </div>
                    `;
                    chatMessages.appendChild(messageDiv);

                    // Clear input and scroll to bottom
                    messageInput.value = '';
                    scrollToBottom();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to send message. Please try again.');
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
                                <div class="max-w-md">
                                    <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-2xl rounded-tl-sm px-4 py-3 shadow-md border border-gray-200 dark:border-gray-700">
                                        <p class="text-sm leading-relaxed">${escapeHtml(message.message)}</p>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        ${formatDate(message.created_at)}
                                    </p>
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

        // Helper function to escape HTML
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Helper function to format date
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric',
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });
        }
    </script>
    @endpush
</x-app-layout>
