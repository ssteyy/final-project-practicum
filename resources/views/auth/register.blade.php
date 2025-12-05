@extends('layout')
@section('title','Register')
@section('content')
  <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Register</h2>
    <form method="POST" action="{{ url('/register') }}">@csrf
      <label class="block mb-1">Name</label>
      <input type="text" name="name" class="w-full border px-3 py-2 mb-3" required>
      <label class="block mb-1">Email</label>
      <input type="email" name="email" class="w-full border px-3 py-2 mb-3" required>
      <label class="block mb-1">Role</label>
      <select name="role" class="w-full border px-3 py-2 mb-3" required>
        <option value="client">Client</option>
        <option value="freelancer">Freelancer</option>
      </select>
      <label class="block mb-1">Password</label>
      <input type="password" name="password" class="w-full border px-3 py-2 mb-3" required>
      <label class="block mb-1">Confirm Password</label>
      <input type="password" name="password_confirmation" class="w-full border px-3 py-2 mb-3" required>
      <button class="bg-blue-600 text-white px-4 py-2 rounded">Register</button>
    </form>
  </div>
@endsection
