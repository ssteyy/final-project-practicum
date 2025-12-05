@extends('layout')
@section('title','My Orders')
@section('content')
  <h1 class="text-2xl font-bold mb-4">My Orders</h1>
  @foreach($orders as $o)
    <div class="bg-white p-4 rounded shadow mb-3">
      <h3 class="font-bold">{{ $o->service->title }}</h3>
      <p class="text-sm text-gray-500">Freelancer: {{ $o->freelancer->name }}</p>
      <p>Status: <span class="font-semibold">{{ $o->status }}</span></p>
    </div>
  @endforeach
@endsection
