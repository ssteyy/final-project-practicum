<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display all conversations (messages inbox) with optional selected conversation
     */
    public function index(Request $request)
    {
        $userId = Auth::id();

        // Get all orders where user is involved
        $orders = Order::where(function($query) use ($userId) {
            $query->where('client_id', $userId)
                  ->orWhere('freelancer_id', $userId);
        })
        ->whereHas('messages')
        ->with(['client', 'freelancer', 'service'])
        ->get();

        // Get message stats for each order
        $conversations = $orders->map(function($order) use ($userId) {
            $lastMessage = Message::where('order_id', $order->id)
                ->latest()
                ->first();

            $unreadCount = Message::where('order_id', $order->id)
                ->where('receiver_id', $userId)
                ->where('is_read', false)
                ->count();

            $otherParty = $userId === $order->client_id ? $order->freelancer : $order->client;

            return [
                'order' => $order,
                'other_party' => $otherParty,
                'last_message' => $lastMessage,
                'unread_count' => $unreadCount,
            ];
        });

        // Sort by unread first, then by last message time
        $conversations = $conversations->sortByDesc(function($conv) {
            return [
                $conv['unread_count'] > 0 ? 1 : 0,
                $conv['last_message'] ? $conv['last_message']->created_at->timestamp : 0
            ];
        });

        // Get selected conversation if user is provided
        $selectedOrder = null;
        $messages = collect();
        $otherParty = null;

        if ($request->has('user')) {
            // Handle special case for admin chat
            if ($request->user === 'adminaccount') {
                $targetUser = \App\Models\User::where('role', \App\Models\User::ROLE_ADMIN)->first();
            } else {
                $targetUser = \App\Models\User::find($request->user);
            }

            if ($targetUser && $targetUser->id != Auth::id()) {
                // Find or create order between current user and specified user
                $selectedOrder = Order::firstOrCreate(
                    [
                        'client_id' => min(Auth::id(), $targetUser->id),
                        'freelancer_id' => max(Auth::id(), $targetUser->id),
                        'service_id' => \App\Models\Service::where('freelancer_id', $targetUser->id)->where('title', 'Customer Support')->first()->id ?? 1,
                    ],
                    [
                        'requirements' => 'Direct chat with ' . $targetUser->name,
                        'amount' => 0.00,
                        'status' => 'completed',
                    ]
                );

                // Get messages for selected order
                $messages = Message::where('order_id', $selectedOrder->id)
                    ->with(['sender', 'receiver'])
                    ->orderBy('created_at', 'asc')
                    ->get();

                // Mark messages as read
                Message::where('order_id', $selectedOrder->id)
                    ->where('receiver_id', Auth::id())
                    ->where('is_read', false)
                    ->update(['is_read' => true]);

                // Determine the other party
                $otherParty = Auth::id() === $selectedOrder->client_id ? $selectedOrder->freelancer : $selectedOrder->client;
            }
        }

        return view('chat.index', compact('conversations', 'selectedOrder', 'messages', 'otherParty'));
    }

    /**
     * Display the chat interface for a specific order
     */
    public function show(Order $order)
    {
        // Verify user is part of this order
        if (Auth::id() !== $order->client_id && Auth::id() !== $order->freelancer_id) {
            abort(403, 'Unauthorized access to this chat.');
        }

        // Get all messages for this order
        $messages = Message::where('order_id', $order->id)
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark messages as read if current user is the receiver
        Message::where('order_id', $order->id)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // Determine the other party
        $otherParty = Auth::id() === $order->client_id ? $order->freelancer : $order->client;

        return view('chat.show', compact('order', 'messages', 'otherParty'));
    }

    /**
     * Store a new message
     */
    public function store(Request $request, Order $order)
    {
        // Verify user is part of this order
        if (Auth::id() !== $order->client_id && Auth::id() !== $order->freelancer_id) {
            abort(403, 'Unauthorized access to this chat.');
        }

        $request->validate([
            'message' => 'nullable|string|max:5000',
            'file' => 'nullable|file|max:51200', // 50MB max
            'message_type' => 'nullable|in:text,image,video,voice',
        ]);

        // Determine receiver
        $receiverId = Auth::id() === $order->client_id ? $order->freelancer_id : $order->client_id;

        $messageData = [
            'order_id' => $order->id,
            'sender_id' => Auth::id(),
            'receiver_id' => $receiverId,
            'message' => $request->message,
            'message_type' => $request->message_type ?? 'text',
        ];

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $messageType = $request->message_type ?? 'text';

            // Determine file extension based on message type
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . uniqid() . '.' . $extension;

            // Store file in chat_media directory
            $path = $file->storeAs('chat_media', $filename, 'public');

            $messageData['file_path'] = $path;
            $messageData['message_type'] = $messageType;
        }

        $message = Message::create($messageData);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message->load(['sender', 'receiver']),
            ]);
        }

        return redirect()->route('chat.show', $order)->with('status', 'Message sent successfully!');
    }

    /**
     * Get new messages (for AJAX polling)
     */
    public function getMessages(Order $order, Request $request)
    {
        // Verify user is part of this order
        if (Auth::id() !== $order->client_id && Auth::id() !== $order->freelancer_id) {
            abort(403);
        }

        $lastMessageId = $request->input('last_message_id', 0);

        $messages = Message::where('order_id', $order->id)
            ->where('id', '>', $lastMessageId)
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark new messages as read if current user is the receiver
        Message::where('order_id', $order->id)
            ->where('id', '>', $lastMessageId)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json([
            'messages' => $messages,
        ]);
    }


}
