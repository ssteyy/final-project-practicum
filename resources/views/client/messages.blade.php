@extends('layout')
@section('title','Messages')
@section('content')
  <h1 class="text-2xl font-bold mb-4">Messages</h1>

  <div class="bg-white p-4 rounded shadow max-w-2xl mx-auto">
    <div class="space-y-2 mb-4">
      @foreach($messages ?? [] as $m)
        <div><strong>{{ $m->sender->name }}:</strong> {{ $m->message }}</div>
      @endforeach
    </div>

    <form method="POST" action="{{ route('chat.send') }}">@csrf
      <input type="hidden" name="receiver_id" value="{{ $userId ?? '' }}">
      <input name="message" class="w-full border px-3 py-2 mb-2" placeholder="Type message...">
      <button class="bg-blue-600 text-white px-4 py-2 rounded">Send</button>
    </form>
  </div>
@endsection
