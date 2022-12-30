<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>App Name - @yield('title')</title>
    <link rel="icon" href="https://laravel.com/img/favicon/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</head>
<body class="d-flex flex-column h-100">
<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">My Application</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#w2-collapse"
                    aria-controls="w2-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="w2-collapse" class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0 nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vote') }}">Vote</a>
                    </li>
                </ul>
                <a class="btn btn-link logout text-decoration-none" href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </nav>
</header>
<main role="main" class="flex-shrink-0">
    <div class="container">
        @yield('content')
    </div>
</main>
<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; Girls {{ date('Y') }}</p>
        <p class="float-end"></p>
    </div>
</footer>
</body>
</html>
