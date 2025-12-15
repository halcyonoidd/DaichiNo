<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Daichi No</title>
    <link rel="stylesheet" href="{{ asset('css/vendors/bulma.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/frontend/profile.css') }}">    <link rel="stylesheet" href="{{ asset('css/frontend/mobile-responsive.css') }}"></head>
<body>
    <nav class="navbar transparent" id="navbar">
        <div class="nav-section left">
            <a href="{{ route('about') }}" class="nav-link light">About</a>
            <a href="{{ route('contact') }}" class="nav-link light">Contact</a>
        </div>
        <div class="nav-center">
            <a href="{{ route('home') }}" class="home-link dark">Daichi No</a>
        </div>
        <div class="nav-section right">
            <a href="{{ route('menu') }}" class="nav-link light">Menu</a>
            <a href="{{ route('reservation') }}" class="nav-link light">Reservation</a>
            <a href="{{ route('cart') }}" class="nav-link light">Cart</a>
        </div>
    </nav>

    <section class="section" style="padding-top:120px; max-width:900px; margin:0 auto;">
        <div class="container">
            <h1 class="title is-3">Profile</h1>
            @if (session('status'))
                <div class="notification is-success">{{ session('status') }}</div>
            @endif
            <form method="POST" action="{{ route('profile.update') }}" class="box">
                @csrf
                <div class="field">
                    <label class="label">Nama</label>
                    <div class="control has-icons-left">
                        <input class="input ml-2" type="text" name="name" value="{{ old('name', $user->name) }}" required>
                        <span class="icon is-small is-left"><i class="fas fa-user"></i></span>
                    </div>
                    @error('name')<p class="help is-danger">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control has-icons-left">
                        <input class="input ml-2" type="email" name="email" value="{{ old('email', $user->email) }}" required>
                        <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                    </div>
                    @error('email')<p class="help is-danger">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="label">Telepon</label>
                    <div class="control has-icons-left">
                        <input class="input ml-2" type="text" name="phone" value="{{ old('phone', $user->phone) }}">
                        <span class="icon is-small is-left"><i class="fas fa-phone"></i></span>
                    </div>
                    @error('phone')<p class="help is-danger">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="label">Password Baru (opsional)</label>
                    <div class="control has-icons-left">
                        <input class="input ml-2" type="password" name="password" placeholder="Biarkan kosong jika tidak diganti">
                        <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
                    </div>
                    @error('password')<p class="help is-danger">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="label">Konfirmasi Password</label>
                    <div class="control has-icons-left">
                        <input class="input ml-2" type="password" name="password_confirmation" placeholder="Ulangi password baru">
                        <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
                    </div>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-primary" type="submit"><i class="fas fa-save mr-2"></i>Simpan</button>
                    </div>
                    <div class="control">
                        <a class="button is-light" href="{{ route('home') }}">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const logoutBtn = document.getElementById('logout-btn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', (e) => {
                e.preventDefault();
                if (confirm('Logout sekarang?')) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    });
    </script>
</body>
</html>
