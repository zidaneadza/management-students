<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Manajemen Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #eff6ff, #f9fafb); display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; padding: 1rem; }
        .card { background: white; padding: 2rem; border-radius: 20px; box-shadow: 0 16px 40px rgba(15, 23, 42, 0.12); width: 100%; max-width: 440px; border: 1px solid #e5e7eb; }
        label { display: block; margin-bottom: 0.35rem; font-weight: 600; }
        input { width: 100%; padding: 0.8rem; margin-bottom: 1rem; border: 1px solid #d1d5db; border-radius: 10px; box-sizing: border-box; font-size: 1rem; }
        button { width: 100%; padding: 0.9rem; background: #2563eb; color: white; border: none; border-radius: 999px; cursor: pointer; font-weight: 600; box-shadow: 0 8px 16px rgba(37, 99, 235, 0.18); }
        .error { color: #dc2626; margin-bottom: 1rem; }
        .success { color: #047857; margin-bottom: 1rem; }
        .link { display: block; margin-top: 1rem; text-align: center; color: #2563eb; text-decoration: none; }
        @media (max-width: 576px) {
            .card { padding: 1.25rem; }
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Reset Password</h1>
        <?php if(session('status')): ?>
            <div class="success"><?php echo e(session('status')); ?></div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="error"><?php echo e($errors->first()); ?></div>
        <?php endif; ?>
        <form method="POST" action="<?php echo e(route('password.reset')); ?>">
            <?php echo csrf_field(); ?>
            <label for="username">Username</label>
            <input id="username" name="username" required>

            <label for="new_password">Password Baru</label>
            <input id="new_password" name="new_password" type="password" required>

            <button type="submit">Simpan Password Baru</button>
        </form>
        <a class="link" href="<?php echo e(route('login')); ?>">Kembali ke login</a>
    </div>
</body>
</html>
<?php /**PATH C:\Users\zidan\Documents\college\Semester 3\algoritma\project\manajemen-mahasiswa\resources\views/auth/reset-password.blade.php ENDPATH**/ ?>