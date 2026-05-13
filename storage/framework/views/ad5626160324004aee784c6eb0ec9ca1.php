<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pelayanan PBB</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af',
                        'primary-light': '#3b82f6',
                        'primary-dark': '#1e3a8a',
                    },
                    boxShadow: {
                        'premium': '0 20px 50px -12px rgba(0, 0, 0, 0.1)',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-login {
            background: radial-gradient(circle at top left, #eff6ff 0%, #dbeafe 100%);
            position: relative;
            overflow: hidden;
        }
        .bg-login::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(59, 130, 246, 0.05);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }
    </style>
</head>
<body class="bg-login h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-[450px] relative z-10">
        <div class="bg-white rounded-[32px] shadow-premium p-10 border border-white">
            <!-- Logo & Title -->
            <div class="text-center mb-10">
                <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-sm overflow-hidden border border-slate-100">
                    <img src="<?php echo e(asset('logo.jpeg')); ?>" class="w-full h-full object-cover" alt="Logo Desa">
                </div>
                <h1 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Sistem Pelayanan</h1>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">PBB</h2>
                <p class="text-slate-500 text-sm mt-2">Silakan masuk untuk melanjutkan</p>
            </div>

            <!-- Error Messages -->
            <?php if($errors->any()): ?>
            <div class="mb-6 p-4 bg-rose-50 border border-rose-100 rounded-2xl">
                <ul class="text-xs text-rose-600 font-semibold space-y-1">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><i class="fas fa-circle-exclamation mr-2"></i><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="<?php echo e(route('login')); ?>" method="POST" class="space-y-6">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Username / Email</label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-5 top-1/2 -translate-y-1/2 text-slate-300"></i>
                        <input type="email" name="email" value="<?php echo e(old('email')); ?>" required
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 pl-14 pr-6 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-light focus:bg-white transition-all"
                            placeholder="nama@email.com">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-5 top-1/2 -translate-y-1/2 text-slate-300"></i>
                        <input type="password" name="password" id="password" required
                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 pl-14 pr-14 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-light focus:bg-white transition-all"
                            placeholder="••••••••">
                        <button type="button" id="togglePassword" class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-300 hover:text-slate-500 transition-colors">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Login Sebagai</label>
                    <div class="relative">
                        <i class="fas fa-user-shield absolute left-5 top-1/2 -translate-y-1/2 text-slate-300"></i>
                        <select class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 pl-14 pr-6 text-slate-900 appearance-none focus:outline-none focus:ring-2 focus:ring-primary-light focus:bg-white transition-all">
                            <option value="admin">Administrator</option>
                            <option value="petugas">Petugas Loket</option>
                            <option value="kolektor">Kolektor Desa</option>
                        </select>
                        <i class="fas fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none"></i>
                    </div>
                </div>

                <div class="flex items-center justify-between px-1">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" name="remember" class="w-5 h-5 rounded-lg border-slate-200 text-primary focus:ring-primary transition-all">
                        <span class="text-sm font-semibold text-slate-500 group-hover:text-slate-700 transition-colors">Ingat saya</span>
                    </label>
                    <a href="#" class="text-sm font-bold text-primary hover:text-primary-dark transition-colors">Lupa Password?</a>
                </div>

                <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-black py-4 rounded-2xl shadow-xl shadow-primary/20 transition-all active:scale-[0.98]">
                    MASUK
                </button>
            </form>

            <div class="mt-10 text-center">
                <p class="text-xs font-bold text-slate-400">&copy; 2024 Sistem Pelayanan PBB. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');
        const icon = togglePassword.querySelector('i');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\pbb-cikeduk\resources\views/auth/login.blade.php ENDPATH**/ ?>