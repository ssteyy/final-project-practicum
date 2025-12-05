<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller {
    public function index(){
        $services = Service::where('status','published')->latest()->paginate(12);
        return view('services', compact('services'));
    }

    public function show(Service $service){
        return view('service-detail', compact('service'));
    }

    public function create(){
        return view('freelancer.add-service');
    }

    public function store(Request $req){
        $data = $req->validate([
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'price'=>'required|numeric|min:0',
            'category'=>'nullable|string|max:100',
            'thumbnail'=>'nullable|image|max:4096'
        ]);
        $data['user_id'] = Auth::id();
        $data['status'] = 'published';

        if($req->hasFile('thumbnail')){
            $data['thumbnail'] = $req->file('thumbnail')->store('services','public');
        }

        Service::create($data);
        return redirect('/freelancer/my-services')->with('success','Service created');
    }

    public function edit(Service $service){
        $this->authorize('update', $service);
        return view('freelancer.edit-service', compact('service'));
    }

    public function update(Request $req, Service $service){
        $this->authorize('update', $service);
        $data = $req->validate([
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'price'=>'required|numeric|min:0',
            'category'=>'nullable|string|max:100',
            'thumbnail'=>'nullable|image|max:4096'
        ]);
        if($req->hasFile('thumbnail')){
            $path = $req->file('thumbnail')->store('services','public');
            $service->thumbnail = $path;
        }
        $service->update($data);
        return redirect('/freelancer/my-services')->with('success','Service updated');
    }

    public function destroy(Service $service){
        $this->authorize('delete',$service);
        $service->delete();
        return back()->with('success','Service removed');
    }

    public function myServices(){
        $services = Auth::user()->services()->latest()->get();
        return view('freelancer.my-services', compact('services'));
    }
}