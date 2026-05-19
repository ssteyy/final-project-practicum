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

        if ($user->role === User::ROLE_ADMIN) {
            $orders = Order::with('service', 'client', 'freelancer')->latest()->get();
            return view('admin.orders.index', compact('orders'));
        }

        if ($user->role === User::ROLE_FREELANCER) {
            // Freelancers should not see cancelled orders
            $orders = Order::where('freelancer_id', $user->id)
                ->where('status', '!=', 'cancelled')
                ->with('service', 'client')
                ->latest()
                ->get();
            return view('orders.freelancer-index', compact('orders'));
        }

        // Clients can see all their orders including cancelled ones
        $orders = Order::where('client_id', $user->id)->with('service', 'freelancer')->latest()->get();
        return view('orders.client-index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create(Service $service)
    // {
    //     dd($service->id);
    //     if (Auth::user()->role !== User::ROLE_CLIENT) {
    //         abort(403);
    //     }

    //     if ($service->status !== 'published') {
    //         abort(404, 'Service is not available for order.');
    //     }
    //     return view('orders.create', compact('service'));
    // }
    public function create(Request $request)
    {
        $service = Service::findOrFail($request->query('id'));

        if (Auth::user()->role !== User::ROLE_CLIENT) {
            abort(403);
        }

        if ($service->status !== 'published') {
            abort(404, 'Service is not available for order.');
        }

        // Optional: prevent ordering own service
        if ($service->freelancer_id === Auth::id()) {
            abort(403, 'You cannot order your own service.');
        }

        return view('orders.create', compact('service'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $service = Service::findOrFail($request->service_id);

        // Calculate total amount with 15% platform fee
        $serviceFee = $service->original_price ?? $service->price;
        $platformFee = $service->platform_fee ?? ($serviceFee * 0.15);
        $totalAmount = $serviceFee + $platformFee;

        Order::create([
            'service_id' => $service->id,
            'client_id' => Auth::id(),
            'freelancer_id' => $service->freelancer_id,
            'requirements' => $request->requirements,
            'original_price' => $serviceFee,
            'platform_fee' => $platformFee,
            'amount' => $totalAmount,
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
        if (Auth::user()->role !== User::ROLE_ADMIN && ($order->freelancer_id !== Auth::id() || Auth::user()->role !== User::ROLE_FREELANCER)) {
            abort(403);
        }

        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        if (Auth::user()->role !== User::ROLE_ADMIN && !($order->freelancer_id === Auth::id() && Auth::user()->role === User::ROLE_FREELANCER)) {
            abort(403);
        }

        $oldStatus = $order->status;
        $newStatus = $request->status;

        $order->update($request->validated());

        // Log the status change for admin actions
        if (Auth::user()->role === User::ROLE_ADMIN && $oldStatus !== $newStatus) {
            // You could add notification logic here for both client and freelancer
            // For now, we'll just log it
            \Log::info("Admin " . Auth::user()->name . " changed order #{$order->id} status from '{$oldStatus}' to '{$newStatus}'");

            // TODO: Send notifications to client and freelancer about status change
        }

        $message = Auth::user()->role === User::ROLE_ADMIN
            ? "Order status updated successfully. Both client and freelancer will be notified."
            : "Order status updated successfully.";

        // Redirect admins back to admin orders page
        if (Auth::user()->role === User::ROLE_ADMIN) {
            return redirect()->route('admin.orders.index')->with('status', $message);
        }

        return redirect()->back()->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        if (Auth::user()->role === User::ROLE_ADMIN) {
            $order->delete();
            return redirect()->route('orders.index')->with('status', 'Order removed successfully.');
        }

        if ($order->client_id !== Auth::id() || $order->status !== 'pending') {
            abort(403);
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('orders.index')->with('status', 'Order cancelled successfully.');
    }
}
