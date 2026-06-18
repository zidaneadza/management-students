<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; background: #f5f7fb; }
        .card { background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); max-width: 700px; }
        input { width: 100%; padding: 0.6rem; margin-top: 0.3rem; border: 1px solid #d1d5db; border-radius: 8px; }
        .btn { display: inline-block; margin-top: 1rem; padding: 0.6rem 1rem; background: #2563eb; color: white; border: 0; border-radius: 8px; text-decoration: none; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Pencarian Data Mahasiswa</h1>
        <form action="<?php echo e(route('mahasiswa.search')); ?>" method="GET">
            <input name="keyword" placeholder="Masukkan NIM" value="<?php echo e($keyword); ?>">
            <button class="btn" type="submit">Cari</button>
            <a class="btn" href="<?php echo e(route('mahasiswa.index')); ?>">Kembali</a>
        </form>

        <?php if($keyword !== ''): ?>
            <?php if($result): ?>
                <h3>Hasil pencarian</h3>
                <p><strong>NIM:</strong> <?php echo e($result->getNim()); ?></p>
                <p><strong>Nama:</strong> <?php echo e($result->getNama()); ?></p>
                <p><strong>Jurusan:</strong> <?php echo e($result->getJurusan()); ?></p>
            <?php else: ?>
                <p>Tidak ada data mahasiswa dengan NIM tersebut.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
<?php /**PATH C:\Users\zidan\Documents\college\Semester 3\algoritma\project\manajemen-mahasiswa\resources\views/Mahasiswa/search-result.blade.php ENDPATH**/ ?>