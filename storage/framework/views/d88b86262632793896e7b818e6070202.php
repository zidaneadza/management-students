<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 1rem; min-height: 100vh; background: url('<?php echo e(asset('background.jpg')); ?>') center/cover no-repeat; background-color: #eef2ff; color: #1f2937; }
        .container { max-width: 1280px; margin: 0 auto; }
        .card { background: rgba(255,255,255,0.96); padding: 1.5rem; border-radius: 24px; box-shadow: 0 18px 48px rgba(15, 23, 42, 0.16); margin-bottom: 1.5rem; border: 1px solid rgba(229, 231, 235, 0.95); }
        .header-card { background: linear-gradient(90deg, #2563eb, #3b82f6); color: white; }
        .header-card .muted { color: rgba(255,255,255,0.88); }
        .header-actions { display: flex; flex-wrap: wrap; gap: 0.75rem; align-items: center; justify-content: space-between; }
        table { width: 100%; border-collapse: collapse; overflow-x: auto; display: block; }
        th, td { padding: 0.85rem 0.8rem; border-bottom: 1px solid #e5e7eb; text-align: left; white-space: nowrap; }
        thead th { background: #f8fafc; color: #475569; }
        .btn { display: inline-block; padding: 0.75rem 1rem; background: #2563eb; color: white; text-decoration: none; border-radius: 999px; border: 0; cursor: pointer; font-weight: 600; transition: transform 0.2s ease, box-shadow 0.2s ease; box-shadow: 0 6px 14px rgba(37, 99, 235, 0.18); }
        .btn:hover { transform: translateY(-1px); }
        .btn-danger { background: #dc2626; box-shadow: 0 6px 14px rgba(220, 38, 38, 0.18); }
        .muted { color: #64748b; }
        input, select { width: 100%; padding: 0.8rem; border: 1px solid #cbd5e1; border-radius: 12px; box-sizing: border-box; font-size: 1rem; }
        .search-row { display: flex; flex-wrap: wrap; gap: 0.75rem; align-items: center; }
        .search-row input { flex: 1 1 260px; min-width: 180px; }
        .search-row .btn { flex: 0 0 auto; }
        .sort-actions .btn.active { background: #1d4ed8; color: #fff; }
        .notice { padding: 0.95rem 1rem; border-radius: 12px; }
        @media (max-width: 992px) {
            .card { padding: 1.25rem; }
            .header-actions { flex-direction: column; align-items: stretch; }
        }
        @media (max-width: 768px) {
            body { padding: 0.75rem; }
            .btn { width: 100%; text-align: center; }
            table { display: block; overflow-x: auto; }
            th, td { white-space: normal; }
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="card">
        <h1>Manajemen Data Mahasiswa</h1>
        <p class="muted">Aplikasi berbasis Laravel untuk CRUD, pencarian, sorting, validasi, dan penyimpanan file.</p>
        <div class="header-actions">
            <a href="<?php echo e(route('mahasiswa.create')); ?>" class="btn">Tambah Data</a>
            <div class="sort-actions" style="display:flex; flex-wrap:wrap; gap:0.75rem; align-items:center;">
                <label style="font-weight:600; margin:0;">Urutkan:</label>
                <a href="<?php echo e(route('mahasiswa.index', array_merge(request()->query(), ['sort' => 'nim']))); ?>" class="btn <?php echo e($sort === 'nim' ? 'active' : ''); ?>">NIM</a>
                <a href="<?php echo e(route('mahasiswa.index', array_merge(request()->query(), ['sort' => 'nama']))); ?>" class="btn <?php echo e($sort === 'nama' ? 'active' : ''); ?>">Nama</a>
                <a href="<?php echo e(route('mahasiswa.index', array_merge(request()->query(), ['sort' => 'ipk']))); ?>" class="btn <?php echo e($sort === 'ipk' ? 'active' : ''); ?>">IPK</a>
                <a href="<?php echo e(route('mahasiswa.index', array_merge(request()->query(), ['sort' => 'jurusan']))); ?>" class="btn <?php echo e($sort === 'jurusan' ? 'active' : ''); ?>">Jurusan</a>
                <a href="<?php echo e(route('mahasiswa.index', array_merge(request()->query(), ['sort' => 'email']))); ?>" class="btn <?php echo e($sort === 'email' ? 'active' : ''); ?>">Email</a>
            </div>
            <form action="<?php echo e(route('mahasiswa.export')); ?>" method="GET" style="display:inline;">
                <select name="format" style="padding: 0.45rem; border-radius: 8px; min-width: 110px;">
                    <option value="csv">CSV</option>
                    <option value="json">JSON</option>
                    <option value="pdf">PDF</option>
                    <option value="excel">Excel</option>
                </select>
                <button class="btn" type="submit">Export</button>
            </form>
            <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;">
                <?php echo csrf_field(); ?>
                <button class="btn btn-danger" type="submit">Logout</button>
            </form>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="card notice" style="background: #ecfdf3; color: #047857;"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="card notice" style="background: #fef2f2; color: #b91c1c;">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card">
        <h2>Pencarian Data</h2>
        <form method="GET" action="<?php echo e(route('mahasiswa.index')); ?>" style="margin-bottom: 1rem;">
            <div class="search-row">
                <input name="keyword" placeholder="Cari berdasarkan NIM, nama, jurusan, IPK, atau email" value="<?php echo e($keyword); ?>">
                <input type="hidden" name="sort" value="<?php echo e($sort); ?>">
                <button class="btn" type="submit">Cari</button>
            </div>
        </form>

        <?php if($sort): ?>
            <div class="notice" style="background: #eff6ff; color: #1d4ed8; margin-bottom: 1rem;">
                <strong>Urutan aktif:</strong> <?php echo e(strtoupper($sort)); ?>

            </div>
        <?php endif; ?>

        <?php if($keyword !== ''): ?>
            <?php if(count($mahasiswas) > 0): ?>
                <div class="notice" style="background: #ecfdf3; padding: 0.9rem; border-radius: 12px; margin-bottom: 1rem;">
                    <strong>Hasil pencarian:</strong> ditemukan <?php echo e(count($mahasiswas)); ?> data untuk '<?php echo e($keyword); ?>'.
                </div>
            <?php else: ?>
                <div class="notice" style="background: #fef2f2; padding: 0.9rem; border-radius: 12px; margin-bottom: 1rem;">
                    Tidak ada data mahasiswa yang cocok dengan '<?php echo e($keyword); ?>'.
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <h2>Import Data Mahasiswa</h2>
        <form action="<?php echo e(route('mahasiswa.import')); ?>" method="POST" enctype="multipart/form-data" style="margin-bottom: 1rem;">
            <?php echo csrf_field(); ?>
            <div class="search-row">
                <input type="file" name="csv_file" accept=".csv,.txt" required>
                <button class="btn" type="submit">Import CSV</button>
            </div>
        </form>

        <h2>Data Mahasiswa</h2>
        <table>
            <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>IPK</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $mahasiswas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($m->getNim()); ?></td>
                    <td><?php echo e($m->getNama()); ?></td>
                    <td><?php echo e($m->getJurusan()); ?></td>
                    <td><?php echo e($m->getIpk()); ?></td>
                    <td><?php echo e($m->getEmail()); ?></td>
                    <td>
                        <a href="<?php echo e(route('mahasiswa.edit', $m->getNim())); ?>" class="btn">Edit</a>
                        <form action="<?php echo e(route('mahasiswa.destroy', $m->getNim())); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6">Belum ada data mahasiswa.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\zidan\Documents\college\Semester 3\algoritma\project\manajemen-mahasiswa\resources\views/Mahasiswa/index.blade.php ENDPATH**/ ?>