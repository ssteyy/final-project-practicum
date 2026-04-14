<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        $totalServices = Service::count();
        $totalOrders = Order::count();
        $totalClients = User::where('role', User::ROLE_CLIENT)->count();
        $totalFreelancers = User::where('role', User::ROLE_FREELANCER)->count();
        $recentOrders = Order::with('service', 'client', 'freelancer')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalServices',
            'totalOrders',
            'totalClients',
            'totalFreelancers',
            'recentOrders'
        ));
    }

    public function services(Request $request)
    {
        if (auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        $query = Service::with('freelancer');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhereHas('freelancer', function ($q) use ($request) {
                      $q->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        $services = $query->latest()->paginate(18)->withQueryString();

        return view('admin.services.index', compact('services'));
    }

    public function orders(Request $request)
    {
        if (auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        $query = Order::with('service', 'client', 'freelancer');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('id', $request->search)
                    ->orWhereHas('client', function ($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->search . '%');
                    })
                    ->orWhereHas('freelancer', function ($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->search . '%');
                    })
                    ->orWhereHas('service', function ($q) use ($request) {
                        $q->where('title', 'like', '%' . $request->search . '%');
                    });

            });
        }

        $orders = $query->latest()->paginate(18)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function users(Request $request)
    {
        if (auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        $query = User::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->paginate(18)->withQueryString();

        return view('admin.users.index', compact('users'));
    }
}
