<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Manajemen Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #eef2ff; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; padding: 1rem; }
        .card { background: rgba(255,255,255,0.95); padding: 2rem; border-radius: 24px; box-shadow: 0 20px 50px rgba(15, 23, 42, 0.18); width: min(100%, 440px); max-width: 440px; border: 1px solid rgba(229, 231, 235, 0.9); }
        label { display: block; margin-bottom: 0.35rem; font-weight: 600; }
        input { width: 100%; padding: 0.95rem; margin-bottom: 1rem; border: 1px solid #d1d5db; border-radius: 14px; box-sizing: border-box; font-size: 1rem; }
        button { width: 100%; padding: 1rem; background: #2563eb; color: white; border: none; border-radius: 999px; cursor: pointer; font-weight: 700; box-shadow: 0 10px 24px rgba(37, 99, 235, 0.24); }
        .error { color: #dc2626; margin-bottom: 1rem; }
        .success { color: #047857; margin-bottom: 1rem; }
        .link { display: block; margin-top: 1rem; text-align: center; color: #2563eb; text-decoration: none; }
        @media (max-width: 576px) {
            body { padding: 1rem; }
            .card { padding: 1.5rem; }
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Reset Password</h1>
        @if(session('status'))
            <div class="success">{{ session('status') }}</div>
        @endif
        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('password.reset') }}">
            @csrf
            <label for="username">Username</label>
            <input id="username" name="username" required>

            <label for="new_password">Password Baru</label>
            <input id="new_password" name="new_password" type="password" required>

            <button type="submit">Simpan Password Baru</button>
        </form>
        <a class="link" href="{{ route('login') }}">Kembali ke login</a>
    </div>
</body>
</html>
