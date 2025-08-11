@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <h1 class="mb-4 text-center">Room Type: {{ $room->type }}</h1>

        <div class="d-flex flex-column flex-md-row align-items-center gap-4">
            @if($room->image)
                <div style="flex: 1; max-width: 400px;">
                    <img src="{{ $room->image }}" alt="Room Image" class="w-100 img-fluid rounded shadow-sm">
                </div>
            @endif

            <div style="flex: 2; min-width: 250px;">
                <p><strong>Capacity:</strong> {{ $room->capacity }} guests</p>
                <p><strong>Price:</strong> ₪{{ $room->price}} / per night</p>
                
                <form action="{{ route('bookings.store') }}" method="POST" class="mt-3">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">

                    <div class="mb-2">
                        <label>Check-in Date:</label>
                        <input type="date" name="check_in" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Check-out Date:</label>
                        <input type="date" name="check_out" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg">Book Now</button>
                </form>
            </div>
        </div>
    </div>
@endsection
