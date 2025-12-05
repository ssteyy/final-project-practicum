@extends('layout')
@section('title',$service->title)
@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card mb-3">
      @if($service->thumbnail)<img src="{{ asset('storage/'.$service->thumbnail) }}" class="card-img-top">@endif
      <div class="card-body">
        <h3>{{ $service->title }}</h3>
        <p class="text-muted">By {{ $service->freelancer->name }}</p>
        <p>{{ $service->description }}</p>
        <p class="fw-bold">${{ $service->price }}</p>
      </div>
    </div>

    <h5>Reviews ({{ $service->reviews()->count() }})</h5>
    @foreach($service->reviews as $r)
      <div class="border p-3 mb-2">
        <strong>Rating: {{ $r->rating }}/5</strong>
        <p>{{ $r->comment }}</p>
      </div>
    @endforeach
  </div>

  <div class="col-md-4">
    @auth
      @if(auth()->user()->role === 'client')
        <form method="POST" action="{{ route('orders.place', $service) }}">@csrf
          <div class="mb-3">
            <label>Requirements</label>
            <textarea name="requirements" class="form-control"></textarea>
          </div>
          <button class="btn btn-success">Order Now</button>
        </form>
      @else
        <div class="alert alert-info">Only clients can place orders.</div>
      @endif
    @else
      <a href="{{ route('login') }}" class="btn btn-primary">Login to Order</a>
    @endauth
  </div>
</div>
@endsection
