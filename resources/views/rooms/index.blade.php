<!-- resources/views/rooms/show.blade.php -->
@extends('layouts.app')

@section('')
<div class="container py-4">
    <h1>{{ $room->type }}</h1>
    <p>Capacity: {{ $room->capacity }}</p>
    <p>💰 ${{ $room->price }} / night</p>

    <form method="POST" action="{{ route('bookings.store') }}">
        @csrf
        <input type="hidden" name="room_id" value="{{ $room->id }}">
        <div class="mb-3">
            <label>Check-in</label>
            <input type="date" name="check_in" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Check-out</label>
            <input type="date" name="check_out" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Book Now</button>
    </form>
</div>
@endsection
