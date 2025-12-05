@extends('layout')
@section('title','Home')
@section('content')
<div class="text-center mb-4">
  <h1 class="display-5">Hire trusted freelancers</h1>
  <p class="lead">Find professionals for web, design, content and more.</p>
  <a href="{{ route('services.index') }}" class="btn btn-primary">Browse Services</a>
</div>

<div class="row">
  @foreach($services as $s)
  <div class="col-md-4 mb-4">
    <div class="card h-100">
      @if($s->thumbnail)<img src="{{ asset('storage/'.$s->thumbnail) }}" class="card-img-top" alt="">@endif
      <div class="card-body">
        <h5 class="card-title">{{ $s->title }}</h5>
        <p class="card-text text-muted">By {{ $s->freelancer->name }}</p>
        <p class="fw-bold">${{ $s->price }}</p>
        <a href="{{ route('services.show',$s) }}" class="btn btn-sm btn-outline-primary">View</a>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection
