@extends('layout')
@section('title','My Services')
@section('content')
  <h1 class="text-2xl font-bold mb-4">My Services</h1>
  <a href="{{ url('/freelancer/add-service') }}" class="bg-blue-600 text-white px-3 py-1 rounded mb-4 inline-block">Add New</a>
  <div class="space-y-4">
    @foreach($services as $s)
      <div class="bg-white p-4 rounded shadow flex justify-between items-center">
        <div>
          <h3 class="font-bold">{{ $s->title }}</h3>
          <p class="text-sm text-gray-500">${{ $s->price }}</p>
        </div>
        <div class="space-x-2">
          <a href="#" class="text-blue-600">Edit</a>
          <form method="POST" action="{{ url('/freelancer/my-services') }}" class="inline">@csrf @method('DELETE')<button class="text-red-600">Delete</button></form>
        </div>
      </div>
    @endforeach
  </div>
@endsection
