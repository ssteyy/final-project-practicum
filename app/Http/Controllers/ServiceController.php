<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user && $user->role === User::ROLE_FREELANCER) {
            $query = $user->services();

            // Filter by category if provided
            if ($request->has('category') && $request->category !== '') {
                $query->where('category', $request->category);
            }

            $services = $query->latest()->get();

            // Get all unique categories for this freelancer
            $categories = $user->services()
                ->distinct()
                ->pluck('category')
                ->sort();

            return view('services.freelancer-index', compact('services', 'categories'));
        }

        // Client/Guest view: show all published services
        $query = Service::where('status', 'published');

        // Filter by category if provided
        if ($request->has('category') && $request->category !== '') {
            $query->where('category', $request->category);
        }

        // Filter by price range if provided
        if ($request->has('min_price') && $request->min_price !== '') {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price !== '') {
            $query->where('price', '<=', $request->max_price);
        }

        // Search by title or description
        if ($request->has('search') && $request->search !== '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $services = $query->latest()->get();

        // Get all unique categories for filter
        $categories = Service::where('status', 'published')
            ->distinct()
            ->pluck('category')
            ->sort();

        return view('services.index', compact('services', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            abort(403);
        }
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $validated = $request->validated();
        $validated['freelancer_id'] = Auth::id();

        // Handle image upload from file
        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('services', 'public');
            $validated['image_path'] = $path;
        }

        // If image_url is provided, use it
        if ($request->filled('image_url')) {
            $validated['image_url'] = $request->input('image_url');
        }

        Service::create($validated);

        return redirect()->route('services.index')->with('status', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        // Only published services are viewable by clients/guests
        if (Auth::guest() || Auth::user()->role === User::ROLE_CLIENT) {
            if ($service->status !== 'published') {
                abort(404);
            }
        }

        // Freelancer can view their own services regardless of status
        if (Auth::check() && Auth::user()->role === User::ROLE_FREELANCER && $service->freelancer_id !== Auth::id()) {
            abort(403);
        }

        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        if ($service->freelancer_id !== Auth::id() || Auth::user()->role !== User::ROLE_FREELANCER) {
            abort(403);
        }
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $validated = $request->validated();

        // Handle image upload from file
        if ($request->hasFile('image_path')) {
            // Delete old image if exists
            if ($service->image_path && Storage::disk('public')->exists($service->image_path)) {
                Storage::disk('public')->delete($service->image_path);
            }
            $path = $request->file('image_path')->store('services', 'public');
            $validated['image_path'] = $path;
        }

        // If image_url is provided, use it
        if ($request->filled('image_url')) {
            $validated['image_url'] = $request->input('image_url');
        }

        $service->update($validated);

        return redirect()->route('services.index')->with('status', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if ($service->freelancer_id !== Auth::id() || Auth::user()->role !== User::ROLE_FREELANCER) {
            abort(403);
        }

        $service->delete();

        return redirect()->route('services.index')->with('status', 'Service deleted successfully.');
    }
}
