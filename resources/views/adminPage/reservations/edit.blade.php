<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/adminPage/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <!-- Header -->
        <div class="welcome-card">
            <div class="level">
                <div class="level-left">
                    <div>
                        <h1 class="title is-2">Edit Reservation</h1>
                    </div>
                </div>
                <div class="level-right">
                    <a href="{{ route('admin.reservations.index') }}" class="button is-info mr-2">
                        <span class="icon is-small">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span>Kembali</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
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

        <!-- Alerts -->
        @if($errors->any())
            <div class="notification is-danger">
                <button class="delete"></button>
                <strong>Please fix the following errors:</strong>
                <ul style="margin: 0.5rem 0 0 1.5rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 8px; padding: 2rem; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
            <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="field">
                    <label class="label">Full Name</label>
                    <div class="control">
                        <input class="input" type="text" name="full_name" value="{{ old('full_name', $reservation->full_name) }}" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                        <input class="input" type="email" name="email" value="{{ old('email', $reservation->email) }}" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Phone</label>
                    <div class="control">
                        <input class="input" type="text" name="phone" value="{{ old('phone', $reservation->phone) }}" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Date</label>
                    <div class="control">
                        <input class="input" type="date" name="date" value="{{ old('date', $reservation->date) }}" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Start Time</label>
                    <div class="control">
                        <input class="input" type="time" name="time_start" value="{{ old('time_start', $reservation->time_start) }}" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">End Time</label>
                    <div class="control">
                        <input class="input" type="time" name="time_end" value="{{ old('time_end', $reservation->time_end) }}" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Number of Guests</label>
                    <div class="control">
                        <input class="input" type="number" name="guests" value="{{ old('guests', $reservation->guests) }}" min="1" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Special Request</label>
                    <div class="control">
                        <textarea class="textarea" name="special_request">{{ old('special_request', $reservation->special_request) }}</textarea>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-success">
                            <span class="icon is-small">
                                <i class="fas fa-save"></i>
                            </span>
                            <span>Update Reservation</span>
                        </button>
                    </div>
                    <div class="control">
                        <a href="{{ route('admin.reservations.index') }}" class="button is-light">
                            <span>Cancel</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/adminPage/dashboard.js') }}"></script>
</body>
</html>
