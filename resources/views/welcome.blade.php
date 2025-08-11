@extends('layouts.app')

@push('styles')
<style>
    .hero {
        background:
          linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)),
          url('{{ asset("image/main.jpg") }}') center/cover no-repeat;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-shadow: 1px 1px 8px rgba(0,0,0,0.6);
    }
    .hero h1 {
        font-size: 3.5rem;
    }
</style>
@endpush

@section('content')
    <div class="hero">
        <div class="text-center">
            <h1>Welcome to Palestine Hotels</h1>
            <p class="lead">Luxury • Comfort • Elegance</p>
            <a href="{{ route('hotels.index')}}" class="btn btn-light btn-lg mt-3">Hotels</a>
        </div>
    </div>
@endsection
