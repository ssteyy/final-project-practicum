<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;

class AdminController extends Controller {
    public function dashboard(){
        $users = User::latest()->paginate(20);
        $services = Service::latest()->paginate(20);
        return view('admin.dashboard', compact('users','services'));
    }
}