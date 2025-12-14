<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Daichi No</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/adminPage/dashboard.css') }}">
</head>
<body>
    <div class="bg-decoration"></div>

    <div class="dashboard-container">
        <div class="welcome-card">
            <div class="level">
                <div class="level-left">
                    <div>
                        <h1 class="title is-2">Welcome, Admin.</h1>
                        <p class="subtitle is-5">Management System for <strong>Daichi No</strong></p>
                    </div>
                </div>
                <div class="level-right">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="button is-logout">
                            <span class="icon is-small">
                                <i class="fas fa-sign-out-alt"></i>
                            </span>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @if(session('status'))
            <div class="notification is-success">
                <button class="delete"></button>
                {{ session('status') }}
            </div>
        @endif

        <div class="columns is-multiline mb-6">
            <div class="column is-3">
                <div class="stats-card">
                    <p class="heading">Total Users</p>
                    <p class="stats-number">{{ \App\Models\User::where('role', 'customer')->count() }}</p>
                </div>
            </div>
            <div class="column is-3">
                <div class="stats-card">
                    <p class="heading">Total Products</p>
                    <p class="stats-number">60</p>
                </div>
            </div>
            <div class="column is-3">
                <div class="stats-card">
                    <p class="heading">Total Reservasi</p>
                    <p class="stats-number">{{ \App\Models\Reservation::count() }}</p>
                </div>
            </div>
        </div>

        <div class="has-text-centered mb-5">
             <h2 class="title is-3" style="position: relative; display: inline-block;">
                Admin Menu
                <span style="position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 60px; height: 3px; background-color: var(--accent-color);"></span>
            </h2>
        </div>

        <div class="columns is-multiline">
            <div class="column is-4">
                <a href="{{ route('admin.users.index') }}" class="menu-card">
                    <span class="icon is-large">
                        <i class="fas fa-users fa-3x"></i>
                    </span>
                    <p class="title">Users</p>
                    <p class="subtitle">Manage customers & staff</p>
                </a>
            </div>

            <div class="column is-4">
                <a href="{{ route('admin.reservations.index') }}" class="menu-card">
                    <span class="icon is-large">
                        <i class="fas fa-calendar-check fa-3x"></i>
                    </span>
                    <p class="title">Reservations</p>
                    <p class="subtitle">Manage table bookings</p>
                </a>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>