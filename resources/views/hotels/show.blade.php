@extends('layouts.app')

@section('content')
<div class="container py-4" dir="rtl">
    
    <h1>{{ $hotel->name }}</h1>
    <div class="mb-4 text-center">
            <img src="{{ $hotel->image }}" alt="{{ $hotel->name }}" class="img-fluid rounded" style="max-height: 400px; width: auto;">
        </div>
    <p>{{ $hotel->description }}</p>
    <p>📍 {{ $hotel->location }}</p>

    <h3 class="mt-4">Available Rooms</h3>
    <div class="row">
        @foreach($hotel->rooms as $room)
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
    <h5 class="card-title">{{ $room->type }}</h5>
    <p class="card-text mb-1">
        <strong>Capacity:</strong> {{ $room->capacity }} guests
    </p>
    <p class="card-text mb-3">
        <strong>Price:</strong> ₪{{ $room->price }} / night
    </p>
    <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-primary">View Room</a>
</div>

            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
