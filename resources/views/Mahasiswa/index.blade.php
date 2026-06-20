<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data Mahasiswa</title>
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

        .container {
            max-width: 1280px;
            margin: 0 auto;
        }

        /* Navbar Styling */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(229, 231, 235, 0.8);
            position: sticky;
            top: 0;
            z-index: 100;
            margin-bottom: 2rem;
            padding: 0.75rem 1.5rem;
        }

        .navbar-container {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.3rem;
            font-weight: 700;
            color: #1e3a8a;
        }

        .navbar-menu-desktop {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .nav-link {
            color: #475569;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.2s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #2563eb;
        }

        /* Profile Dropdown styling */
        .profile-container {
            position: relative;
            display: inline-block;
        }

        .profile-avatar {
            width: 40px;
            height: 40px;
            background: #4f46e5;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            cursor: pointer;
            border: 2px solid #e0e7ff;
            transition: transform 0.2s;
            font-size: 0.9rem;
            user-select: none;
        }

        .profile-avatar:hover {
            transform: scale(1.05);
        }

        .profile-dropdown {
            position: absolute;
            right: 0;
            top: 48px;
            width: 220px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            display: none;
            z-index: 1000;
            overflow: hidden;
        }

        .profile-dropdown.show {
            display: block;
        }

        .profile-header {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .profile-name {
            font-weight: bold;
            color: #1e293b;
            margin: 0 0 0.25rem 0;
            font-size: 0.95rem;
        }

        .profile-email {
            color: #64748b;
            font-size: 0.8rem;
            margin: 0;
        }

        .profile-menu {
            display: flex;
            flex-direction: column;
        }

        .profile-menu-item {
            padding: 0.75rem 1rem;
            color: #475569;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background 0.2s;
            cursor: pointer;
            border: 0;
            background: none;
            text-align: left;
            font-weight: 600;
            box-sizing: border-box;
        }

        .profile-menu-item:hover {
            background: #f8fafc;
            color: #1e293b;
        }

        .profile-menu-item.logout {
            color: #ef4444;
            border-top: 1px solid #f1f5f9;
        }

        .profile-menu-item.logout:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        /* Dashboard Layout */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 1.5rem;
        }

        .grid-left {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .grid-right {
            min-width: 0;
        }

        .card {
            background: rgba(255, 255, 255, 0.96);
            padding: 1.5rem;
            border-radius: 24px;
            box-shadow: 0 18px 48px rgba(15, 23, 42, 0.08);
            margin-bottom: 1.5rem;
            border: 1px solid rgba(229, 231, 235, 0.95);
        }

        /* Buttons & Forms */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.25rem;
            font-size: 0.95rem;
            text-decoration: none;
            border-radius: 12px;
            border: 0;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-apply {
            background: #1e293b;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(30, 41, 59, 0.2);
            font-weight: 600;
            cursor: pointer;
            border: 0;
            flex: 1;
            justify-content: center;
        }

        .btn-apply:hover {
            background: #0f172a;
            transform: translateY(-1px);
        }

        .btn-reset {
            background: #f1f5f9;
            color: #475569;
            padding: 0.75rem 2rem;
            border-radius: 12px;
            border: 1px solid #cbd5e1;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 1;
        }

        .btn-reset:hover {
            background: #e2e8f0;
        }

        .btn-primary-custom {
            background: #2563eb;
            color: white;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .btn-primary-custom:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .export-form {
            display: inline-block;
        }

        .export-group {
            display: flex;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            overflow: hidden;
            background: white;
        }

        .export-select {
            border: 0;
            padding: 0 0.75rem;
            background: white;
            font-size: 0.95rem;
            outline: none;
            border-right: 1px solid #cbd5e1;
        }

        .btn-export {
            background: #10b981;
            color: white;
            border-radius: 0;
        }

        .btn-export:hover {
            background: #059669;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        .muted {
            color: #64748b;
        }

        /* Filters section */
        .filter-card {
            padding: 1.5rem;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .filter-section {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-label {
            font-size: 0.85rem;
            font-weight: 700;
            color: #475569;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .filter-row {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            font-size: 0.95rem;
            background-color: #f8fafc;
            color: #334155;
            transition: border-color 0.2s;
            outline: none;
            box-sizing: border-box;
        }

        .form-input:focus,
        .form-select:focus {
            border-color: #3b82f6;
            background-color: white;
        }

        .filter-actions-row {
            display: flex;
            gap: 0.75rem;
            justify-content: flex-start;
        }


        /* Table (Desktop) */
        .table-container {
            overflow-x: auto;
        }

        .table-mahasiswa {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .table-mahasiswa th,
        .table-mahasiswa td {
            padding: 1rem 0.8rem;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }

        thead th {
            background: #f8fafc;
            color: #475569;
            font-weight: 600;
        }

        .col-nim {
            width: 15%;
        }

        .col-nama {
            width: 25%;
        }

        .col-jurusan {
            width: 22%;
        }

        .col-ipk {
            width: 10%;
        }

        .col-email {
            width: 20%;
        }

        .col-aksi {
            width: 18%;
            text-align: left;
        }

        /* Mobile Cards (Mobile Only) */
        .mobile-cards {
            display: none;
        }

        /* Media Queries */
        @media (max-width: 992px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 0 0 2rem 0;
            }

            .navbar-menu-desktop {
                display: none;
            }

            .filter-actions-row {
                flex-direction: column;
            }

            .filter-actions-row .btn {
                width: 100%;
                text-align: center;
                justify-content: center;
            }

            /* Hide Desktop Table, Show Mobile Cards */
            .table-container {
                display: none;
            }

            .mobile-cards {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            /* Mobile Card Design matching user mockup */
            .m-card {
                background: white;
                border-radius: 16px;
                padding: 1.25rem;
                border: 1px solid #e2e8f0;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            }

            .m-card-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 0.75rem;
            }

            .m-card-nim {
                font-size: 0.85rem;
                font-weight: bold;
                background: #f1f5f9;
                color: #475569;
                padding: 0.25rem 0.6rem;
                border-radius: 6px;
            }

            .m-card-gender {
                font-size: 0.75rem;
                font-weight: 700;
                padding: 0.25rem 0.6rem;
                border-radius: 8px;
                text-transform: uppercase;
                letter-spacing: 0.05em;
            }

            .gender-laki {
                background: #eff6ff;
                color: #2563eb;
            }

            .gender-perempuan {
                background: #fdf2f8;
                color: #db2777;
            }

            .m-card-nama {
                font-size: 1.15rem;
                font-weight: bold;
                color: #0f172a;
                margin: 0 0 0.75rem 0;
            }

            .m-card-info {
                display: flex;
                flex-direction: column;
                gap: 0.4rem;
                margin-bottom: 1rem;
            }

            .info-item {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                color: #64748b;
                font-size: 0.9rem;
            }

            .info-icon {
                width: 16px;
                height: 16px;
                stroke: #94a3b8;
            }

            .m-card-actions {
                display: flex;
                justify-content: flex-end;
                gap: 0.75rem;
                border-top: 1px solid #f1f5f9;
                padding-top: 0.75rem;
            }

            .btn-m-edit,
            .btn-m-delete {
                display: inline-flex;
                align-items: center;
                gap: 0.35rem;
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
                font-weight: 600;
                border-radius: 8px;
                border: 0;
                cursor: pointer;
                text-decoration: none;
            }

            .btn-m-edit {
                background: #f0f3ff;
                color: #4f46e5;
            }

            .btn-m-edit:hover {
                background: #e0e7ff;
            }

            .btn-m-delete {
                background: #fef2f2;
                color: #ef4444;
            }

            .btn-m-delete:hover {
                background: #fee2e2;
            }
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
                <span
                    style="font-size:0.85rem; font-weight:500; color:#64748b; margin-left:0.5rem; display:inline-block;"
                    class="brand-subtitle">Sistem Akademik Terpadu</span>
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

    @php
        $totalMahasiswa = count($mahasiswas);
        $ipkAvg = $totalMahasiswa > 0 ? number_format(collect($mahasiswas)->avg(fn($m) => $m->getIpk()), 2) : '0.00';
    @endphp

    <div class="container" style="padding: 0 1rem; box-sizing: border-box;">
        <!-- Welcome Card & Stats Summary -->
        <div class="card welcome-card"
            style="background: linear-gradient(135deg, #060c24 0%, #102a43 45%, #2680c2 100%); color: white; margin-bottom: 2rem; border: none; padding: 2rem;">
            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1.5rem;">
                <div>
                    <h1 style="margin:0 0 0.5rem 0; font-size:2rem; font-weight: 700;">Selamat Datang,
                        {{ ucfirst(session('username', 'admin')) }}!</h1>
                    <p style="margin:0; opacity:0.9; font-size: 1rem; max-width: 600px; line-height: 1.5;">Kelola data
                        mahasiswa, lakukan pencarian cepat, ekspor data, dan analisis performa IPK mahasiswa.</p>
                </div>
                <div style="display:flex; gap:1rem; flex-wrap: wrap;">
                    <div
                        style="text-align:center; background:rgba(255,255,255,0.12); padding:0.75rem 1.5rem; border-radius:16px; backdrop-filter:blur(5px); border: 1px solid rgba(255,255,255,0.1); min-width: 120px;">
                        <span style="font-size:1.8rem; font-weight:bold; display:block;">{{ $totalMahasiswa }}</span>
                        <span
                            style="font-size:0.7rem; opacity:0.8; font-weight:700; text-transform:uppercase; letter-spacing: 0.05em;">Total
                            Mahasiswa</span>
                    </div>
                    <div
                        style="text-align:center; background:rgba(255,255,255,0.12); padding:0.75rem 1.5rem; border-radius:16px; backdrop-filter:blur(5px); border: 1px solid rgba(255,255,255,0.1); min-width: 120px;">
                        <span style="font-size:1.8rem; font-weight:bold; display:block;">{{ $ipkAvg }}</span>
                        <span
                            style="font-size:0.7rem; opacity:0.8; font-weight:700; text-transform:uppercase; letter-spacing: 0.05em;">Rata-rata
                            IPK</span>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="card notice" style="background: #ecfdf3; color: #047857; border: 1px solid #d1fae5;">
                {{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="card notice" style="background: #fef2f2; color: #b91c1c; border: 1px solid #fee2e2;">
                <ul style="margin: 0; padding-left: 1.25rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main Dashboard Content Grid -->
        <div class="dashboard-grid">
            <!-- Left Side: Controls & Tools -->
            <div class="grid-left">
                <!-- Search & Sort Panel -->
                <div class="card filter-card">
                    <form method="GET" action="{{ route('mahasiswa.index') }}">
                        <div class="filter-grid">
                            <!-- Search section -->
                            <div class="filter-section">
                                <label class="filter-label">PENCARIAN DATA</label>
                                <div class="filter-row">
                                    <input name="keyword" class="form-input" placeholder="Cari Nama"
                                        value="{{ $keyword }}">
                                    <select name="search_type" class="form-select">
                                        <option value="linear" {{ $search_type === 'linear' ? 'selected' : '' }}>Linear
                                            Search (Nama/Jurusan)</option>
                                        <option value="binary" {{ $search_type === 'binary' ? 'selected' : '' }}>Binary
                                            Search (NIM)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Sorting section -->
                            <div class="filter-section" style="margin-top: 0.5rem;">
                                <label class="filter-label">PENGURUTAN (SORTING)</label>
                                <div class="filter-row">
                                    <select name="sort_field" class="form-select">
                                        <option value="">-- Pilih Kolom --</option>
                                        <option value="nim" {{ $sort_field === 'nim' ? 'selected' : '' }}>NIM
                                        </option>
                                        <option value="nama" {{ $sort_field === 'nama' ? 'selected' : '' }}>Nama
                                            Mahasiswa</option>
                                        <option value="jurusan" {{ $sort_field === 'jurusan' ? 'selected' : '' }}>
                                            Jurusan</option>
                                        <option value="ipk" {{ $sort_field === 'ipk' ? 'selected' : '' }}>IPK
                                        </option>
                                        <option value="email" {{ $sort_field === 'email' ? 'selected' : '' }}>Email
                                        </option>
                                    </select>
                                    <select name="sort_algo" class="form-select" style="margin-top: 0.5rem;">
                                        <option value="bubble" {{ $sort_algo === 'bubble' ? 'selected' : '' }}>Bubble
                                            Sort</option>
                                        <option value="selection" {{ $sort_algo === 'selection' ? 'selected' : '' }}>
                                            Selection Sort</option>
                                        <option value="quick" {{ $sort_algo === 'quick' ? 'selected' : '' }}>Quick
                                            Sort (PHP Usort)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="filter-actions-row" style="margin-top: 1.25rem; display: flex; flex-direction: column; gap: 0.5rem; width: 100%; box-sizing: border-box;">
                            <button type="submit" style="width: 100%; box-sizing: border-box; padding: 0.75rem 1rem; border-radius: 0.5rem; font-weight: 500; font-size: 0.875rem; text-align: center; border: none; cursor: pointer; background-color: #1e3a8a; color: white; display: block;">Terapkan</button>
                            <a href="{{ route('mahasiswa.index') }}" style="width: 100%; box-sizing: border-box; padding: 0.75rem 1rem; border-radius: 0.5rem; font-weight: 500; font-size: 0.875rem; text-align: center; text-decoration: none; cursor: pointer; background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; display: block;">Reset</a>
                        </div>
                    </form>
                </div>

                <!-- Import Card -->
                <div class="card" style="padding: 1.25rem;">
                    <h3 style="margin-top: 0; color: #1e3a8a; font-size: 1.1rem; margin-bottom: 1rem;">Import Data
                        Mahasiswa</h3>
                    <form action="{{ route('mahasiswa.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div style="display:flex; flex-direction: column; gap: 0.75rem;">
                            <input type="file" name="csv_file" accept=".csv,.txt" required class="form-input"
                                style="padding: 0.5rem;">
                            <button class="btn btn-primary-custom" type="submit"
                                style="justify-content: center; width: 100%;">Import CSV</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Side: Data List -->
            <div class="grid-right">
                @if ($keyword !== '')
                    <div class="card" style="padding: 1rem; margin-bottom: 1.5rem;">
                        @if (count($mahasiswas) > 0)
                            <div class="notice"
                                style="background: #ecfdf3; color: #047857; padding: 0.75rem; border-radius: 12px; font-weight: 500;">
                                Ditemukan {{ count($mahasiswas) }} data untuk kata kunci '{{ $keyword }}'.
                            </div>
                        @else
                            <div class="notice"
                                style="background: #fef2f2; color: #b91c1c; padding: 0.75rem; border-radius: 12px; font-weight: 500;">
                                Tidak ada data yang cocok dengan '{{ $keyword }}'.
                            </div>
                        @endif
                    </div>
                @endif

                <div class="card" style="padding: 1.75rem;">
                    <div
                        style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem; margin-bottom:1.5rem;">
                        <h2 style="margin:0; color: #1e3a8a;">Daftar Mahasiswa</h2>
                        <div style="display:flex; gap:0.75rem; align-items:center; flex-wrap:wrap;">
                            <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary-custom"
                                style="padding: 0.6rem 1rem; border-radius: 10px; font-size: 0.9rem;">
                                <svg width="16" height="16" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah
                            </a>
                            <form action="{{ route('mahasiswa.export') }}" method="GET" class="export-form">
                                <div class="export-group" style="border-radius:10px;">
                                    <select name="format" class="export-select"
                                        style="padding:0 0.5rem; font-size:0.85rem;">
                                        <option value="csv">CSV</option>
                                        <option value="json">JSON</option>
                                        <option value="pdf">PDF</option>
                                        <option value="excel">Excel</option>
                                    </select>
                                    <button class="btn btn-export" type="submit"
                                        style="padding:0.6rem 1rem; font-size:0.9rem;">
                                        Export
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Desktop view table -->
                    <div class="table-container">
                        <table class="table-mahasiswa">
                            <thead>
                                <tr>
                                    <th class="col-nim">NIM</th>
                                    <th class="col-nama">Nama</th>
                                    <th class="col-jurusan">Jurusan</th>
                                    <th class="col-ipk">IPK</th>
                                    <th class="col-email">Email</th>
                                    <th class="col-aksi">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mahasiswas as $m)
                                    <tr>
                                        <td class="col-nim">{{ $m->getNim() }}</td>
                                        <td class="col-nama" title="{{ $m->getNama() }}">{{ $m->getNama() }}</td>
                                        <td class="col-jurusan" title="{{ $m->getJurusan() }}">
                                            {{ $m->getJurusan() }}</td>
                                        <td class="col-ipk">{{ $m->getIpk() }}</td>
                                        <td class="col-email" title="{{ $m->getEmail() }}">{{ $m->getEmail() }}</td>
                                        <td class="col-aksi">
                                            <a href="{{ route('mahasiswa.edit', $m->getNim()) }}"
                                                class="btn btn-primary-custom"
                                                style="padding: 0.4rem 0.8rem; border-radius: 8px; font-size: 0.85rem;">Edit</a>
                                            <form action="{{ route('mahasiswa.destroy', $m->getNim()) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit"
                                                    style="padding: 0.4rem 0.8rem; border-radius: 8px; font-size: 0.85rem;">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align: center; color: #64748b; padding: 2rem;">
                                            Belum ada data mahasiswa.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile view list -->
                    <div class="mobile-cards">
                        @forelse($mahasiswas as $m)
                            @php
                                $namaLower = strtolower($m->getNama());
                                $isPerempuan =
                                    str_contains($namaLower, 'ayu') ||
                                    str_contains($namaLower, 'citra') ||
                                    str_contains($namaLower, 'eka') ||
                                    str_contains($namaLower, 'gita') ||
                                    str_contains($namaLower, 'indah') ||
                                    str_contains($namaLower, 'bella') ||
                                    str_contains($namaLower, 'donna') ||
                                    str_contains($namaLower, 'putri') ||
                                    str_contains($namaLower, 'ani') ||
                                    str_contains($namaLower, 'dewi') ||
                                    str_contains($namaLower, 'lestari');
                                $gender = $isPerempuan ? 'PEREMPUAN' : 'LAKI-LAKI';
                                $genderClass = $isPerempuan ? 'gender-perempuan' : 'gender-laki';
                            @endphp
                            <div class="m-card">
                                <div class="m-card-header">
                                    <span class="m-card-nim">{{ $m->getNim() }}</span>
                                    <span class="m-card-gender {{ $genderClass }}">{{ $gender }}</span>
                                </div>
                                <div class="m-card-body">
                                    <h3 class="m-card-nama">{{ $m->getNama() }}</h3>
                                    <div class="m-card-info">
                                        <div class="info-item">
                                            <svg class="info-icon" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 14l9-5-9-5-9 5 9 5zm0 0v6M12 21a9.003 9.003 0 008.361-5.4M12 21a9.003 9.003 0 01-8.361-5.4">
                                                </path>
                                            </svg>
                                            <span>{{ $m->getJurusan() }}</span>
                                        </div>
                                        <div class="info-item">
                                            <svg class="info-icon" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                            <span>IPK: {{ $m->getIpk() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-card-actions">
                                    <a href="{{ route('mahasiswa.edit', $m->getNim()) }}" class="btn-m-edit">
                                        <svg width="14" height="14" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('mahasiswa.destroy', $m->getNim()) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-m-delete" type="submit">
                                            <svg width="14" height="14" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div style="text-align: center; color: #64748b; padding: 2rem;">Belum ada data mahasiswa.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
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
