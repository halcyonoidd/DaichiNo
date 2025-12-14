<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Reservation - Admin Dashboard</title>
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
                        <h1 class="title is-2">Add Reservation</h1>
                    </div>
                </div>
                <div class="level-right">
                    <a href="{{ route('admin.reservations.index') }}" class="button is-info mr-2">
                        <span class="icon is-small">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span>Back</span>
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
            <form action="{{ route('admin.reservations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="field">
                    <label class="label">Title</label>
                    <div class="control">
                        <input class="input" type="text" name="title" value="{{ old('title') }}" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Badge</label>
                    <div class="control">
                        <input class="input" type="text" name="badge" value="{{ old('badge') }}" placeholder="e.g., Bronze / Silver / Gold">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Duration</label>
                    <div class="control">
                        <input class="input" type="text" name="duration" value="{{ old('duration') }}" placeholder="2.5 hours" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Room</label>
                    <div class="control">
                        <input class="input" type="text" name="room" value="{{ old('room') }}" placeholder="e.g., Garden Room" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Price (Rp)</label>
                    <div class="control">
                        <input class="input" type="number" name="price" value="{{ old('price') }}" min="0" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Capacity (Guests)</label>
                    <div class="control">
                        <input class="input" type="number" name="capacity" value="{{ old('capacity') }}" min="1" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Menu (Description)</label>
                    <div class="control">
                        <textarea class="textarea" name="menu" placeholder="Describe the courses or items included">{{ old('menu') }}</textarea>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Image</label>
                    <div class="control">
                        <input class="input" type="file" name="image" accept="image/*">
                    </div>
                    <p class="help">Optional: JPG, PNG, or WEBP up to 2MB.</p>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-success">
                            <span class="icon is-small">
                                <i class="fas fa-save"></i>
                            </span>
                            <span>Save</span>
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
