@extends('layout')
@section('title','Add Service')
@section('content')
  <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Add Service</h2>
    <form method="POST" action="{{ url('/freelancer/add-service') }}">@csrf
      <label class="block mb-1">Title</label>
      <input name="title" class="w-full border px-3 py-2 mb-3" required>
      <label class="block mb-1">Description</label>
      <textarea name="description" class="w-full border px-3 py-2 mb-3" required></textarea>
      <label class="block mb-1">Price</label>
      <input name="price" type="number" step="0.01" class="w-full border px-3 py-2 mb-3" required>
      <button class="bg-green-600 text-white px-4 py-2 rounded">Create</button>
    </form>
  </div>
@endsection
