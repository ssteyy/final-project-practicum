@extends('layout')
@section('title','Freelancer Dashboard')
@section('content')
  <h1 class="text-2xl font-bold mb-4">Freelancer Dashboard</h1>
  <div class="grid md:grid-cols-3 gap-6">
    <a href="{{ url('/freelancer/my-services') }}" class="bg-white p-4 rounded shadow text-center">My Services</a>
    <a href="{{ url('/freelancer/add-service') }}" class="bg-white p-4 rounded shadow text-center">Add Service</a>
    <a href="{{ url('/freelancer/orders') }}" class="bg-white p-4 rounded shadow text-center">Orders</a>
  </div>
@endsection
