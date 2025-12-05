<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller {
    public function place(Request $req, Service $service){
        $data = $req->validate(['requirements'=>'nullable|string']);
        $order = Order::create([
            'service_id'=>$service->id,
            'client_id'=>Auth::id(),
            'freelancer_id'=>$service->user_id,
            'requirements'=>$data['requirements'] ?? null,
            'amount'=>$service->price,
            'status'=>'pending',
        ]);
        return redirect('/client/orders')->with('success','Order placed');
    }

    public function clientOrders(){
        $orders = Auth::user()->ordersAsClient()->with('service')->get();
        return view('client.my-orders', compact('orders'));
    }

    public function freelancerOrders(){
        $orders = Auth::user()->ordersAsFreelancer()->with('service','client')->get();
        return view('freelancer.orders', compact('orders'));
    }

    public function updateStatus(Request $req, Order $order){
        if(Auth::id() !== $order->freelancer_id && Auth::user()->role !== 'admin') abort(403);
        $req->validate(['status'=>'required|in:accepted,in_progress,completed,cancelled']);
        $order->update(['status'=>$req->status]);
        return back()->with('success','Order updated');
    }
}