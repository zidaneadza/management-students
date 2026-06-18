<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Manajemen Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; background: url('{{ asset('background.jpg') }}') center/cover no-repeat; background-color: #eef2ff; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; padding: 1rem; }
        .card { background: rgba(255,255,255,0.95); padding: 2rem; border-radius: 24px; box-shadow: 0 20px 50px rgba(15, 23, 42, 0.18); width: min(100%, 440px); max-width: 440px; border: 1px solid rgba(229, 231, 235, 0.9); }
        .logo-wrapper { display: flex; justify-content: center; margin-bottom: 1.5rem; }
        .logo { width: 104px; height: 104px; border-radius: 9999px; object-fit: cover; border: 2px solid rgba(37, 99, 235, 0.16); background: #ffffff; padding: 0.5rem; box-shadow: 0 16px 40px rgba(15, 23, 42, 0.12); }
        h1 { margin-top: 0; margin-bottom: 0.5rem; font-size: 1.9rem; }
        p { color: #4b5563; margin-bottom: 1.5rem; line-height: 1.65; }
        label { display: block; margin-bottom: 0.35rem; font-weight: 600; }
        input { width: 100%; padding: 0.95rem; margin-bottom: 1rem; border: 1px solid #d1d5db; border-radius: 14px; box-sizing: border-box; font-size: 1rem; }
        button { width: 100%; padding: 1rem; background: #2563eb; color: white; border: none; border-radius: 999px; cursor: pointer; font-weight: 700; box-shadow: 0 10px 24px rgba(37, 99, 235, 0.24); }
        .error { color: #dc2626; margin-bottom: 1rem; }
        .link { display: block; margin-top: 1rem; text-align: center; color: #2563eb; text-decoration: none; }
        @media (max-width: 576px) {
            body { padding: 1rem; }
            .card { padding: 1.5rem; }
            .logo { width: 84px; height: 84px; }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo-wrapper">
            <img src="{{ asset('login-logo.png') }}" alt="Logo UNPAM" class="logo">
        </div>
        <h1>Login</h1>
        <p>Silakan masuk untuk mengakses data mahasiswa.</p>

        @if(session('status'))
            <div class="error" style="color: #047857;">{{ session('status') }}</div>
        @endif

        @if($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="username">Username</label>
            <input id="username" name="username" value="{{ old('username') }}" required>

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>

            <button type="submit">Masuk</button>
        </form>

        <div style="margin-top: 1rem; text-align: center;">
            <a href="{{ route('password.reset') }}">Reset Password</a>
        </div>
    </div>
</body>
</html>
