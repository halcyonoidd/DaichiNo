<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Daichi No</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/frontend/register.css') }}">
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Create Account</h2>
            @if (session('status'))
                <div class="msg" style="background:#e7f6ef;color:#0f5132;">{{ session('status') }}</div>
            @endif
            <form method="POST" action="{{ route('register.post') }}">
                @csrf
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Jane Doe" value="{{ old('name') }}" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required>

                <label for="phone">Phone (optional)</label>
                <input type="text" id="phone" name="phone" placeholder="08xxx" value="{{ old('phone') }}">

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>

                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>

                <button type="submit">Sign Up</button>
                <div class="switch">
                    <span>Already have an account?</span>
                    <a href="{{ route('login') }}">Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
