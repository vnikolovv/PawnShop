<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawnshop</title>
     <!-- TODO - тук да добавя правилния bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css\styles.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
                    <img src="https://cdn-icons-png.flaticon.com/512/3044/3044885.png" alt="Logo"
                        style="height: 30px; margin-right: 10px;">
                      Pawnshop
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'products' ? 'active' : '' }}"
                                href="/products">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'contacts' ? 'active' : '' }}"
                                href="/contacts">Contacts</a>
                        </li>
                        @if (Auth::check() && Auth::user()->name == 'admin')
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteName() == 'add-product' ? 'active' : '' }}" href="/add-product">Add
                                    Product</a>
                            </li>
                        @endif
                    </ul>
                    <div class="d-flex align-items-center gap-4">
                        @if (!Auth::check())
                            <a href="/login" class="btn btn-outline-light {{ Route::currentRouteName() == 'login' ? 'active' : '' }}">Login</a>
                            <a href="/register" class="btn btn-outline-light {{ Route::currentRouteName() == 'register' ? 'active' : '' }}">Register</a>
                        @else
                        <form method="POST" action="{{ route('user.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-light">Logout</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="container py-4" style="min-height:80vh;">
        @if (Session::has('success'))
            <div class="text-golden">{{ Session('success') }}</div>
        @endif
        @section('maincontent')
        @show
    </main>
    <footer class="bg-dark text-center py-5 mt-auto">
        <div class="container">
            <span class="text-light">© 2025 All rights reserved</span>
        </div>
    </footer>
</body>

</html>