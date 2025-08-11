<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Shahd Hotel</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />

    <!-- icon for browser -->
    <link rel="icon" href="{{ asset('image/hotel.png') }}" />

    <!-- css file -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;700&family=Lateef:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- page-specific styles -->
    @stack('styles')

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Shahd Hotel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('main') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('bookings.show')}}">Booking</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
               <li class="nav-item">
        <a class="nav-link" href="#" title="User Profile">
            <i class="bi bi-person-circle" style="font-size: 1.4rem;"></i>
        </a>
    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} Shahd Hotel. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- page-specific scripts -->
    @stack('scripts')
</body>
</html>
