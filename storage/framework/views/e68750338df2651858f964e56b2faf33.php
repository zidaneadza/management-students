<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMA</title>
    <style>
        /* Base & CSS Background */
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 1.5rem; 
            min-height: 100vh; 
            background: linear-gradient(135deg, #f0f7ff 0%, #e0f2fe 50%, #eff6ff 100%);
            display: flex; 
            align-items: center; 
            justify-content: center; 
            box-sizing: border-box;
            color: #1f2937;
        }
        .card { 
            background: rgba(255, 255, 255, 0.96); 
            padding: 2.5rem 2rem; 
            border-radius: 24px; 
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.08); 
            width: min(100%, 440px); 
            max-width: 440px; 
            border: 1px solid rgba(229, 231, 235, 0.95); 
            box-sizing: border-box;
        }
        .logo-wrapper { 
            display: flex; 
            flex-direction: column;
            align-items: center; 
            margin-bottom: 2rem; 
            text-align: center;
        }
        .logo-icon {
            font-size: 3rem;
            margin-bottom: 0.5rem;
        }
        .brand-name {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1e3a8a;
            margin: 0;
        }
        .brand-subtitle {
            font-size: 0.85rem;
            font-weight: 600;
            color: #64748b;
            margin-top: 0.25rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        h1 { margin-top: 0; margin-bottom: 0.5rem; font-size: 1.5rem; color: #1e293b; text-align: center; font-weight: 700; }
        p.desc { color: #64748b; margin-bottom: 1.75rem; text-align: center; font-size: 0.95rem; line-height: 1.5; }
        label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #334155; font-size: 0.9rem; }
        input { width: 100%; padding: 0.85rem 1rem; margin-bottom: 1.25rem; border: 1px solid #cbd5e1; border-radius: 12px; box-sizing: border-box; font-size: 0.95rem; background-color: #f8fafc; color: #334155; transition: all 0.2s; outline: none; }
        input:focus { border-color: #2563eb; background-color: white; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12); }
        button { width: 100%; padding: 0.95rem; background: #2563eb; color: white; border: none; border-radius: 12px; cursor: pointer; font-weight: 700; font-size: 1rem; transition: all 0.2s; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2); }
        button:hover { background: #1d4ed8; transform: translateY(-1px); }
        .error { padding: 0.85rem; border-radius: 10px; border: 1px solid #fca5a5; background: #fef2f2; color: #b91c1c; font-size: 0.9rem; margin-bottom: 1.25rem; }
        .link { display: block; margin-top: 1.25rem; text-align: center; color: #2563eb; text-decoration: none; font-weight: 600; font-size: 0.9rem; }
        .link:hover { text-decoration: underline; }
        @media (max-width: 480px) {
            body { padding: 1rem; }
            .card { padding: 2rem 1.5rem; }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo-wrapper">
            <span class="logo-icon">🎓</span>
            <h2 class="brand-name">SIMA</h2>
            <span class="brand-subtitle">Sistem Akademik Terpadu</span>
        </div>
        
        <?php if(session('status')): ?>
            <div class="error" style="color: #047857; background: #ecfdf3; border-color: #a7f3d0; margin-top: 1rem;">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="error" style="margin-top: 1rem;">
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>" style="margin-top: 1rem;">
            <?php echo csrf_field(); ?>
            <label for="username">Username</label>
            <input id="username" name="username" value="<?php echo e(old('username')); ?>" placeholder="Masukkan username" required autofocus>

            <label for="password">Password</label>
            <div style="position: relative; margin-bottom: 1.25rem;">
                <input id="password" type="password" name="password" placeholder="Masukkan password" required style="padding-right: 3rem; margin-bottom: 0;">
                <button type="button" id="togglePassword" style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); background: none; border: none; padding: 0.25rem; color: #64748b; cursor: pointer; box-shadow: none; width: auto; display: flex; align-items: center; justify-content: center; height: auto;">
                    <!-- Eye Icon (Open) -->
                    <svg id="eyeIconOpen" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <!-- Eye Icon (Close) -->
                    <svg id="eyeIconClose" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path>
                    </svg>
                </button>
            </div>

            <button type="submit">Masuk</button>
        </form>

        <div style="margin-top: 1.25rem; text-align: center;">
            <a href="<?php echo e(route('password.reset')); ?>" class="link">Reset Password</a>
        </div>
    </div>

    <!-- Toggle Password Visibility Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eyeIconOpen');
            const eyeClose = document.getElementById('eyeIconClose');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    if (type === 'password') {
                        eyeOpen.style.display = 'block';
                        eyeClose.style.display = 'none';
                    } else {
                        eyeOpen.style.display = 'none';
                        eyeClose.style.display = 'block';
                    }
                });
            }
        });
    </script>
</body>
</html>
<?php /**PATH D:\Herd\management-students\resources\views/auth/login.blade.php ENDPATH**/ ?>