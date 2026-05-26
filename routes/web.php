<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\ServiceController;
use App\Models\Service;
use App\Models\User;
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

Route::get('/', function () {
    $services = Service::where('status', 'published')
        ->whereHas('freelancer', function($q) {
            $q->where('is_active', true);
        })
        ->latest()
        ->take(6)
        ->get();
    return view('home', compact('services'));
})->name('home');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->role === User::ROLE_ADMIN) {
        return redirect()->route('admin.dashboard');
    }

    $recentServices = [];
    if (auth()->check() && auth()->user()->role === \App\Models\User::ROLE_FREELANCER) {
        $recentServices = auth()->user()->services()->orderBy('status')->orderBy('created_at', 'desc')->take(3)->get();
    }

    return view('dashboard', compact('recentServices'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/services', [AdminController::class, 'services'])->name('services.index');
    Route::get('/services/create', [AdminController::class, 'createService'])->name('services.create');
    Route::post('/services', [AdminController::class, 'storeService'])->name('services.store');
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders.index');
    Route::get('/orders/{order}', [AdminController::class, 'showOrder'])->name('orders.show');
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('users.show');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::patch('/users/{user}/reactivate', [AdminController::class, 'reactivateUser'])->name('users.reactivate');
    Route::patch('/services/{service}/approve', [ServiceController::class, 'approve'])->name('services.approve');
    Route::patch('/services/{service}/reject', [ServiceController::class, 'reject'])->name('services.reject');
    Route::get('/export/orders', [AdminController::class, 'exportOrders'])->name('export.orders');
});

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
    // Redirect old chat.show to unified interface
    Route::get('/chat/{order}', function(App\Models\Order $order) {
        $otherUserId = auth()->id() === $order->client_id ? $order->freelancer_id : $order->client_id;
        return redirect()->route('messages.index', ['user' => $otherUserId]);
    })->name('chat.show');
    Route::post('/chat/{order}', [App\Http\Controllers\ChatController::class, 'store'])->name('chat.store');
    Route::get('/chat/{order}/messages', [App\Http\Controllers\ChatController::class, 'getMessages'])->name('chat.messages');

    // KHQR Bakong Payment Routes (works without token for QR generation)
    Route::get('/orders/{order}/pay', [App\Http\Controllers\PaymentController::class, 'generateQR'])->name('orders.pay');
    Route::get('/orders/{order}/payment-status', [App\Http\Controllers\PaymentController::class, 'checkStatus'])->name('orders.payment.status');

    // TEST ONLY route - marks order as paid without real payment
    Route::post('/orders/{order}/mark-paid-test', [App\Http\Controllers\PaymentController::class, 'markAsPaidTest'])
        ->name('orders.mark-paid-test');

    // Temporary debug route - remove after testing
    Route::get('/orders/{order}/debug-khqr', [App\Http\Controllers\PaymentController::class, 'debugDecodeKHQR']);
});

// Review Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/orders/{order}/reviews', [App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
});

require __DIR__.'/auth.php';
