<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\ServiceController;
use App\Models\Service;

Route::get('/', function () {
    $services = Service::where('status', 'published')->latest()->take(6)->get();
    return view('home', compact('services'));
})->name('home');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');

Route::resource('services', ServiceController::class)->middleware(['auth', 'verified']);

// Route::get('orders/create/{service}', [App\Http\Controllers\OrderController::class, 'create'])->name('orders.create');
// Route::get('orders/create/{service}', [App\Http\Controllers\OrderController::class, 'create']) ->middleware(['auth', 'verified']) ->name('orders.create');
Route::resource('orders', App\Http\Controllers\OrderController::class)->middleware(['auth', 'verified']);

// Google OAuth Routes
Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

// Chat Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/messages', [App\Http\Controllers\ChatController::class, 'index'])->name('messages.index');
    Route::get('/chat/{order}', [App\Http\Controllers\ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{order}', [App\Http\Controllers\ChatController::class, 'store'])->name('chat.store');
    Route::get('/chat/{order}/messages', [App\Http\Controllers\ChatController::class, 'getMessages'])->name('chat.messages');
});

require __DIR__.'/auth.php';
