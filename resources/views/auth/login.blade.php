@extends('layout')
@section('title','Login')
@section('content')
  <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Login</h2>
    <form method="POST" action="{{ url('/login') }}">@csrf
      <label class="block mb-1">Email</label>
      <input type="email" name="email" class="w-full border px-3 py-2 mb-3" required>
      <label class="block mb-1">Password</label>
      <input type="password" name="password" class="w-full border px-3 py-2 mb-3" required>
      <button class="bg-blue-600 text-white px-4 py-2 rounded">Login</button>
    </form>
  </div>
@endsection
