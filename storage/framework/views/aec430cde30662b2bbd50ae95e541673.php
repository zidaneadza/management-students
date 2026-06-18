<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 1.5rem; min-height: 100vh; background: url('<?php echo e(asset('background.jpg')); ?>') center/cover no-repeat; background-color: #eef2ff; color: #1f2937; }
        .card { background: rgba(255,255,255,0.96); padding: 1.75rem; border-radius: 24px; box-shadow: 0 18px 48px rgba(15, 23, 42, 0.16); width: min(100%, 780px); max-width: 780px; margin: 0 auto; border: 1px solid rgba(229, 231, 235, 0.95); }
        h1 { margin-top: 0; margin-bottom: 1rem; }
        form { display: grid; gap: 1rem; }
        .field { display: flex; flex-direction: column; }
        label { font-weight: 700; margin-bottom: 0.35rem; }
        input, select { width: 100%; padding: 0.95rem 1rem; border: 1px solid #cbd5e1; border-radius: 14px; box-sizing: border-box; font-size: 1rem; }
        .actions { display: flex; gap: 0.9rem; flex-wrap: wrap; margin-top: 0.75rem; justify-content: flex-start; }
        .btn { display: inline-block; padding: 0.9rem 1.3rem; background: #2563eb; color: white; border: 0; border-radius: 999px; text-decoration: none; font-weight: 600; text-align: center; min-width: 140px; box-shadow: 0 6px 14px rgba(37, 99, 235, 0.18); }
        .btn-secondary { background: #6b7280; box-shadow: none; }
        .notice { padding: 0.95rem 1rem; border-radius: 12px; }
        @media (max-width: 768px) {
            body { padding: 1rem; }
            .card { padding: 1.25rem; }
            .actions { flex-direction: column; }
            .btn { width: 100%; min-width: unset; }
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Tambah Mahasiswa</h1>

        <?php if($errors->any()): ?>
            <div class="notice" style="background: #fef2f2; color: #b91c1c; margin-bottom: 1rem; border: 1px solid #fca5a5;">
                <strong>Periksa kembali data Anda:</strong>
                <ul style="margin: 0.75rem 0 0 1rem; padding-left: 1rem;">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('mahasiswa.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="field">
                <label for="nim">NIM</label>
                <input id="nim" name="nim" value="<?php echo e(old('nim')); ?>" required>
            </div>
            <div class="field">
                <label for="nama">Nama</label>
                <input id="nama" name="nama" value="<?php echo e(old('nama')); ?>" required>
            </div>
            <div class="field">
                <label for="jurusan">Jurusan</label>
                <input id="jurusan" name="jurusan" value="<?php echo e(old('jurusan')); ?>" required>
            </div>
            <div class="field">
                <label for="ipk">IPK</label>
                <input id="ipk" name="ipk" type="number" step="0.01" min="0" max="4" value="<?php echo e(old('ipk')); ?>" required>
            </div>
            <div class="field">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="<?php echo e(old('email')); ?>" required>
            </div>
            <div class="field">
                <label for="no_hp">No. HP</label>
                <input id="no_hp" name="no_hp" value="<?php echo e(old('no_hp')); ?>" required>
            </div>
            <div class="actions">
                <button class="btn" type="submit">Simpan</button>
                <a class="btn btn-secondary" href="<?php echo e(route('mahasiswa.index')); ?>">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
<?php /**PATH C:\Users\zidan\Documents\college\Semester 3\algoritma\project\manajemen-mahasiswa\resources\views/Mahasiswa/create.blade.php ENDPATH**/ ?>