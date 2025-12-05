<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;

Route::get('/', [HomeController::class,'index'])->name('home');

// Auth
Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login']);
Route::get('/register',[AuthController::class,'showRegister']);
Route::post('/register',[AuthController::class,'register']);
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

// Profile update
Route::post('/profile',[AuthController::class,'profileUpdate'])->middleware('auth')->name('profile.update');

// Public services
Route::get('/services',[ServiceController::class,'index'])->name('services.index');
Route::get('/service/{service}',[ServiceController::class,'show'])->name('services.show');

// Auth routes
Route::middleware('auth')->group(function(){

    Route::post('/service/{service}/order',[OrderController::class,'place'])->middleware('client')->name('orders.place');

    // Freelancer routes
    Route::prefix('freelancer')->middleware('freelancer')->group(function(){
        Route::get('/dashboard',[ServiceController::class,'myServices'])->name('freelancer.dashboard');
        Route::get('/my-services',[ServiceController::class,'myServices'])->name('freelancer.services');
        Route::get('/add-service',[ServiceController::class,'create'])->name('freelancer.add-service');
        Route::post('/add-service',[ServiceController::class,'store'])->name('freelancer.store-service');
        Route::get('/orders',[OrderController::class,'freelancerOrders'])->name('freelancer.orders');
        Route::post('/orders/{order}/status',[OrderController::class,'updateStatus'])->name('freelancer.order.status');
        Route::get('/edit-service/{service}', [ServiceController::class,'edit'])->name('freelancer.service.edit');
        Route::post('/update-service/{service}', [ServiceController::class,'update'])->name('freelancer.service.update');
        Route::delete('/delete-service/{service}', [ServiceController::class,'destroy'])->name('freelancer.service.destroy');
    });

    // Client routes
    Route::prefix('client')->middleware('client')->group(function(){
        Route::get('/dashboard',[AdminController::class,'dashboard'])->name('client.dashboard'); // placeholder
        Route::get('/orders',[OrderController::class,'clientOrders'])->name('client.orders');
        Route::get('/messages',[MessageController::class,'chat'])->name('client.messages');
        Route::get('/order/{order}/review', [ReviewController::class,'create'])->name('order.review.create');
        Route::post('/order/{order}/review', [ReviewController::class,'store'])->name('order.review.store');
    });

    // Messaging
    Route::get('/chat/{userId}', [MessageController::class,'chat'])->name('chat.show');
    Route::post('/chat/send', [MessageController::class,'send'])->name('chat.send');

    // Admin
    Route::get('/admin',[AdminController::class,'dashboard'])->middleware('auth')->name('admin.dashboard');
});