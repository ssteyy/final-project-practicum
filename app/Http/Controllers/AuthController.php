<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class AuthController extends Controller {
    public function showLogin(){ return view('auth.login'); }
    public function showRegister(){ return view('auth.register'); }

    public function register(Request $req){
        $data = $req->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users',
            'password'=> ['required','confirmed', Password::defaults()],
            'role'=>'required|in:freelancer,client',
        ]);

        $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'role'=>$data['role']
        ]);

        Auth::login($user);
        return redirect('/');
    }

    public function login(Request $req){
        $credentials = $req->validate(['email'=>'required|email','password'=>'required']);
        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors(['email'=>'Invalid credentials']);
    }

    public function logout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect('/');
    }

    // Profile update (avatar upload)
    public function profileUpdate(Request $req){
        $user = Auth::user();
        if (!$user) {
            return back()->withErrors(['error' => 'User not authenticated']);
        }
        $data = $req->validate([
            'name'=>'required|string|max:255',
            'bio'=>'nullable|string',
            'avatar'=>'nullable|image|max:2048'
        ]);
        if($req->hasFile('avatar')){
            $path = $req->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }
        $user->name = $data['name'];
        $user->bio = $data['bio'] ?? $user->bio;
        $user->save();
        return back()->with('success','Profile updated');
    }
}
