@extends('layout')
@section('title','Services')
@section('content')
<h2>All Services</h2>
<div class="row">
  @foreach($services as $s)
  <div class="col-md-4 mb-4">
    <div class="card">
      @if($s->thumbnail)<img src="{{ asset('storage/'.$s->thumbnail) }}" class="card-img-top" alt="">@endif
      <div class="card-body">
        <h5>{{ $s->title }}</h5>
        <p class="text-muted">By {{ $s->freelancer->name }}</p>
        <p class="fw-bold">${{ $s->price }}</p>
        <a href="{{ route('services.show',$s) }}" class="btn btn-sm btn-primary">Open</a>
      </div>
    </div>
  </div>
  @endforeach
</div>
<div class="mt-4">{{ $services->links() }}</div>
@endsection
