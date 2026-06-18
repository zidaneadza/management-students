<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 2rem; min-height: 100vh; background: url('{{ asset('background.jpg') }}') center/cover no-repeat; background-size: cover; }
        .card { background: rgba(255,255,255,0.95); padding: 1.75rem; border-radius: 24px; box-shadow: 0 18px 48px rgba(15, 23, 42, 0.16); max-width: 720px; margin: 0 auto; border: 1px solid rgba(229, 231, 235, 0.9); }
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
        <h1>Pencarian Data Mahasiswa</h1>
        <form action="{{ route('mahasiswa.search') }}" method="GET">
            <input name="keyword" placeholder="Masukkan NIM" value="{{ $keyword }}">
            <button class="btn" type="submit">Cari</button>
            <a class="btn" href="{{ route('mahasiswa.index') }}">Kembali</a>
        </form>

        @if($keyword !== '')
            @if($result)
                <h3>Hasil pencarian</h3>
                <p><strong>NIM:</strong> {{ $result->getNim() }}</p>
                <p><strong>Nama:</strong> {{ $result->getNama() }}</p>
                <p><strong>Jurusan:</strong> {{ $result->getJurusan() }}</p>
            @else
                <p>Tidak ada data mahasiswa dengan NIM tersebut.</p>
            @endif
        @endif
    </div>
</body>
</html>
