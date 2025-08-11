@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1>Bookings for {{ $user->name }}</h1>

    @if($bookings->count() > 0)
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Hotel</th>
                    <th>Room</th>
                    <th>Booking Date</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $index => $booking)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $booking->room->hotel->name ?? 'Not Available' }}</td>
                        <td>{{ $booking->room->type ?? 'Not Available' }}</td>
                        <td>{{ $booking->created_at->format('Y-m-d') }}</td>
                        <td>{{ $booking->check_in }}</td>
                        <td>{{ $booking->check_out }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info mt-4">No bookings found for this user.</div>
    @endif
</div>
@endsection
