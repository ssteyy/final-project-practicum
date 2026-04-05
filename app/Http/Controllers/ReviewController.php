<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request, Order $order)
    {
        // Ensure the order belongs to the authenticated client
        if ($order->client_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Ensure the order is completed
        if ($order->status !== 'completed') {
            return back()->with('error', 'You can only review completed orders.');
        }

        // Check if review already exists
        if ($order->review) {
            return back()->with('error', 'You have already reviewed this order.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'order_id' => $order->id,
            'client_id' => Auth::id(),
            'freelancer_id' => $order->freelancer_id,
            'rating' => $validated['rating'],
            'review' => $validated['review'],
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }
}
