@extends('layout')
@section('title','Orders')
@section('content')
  <h1 class="text-2xl font-bold mb-4">Orders</h1>
  @foreach($orders as $o)
    <div class="bg-white p-4 rounded shadow mb-3">
      <div class="flex justify-between">
        <div>
          <h3 class="font-bold">Order #{{ $o->id }} - {{ $o->service->title }}</h3>
          <p class="text-sm text-gray-500">Client: {{ $o->client->name }}</p>
        </div>
        <div>
          <form method="POST" action="{{ url('/freelancer/orders/'.$o->id.'/status') }}">@csrf
            <select name="status" class="border px-2 py-1">
              <option value="accepted">Accept</option>
              <option value="in_progress">In Progress</option>
              <option value="completed">Complete</option>
              <option value="cancelled">Cancel</option>
            </select>
            <button class="bg-blue-600 text-white px-2 py-1 rounded">Update</button>
          </form>
        </div>
      </div>
    </div>
  @endforeach
@endsection
