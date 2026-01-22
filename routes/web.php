<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('home');
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

Route::resource('services', ServiceController::class)->middleware(['auth', 'verified']);

Route::get('orders/create/{service}', [App\Http\Controllers\OrderController::class, 'create'])->name('orders.create');
Route::resource('orders', App\Http\Controllers\OrderController::class)->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
