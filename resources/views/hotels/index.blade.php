@extends('layouts.app')

@section('content')
<div class="container py-4">
    <form method="GET" action="{{ route('hotels.index') }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="location" class="form-control" placeholder="Search by location" value="{{ request('location') }}">
            </div>
            <div class="col-md-3">
                <input type="number" name="min_price" class="form-control" placeholder="Min Price" value="{{ request('min_price') }}">
            </div>
            <div class="col-md-3">
                <input type="number" name="max_price" class="form-control" placeholder="Max Price" value="{{ request('max_price') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </div>
    </form>

    <div class="row">
        @forelse($hotels as $hotel)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <img src="{{ $hotel->image }}" class="card-img-top" alt="{{ $hotel->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $hotel->name }}</h5>
                    <p class="text-muted">{{ $hotel->location }}</p>
                    <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-outline-primary">View Details</a>
                </div>
            </div>
        </div>
        @empty
        <p>No hotels found.</p>
        @endforelse
    </div>
</div>
@endsection
