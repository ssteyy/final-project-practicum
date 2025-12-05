<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller {
    public function create(Order $order){
        // only client can review their completed orders
        if(Auth::id() !== $order->client_id || $order->status !== 'completed') abort(403);
        return view('client.review', compact('order'));
    }

    public function store(Request $req, Order $order){
        if(Auth::id() !== $order->client_id || $order->status !== 'completed') abort(403);
        $data = $req->validate(['rating'=>'required|integer|min:1|max:5','comment'=>'nullable|string']);
        Review::create(['order_id'=>$order->id,'rating'=>$data['rating'],'comment'=>$data['comment'] ?? null]);
        return redirect('/client/orders')->with('success','Review submitted');
    }
}