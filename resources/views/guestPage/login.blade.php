<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Daichi No</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/frontend/register.css') }}">
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Welcome Back</h2>
            @if (session('status'))
                <div class="msg" style="background:#e7f6ef;color:#0f5132;">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="msg error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>

                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
                    <label for="remember" style="margin: 0; display: flex; align-items: center; gap: 8px;">
                        <input type="checkbox" id="remember" name="remember" style="width: auto; margin: 0;">
                        <span style="font-size: 14px; color: #333;">Remember me</span>
                    </label>
                    <a href="#" style="font-size: 14px; color: #d14920; font-weight: bold;">Forgot password?</a>
                </div>

                <button type="submit">Login</button>
                <div class="switch">
                    <span>New here?</span>
                    <a href="{{ route('register') }}">Create an account</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
