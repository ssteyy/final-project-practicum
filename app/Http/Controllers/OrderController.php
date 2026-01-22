<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === User::ROLE_FREELANCER) {
            $orders = Order::where('freelancer_id', $user->id)->with('service', 'client')->latest()->get();
            return view('orders.freelancer-index', compact('orders'));
        }

        $orders = Order::where('client_id', $user->id)->with('service', 'freelancer')->latest()->get();
        return view('orders.client-index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Service $service)
    {
        if (Auth::user()->role !== User::ROLE_CLIENT) {
            abort(403);
        }

        if ($service->status !== 'published') {
            abort(404, 'Service is not available for order.');
        }

        return view('orders.create', compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $service = Service::findOrFail($request->service_id);

        Order::create([
            'service_id' => $service->id,
            'client_id' => Auth::id(),
            'freelancer_id' => $service->freelancer_id,
            'requirements' => $request->requirements,
            'amount' => $service->price,
            'status' => 'pending',
        ]);

        return redirect()->route('orders.index')->with('status', 'Order placed successfully. Waiting for freelancer to accept.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        if ($order->client_id !== Auth::id() && $order->freelancer_id !== Auth::id()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        if ($order->freelancer_id !== Auth::id() || Auth::user()->role !== User::ROLE_FREELANCER) {
            abort(403);
        }

        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->validated());

        return redirect()->route('orders.index')->with('status', 'Order status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        // Only client can cancel a pending order
        if ($order->client_id !== Auth::id() || $order->status !== 'pending') {
            abort(403);
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('orders.index')->with('status', 'Order cancelled successfully.');
    }
}
