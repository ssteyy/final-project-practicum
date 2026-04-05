<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Service;
use App\Models\Order;
use App\Models\Message;
use App\Models\Review;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| RESTful API routes for core tables
|--------------------------------------------------------------------------
*/

// Users
Route::get('/users', function (Request $request) {
    return User::query()
        ->paginate($request->integer('per_page', 15));
});

Route::post('/users', function (Request $request) {
    $user = User::create($request->only((new User())->getFillable()));
    return response()->json($user, 201);
});

Route::get('/users/{user}', function (User $user) {
    return $user;
});

Route::match(['put', 'patch'], '/users/{user}', function (Request $request, User $user) {
    $user->update($request->only($user->getFillable()));
    return $user->fresh();
});

Route::delete('/users/{user}', function (User $user) {
    $user->delete();
    return response()->noContent();
});

// Services
Route::get('/services', function (Request $request) {
    return Service::query()
        ->with('freelancer')
        ->paginate($request->integer('per_page', 15));
});

Route::post('/services', function (Request $request) {
    $service = Service::create($request->only((new Service())->getFillable()));
    return response()->json($service->load('freelancer'), 201);
});

Route::get('/services/{service}', function (Service $service) {
    return $service->load('freelancer');
});

Route::match(['put', 'patch'], '/services/{service}', function (Request $request, Service $service) {
    $service->update($request->only($service->getFillable()));
    return $service->fresh()->load('freelancer');
});

Route::delete('/services/{service}', function (Service $service) {
    $service->delete();
    return response()->noContent();
});

// Orders
Route::get('/orders', function (Request $request) {
    return Order::query()
        ->with(['service', 'client', 'freelancer', 'review'])
        ->paginate($request->integer('per_page', 15));
});

Route::post('/orders', function (Request $request) {
    $order = Order::create($request->only((new Order())->getFillable()));
    return response()->json($order->load(['service', 'client', 'freelancer', 'review']), 201);
});

Route::get('/orders/{order}', function (Order $order) {
    return $order->load(['service', 'client', 'freelancer', 'review']);
});

Route::match(['put', 'patch'], '/orders/{order}', function (Request $request, Order $order) {
    $order->update($request->only($order->getFillable()));
    return $order->fresh()->load(['service', 'client', 'freelancer', 'review']);
});

Route::delete('/orders/{order}', function (Order $order) {
    $order->delete();
    return response()->noContent();
});

// Messages
Route::get('/messages', function (Request $request) {
    return Message::query()
        ->with(['order', 'sender', 'receiver'])
        ->paginate($request->integer('per_page', 15));
});

Route::post('/messages', function (Request $request) {
    $message = Message::create($request->only((new Message())->getFillable()));
    return response()->json($message->load(['order', 'sender', 'receiver']), 201);
});

Route::get('/messages/{message}', function (Message $message) {
    return $message->load(['order', 'sender', 'receiver']);
});

Route::match(['put', 'patch'], '/messages/{message}', function (Request $request, Message $message) {
    $message->update($request->only($message->getFillable()));
    return $message->fresh()->load(['order', 'sender', 'receiver']);
});

Route::delete('/messages/{message}', function (Message $message) {
    $message->delete();
    return response()->noContent();
});

// Reviews
Route::get('/reviews', function (Request $request) {
    return Review::query()
        ->with(['order', 'client', 'freelancer'])
        ->paginate($request->integer('per_page', 15));
});

Route::post('/reviews', function (Request $request) {
    $review = Review::create($request->only((new Review())->getFillable()));
    return response()->json($review->load(['order', 'client', 'freelancer']), 201);
});

Route::get('/reviews/{review}', function (Review $review) {
    return $review->load(['order', 'client', 'freelancer']);
});

Route::match(['put', 'patch'], '/reviews/{review}', function (Request $request, Review $review) {
    $review->update($request->only($review->getFillable()));
    return $review->fresh()->load(['order', 'client', 'freelancer']);
});

Route::delete('/reviews/{review}', function (Review $review) {
    $review->delete();
    return response()->noContent();
});
