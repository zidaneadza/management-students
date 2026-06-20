<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa - SIMA</title>
    <style>
        /* Base & CSS Background */
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 0 0 2rem 0; 
            min-height: 100vh; 
            background: linear-gradient(135deg, #f0f7ff 0%, #e0f2fe 50%, #eff6ff 100%);
            background-attachment: fixed;
            color: #1f2937; 
        }
        .container { max-width: 780px; margin: 0 auto; padding: 0 1rem; box-sizing: border-box; }
        
        /* Navbar Styling */
        .navbar { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(229, 231, 235, 0.8); position: sticky; top: 0; z-index: 100; margin-bottom: 2rem; padding: 0.75rem 1.5rem; }
        .navbar-container { max-width: 1280px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; }
        .navbar-brand { display: flex; align-items: center; gap: 0.5rem; font-size: 1.3rem; font-weight: 700; color: #1e3a8a; }
        .navbar-menu-desktop { display: flex; gap: 1.5rem; align-items: center; }
        .nav-link { color: #475569; text-decoration: none; font-weight: 600; font-size: 0.95rem; transition: color 0.2s; }
        .nav-link:hover, .nav-link.active { color: #2563eb; }

        /* Profile Dropdown styling */
        .profile-container { position: relative; display: inline-block; }
        .profile-avatar { width: 40px; height: 40px; background: #4f46e5; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; cursor: pointer; border: 2px solid #e0e7ff; transition: transform 0.2s; font-size: 0.9rem; user-select: none; }
        .profile-avatar:hover { transform: scale(1.05); }
        .profile-dropdown { position: absolute; right: 0; top: 48px; width: 220px; background: white; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; display: none; z-index: 1000; overflow: hidden; }
        .profile-dropdown.show { display: block; }
        .profile-header { padding: 1rem; border-bottom: 1px solid #f1f5f9; }
        .profile-name { font-weight: bold; color: #1e293b; margin: 0 0 0.25rem 0; font-size: 0.95rem; }
        .profile-email { color: #64748b; font-size: 0.8rem; margin: 0; }
        .profile-menu { display: flex; flex-direction: column; }
        .profile-menu-item { padding: 0.75rem 1rem; color: #475569; text-decoration: none; font-size: 0.9rem; transition: background 0.2s; cursor: pointer; border: 0; background: none; text-align: left; font-weight: 600; box-sizing: border-box; }
        .profile-menu-item:hover { background: #f8fafc; color: #1e293b; }
        .profile-menu-item.logout { color: #ef4444; border-top: 1px solid #f1f5f9; }
        .profile-menu-item.logout:hover { background: #fef2f2; color: #dc2626; }

        /* Card Form Styling */
        .card { background: rgba(255,255,255,0.96); padding: 2rem; border-radius: 24px; box-shadow: 0 18px 48px rgba(15, 23, 42, 0.08); border: 1px solid rgba(229, 231, 235, 0.95); }
        h1 { margin-top: 0; margin-bottom: 1.5rem; color: #1e3a8a; font-size: 1.8rem; font-weight: 700; }
        form { display: grid; gap: 1.25rem; }
        .field { display: flex; flex-direction: column; }
        label { font-weight: 600; margin-bottom: 0.5rem; color: #334155; font-size: 0.95rem; }
        input, select { width: 100%; padding: 0.85rem 1rem; border: 1px solid #cbd5e1; border-radius: 12px; box-sizing: border-box; font-size: 0.95rem; background-color: #f8fafc; color: #334155; transition: all 0.2s; outline: none; }
        input:focus, select:focus { border-color: #2563eb; background-color: white; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12); }
        
        .actions { display: flex; gap: 0.9rem; flex-wrap: wrap; margin-top: 1rem; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 0.8rem 1.75rem; font-size: 0.95rem; text-decoration: none; border-radius: 12px; border: 0; cursor: pointer; font-weight: 600; transition: all 0.2s ease; }
        .btn-primary { background: #2563eb; color: white; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2); }
        .btn-primary:hover { background: #1d4ed8; transform: translateY(-1px); }
        .btn-secondary { background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; }
        .btn-secondary:hover { background: #e2e8f0; }
        
        .notice { padding: 1rem; border-radius: 12px; font-size: 0.95rem; border: 1px solid #fca5a5; background: #fef2f2; color: #b91c1c; }

        @media (max-width: 768px) {
            .navbar-menu-desktop { display: none; }
            .brand-subtitle { display: none !important; }
            .card { padding: 1.5rem; }
            .actions { flex-direction: column; }
            .btn { width: 100%; }
        }
    </style>
</head>
<body>
    <!-- Top Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
                <span class="brand-logo">🎓</span>
                <span class="brand-name">SIMA</span>
                <span style="font-size:0.85rem; font-weight:500; color:#64748b; margin-left:0.5rem; display:inline-block;" class="brand-subtitle">Sistem Akademik Terpadu</span>
            </div>
            <!-- Profile Avatar and Dropdown -->
            <div class="profile-container">
                <div class="profile-avatar" id="profileAvatar">AD</div>
                <div class="profile-dropdown" id="profileDropdown">
                    <div class="profile-header">
                        <p class="profile-name">{{ session('username', 'admin') }}</p>
                        <p class="profile-email">admin@sima.id</p>
                    </div>
                    <div class="profile-menu">
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="profile-menu-item logout" style="width: 100%;">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card">
            <h1>Tambah Mahasiswa</h1>

            @if($errors->any())
                <div class="notice">
                    <strong>Periksa kembali data Anda:</strong>
                    <ul style="margin: 0.5rem 0 0 1rem; padding-left: 0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf
                <div class="field">
                    <label for="nim">NIM</label>
                    <input id="nim" name="nim" value="{{ old('nim') }}" placeholder="Masukkan NIM" required>
                </div>
                <div class="field">
                    <label for="nama">Nama Lengkap</label>
                    <input id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Lengkap" required>
                </div>
                <div class="field">
                    <label for="jurusan">Jurusan</label>
                    <input id="jurusan" name="jurusan" value="{{ old('jurusan') }}" placeholder="Masukkan Jurusan" required>
                </div>
                <div class="field">
                    <label for="ipk">IPK</label>
                    <input id="ipk" name="ipk" type="number" step="0.01" min="0" max="4" value="{{ old('ipk') }}" placeholder="Contoh: 3.75" required>
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Masukkan Alamat Email" required>
                </div>
                <div class="field">
                    <label for="no_hp">No. HP</label>
                    <input id="no_hp" name="no_hp" value="{{ old('no_hp') }}" placeholder="Masukkan Nomor HP" required>
                </div>
                <div class="actions">
                    <button class="btn btn-primary" type="submit">Simpan Data</button>
                    <a class="btn btn-secondary" href="{{ route('mahasiswa.index') }}">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Toggle Dropdown Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const avatar = document.getElementById('profileAvatar');
            const dropdown = document.getElementById('profileDropdown');
            
            if (avatar && dropdown) {
                avatar.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdown.classList.toggle('show');
                });
                
                document.addEventListener('click', function(e) {
                    if (!avatar.contains(e.target) && !dropdown.contains(e.target)) {
                        dropdown.classList.remove('show');
                    }
                });
            }
        });
    </script>
</body>
</html>
