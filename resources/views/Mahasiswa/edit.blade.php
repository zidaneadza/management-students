<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 2rem; min-height: 100vh; background: url('{{ asset('background.jpg') }}') center/cover no-repeat; background-size: cover; }
        .card { background: rgba(255,255,255,0.95); padding: 1.75rem; border-radius: 24px; box-shadow: 0 18px 48px rgba(15, 23, 42, 0.16); max-width: 720px; margin: 0 auto; border: 1px solid rgba(229, 231, 235, 0.9); }
        label { display: block; margin-top: 0.9rem; font-weight: bold; }
        input { width: 100%; padding: 0.85rem 0.95rem; margin-top: 0.4rem; border: 1px solid #d1d5db; border-radius: 12px; }
        .btn { display: inline-block; margin-top: 1rem; padding: 0.75rem 1.2rem; background: #2563eb; color: white; border: 0; border-radius: 12px; text-decoration: none; min-width: 140px; text-align: center; }
        @media (max-width: 768px) {
            body { padding: 1.25rem; }
            .card { padding: 1.25rem; }
            .btn { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Edit Mahasiswa</h1>
        <form action="{{ route('mahasiswa.update', $mahasiswa->getNim()) }}" method="POST">
            @csrf
            @method('PUT')
            <label>NIM</label>
            <input name="nim" value="{{ old('nim', $mahasiswa->getNim()) }}" required>
            <label>Nama</label>
            <input name="nama" value="{{ old('nama', $mahasiswa->getNama()) }}" required>
            <label>Jurusan</label>
            <input name="jurusan" value="{{ old('jurusan', $mahasiswa->getJurusan()) }}" required>
            <label>IPK</label>
            <input name="ipk" type="number" step="0.01" min="0" max="4" value="{{ old('ipk', $mahasiswa->getIpk()) }}" required>
            <label>Email</label>
            <input name="email" type="email" value="{{ old('email', $mahasiswa->getEmail()) }}" required>
            <label>No. HP</label>
            <input name="no_hp" value="{{ old('no_hp', $mahasiswa->getNoHp()) }}" required>
            <button class="btn" type="submit">Perbarui</button>
            <a class="btn" href="{{ route('mahasiswa.index') }}">Kembali</a>
        </form>
    </div>
</body>
</html>
