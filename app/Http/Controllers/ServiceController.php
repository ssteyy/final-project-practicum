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
    public function index(Request $request)
    {
        $user = Auth::user();

        // Freelancer view
        if ($user && $user->role === User::ROLE_FREELANCER) {
            $query = $user->services();

            if ($request->has('category') && $request->category !== '') {
                $query->where('category', $request->category);
            }

            $services = $query->latest()->get();

            $categories = $user->services()
                ->distinct()
                ->pluck('category')
                ->sort();

            return view('services.freelancer-index', compact('services', 'categories'));
        }

        // Client view → ONLY published AND from active freelancers
        $query = Service::where('status', 'published')
            ->whereHas('freelancer', function($q) {
                $q->where('is_active', true);
            });

        if ($request->has('category') && $request->category !== '') {
            $query->where('category', $request->category);
        }

        if ($request->has('search') && $request->search !== '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $services = $query->latest()->get();

        $categories = Service::where('status', 'published')
            ->whereHas('freelancer', function($q) {
                $q->where('is_active', true);
            })
            ->distinct()
            ->pluck('category')
            ->sort();

        return view('services.index', compact('services', 'categories'));
    }

    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== User::ROLE_FREELANCER) {
            abort(403);
        }

        return view('services.create');
    }

    public function store(StoreServiceRequest $request)
    {
        $validated = $request->validated();
        $validated['freelancer_id'] = Auth::id();

        // New services start as draft, waiting for admin approval
        $validated['status'] = 'draft';

        // Pricing columns
        $validated['original_price'] = $validated['price'];
        $validated['platform_fee'] = $validated['price'] * 0.15;

        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('services', 'public');
            $validated['image_path'] = $path;
        }

        if ($request->filled('image_url')) {
            $validated['image_url'] = $request->input('image_url');
        }

        Service::create($validated);

        return redirect()->route('services.index')
            ->with('status', 'Service submitted. Waiting for admin approval.');
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
        // But can only view other freelancers' published services
        if (Auth::check() && Auth::user()->role === User::ROLE_FREELANCER) {
            if ($service->freelancer_id !== Auth::id() && $service->status !== 'published') {
                abort(403);
            }
        }

        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        if (Auth::user()->role !== User::ROLE_ADMIN && $service->freelancer_id !== Auth::id()) {
            abort(403);
        }

        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        if (Auth::user()->role !== User::ROLE_ADMIN && $service->freelancer_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validated();

        // 🚨 freelancer cannot change status
        if (Auth::user()->role !== User::ROLE_ADMIN) {
            unset($validated['status']);
        }

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

        return redirect()->route('services.index')->with('status', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if (Auth::user()->role !== User::ROLE_ADMIN && $service->freelancer_id !== Auth::id()) {
            abort(403);
        }

        $service->delete();

        return back()->with('status', 'Deleted successfully.');
    }

    public function approve(Service $service)
    {
        $service->update([
            'status' => 'published' // ✅ correct
        ]);

        return back();
    }

    public function reject(Service $service)
    {
        $service->update([
            'status' => 'rejected' // ✅ correct
        ]);

        return back();
    }
}
