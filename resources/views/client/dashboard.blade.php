@extends('layout')
@section('title','Client Dashboard')
@section('content')
  <h1 class="text-2xl font-bold mb-4">Client Dashboard</h1>
  <div class="grid md:grid-cols-3 gap-6">
    <a href="{{ route('services.index') }}" class="bg-white p-4 rounded shadow text-center">Browse Services</a>
    <a href="{{ route('client.orders') }}" class="bg-white p-4 rounded shadow text-center">My Orders</a>
    <a href="{{ url('/client/messages') }}" class="bg-white p-4 rounded shadow text-center">Messages</a>
  </div>
@endsection
