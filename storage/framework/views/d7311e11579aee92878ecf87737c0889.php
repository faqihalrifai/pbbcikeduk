<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembayaran - PBB Cikeduk</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { primary: '#1e40af', 'primary-light': '#3b82f6' },
                    borderRadius: { '2xl': '1rem', '3xl': '1.5rem' },
                    boxShadow: { 'premium': '0 20px 50px -12px rgba(0, 0, 0, 0.1)' }
                }
            }
        }
    </script>
    <style> body { font-family: 'Inter', sans-serif; background: #f8fafc; } </style>
</head>
<body class="min-h-screen flex flex-col">

    <!-- Navigation -->
    <nav class="bg-white border-b border-slate-100 py-6 sticky top-0 z-50">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <a href="<?php echo e(route('landing')); ?>" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center overflow-hidden border border-slate-100 shadow-sm">
                    <img src="<?php echo e(asset('logo.jpeg')); ?>" class="w-full h-full object-cover" alt="Logo">
                </div>
                <span class="font-black text-slate-900 tracking-tight uppercase text-sm">Beranda</span>
            </a>
            <h1 class="text-lg font-black text-slate-900">RIWAYAT PEMBAYARAN PBB</h1>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-6 py-12">
        <div class="max-w-6xl mx-auto">
            
            <!-- Filter & Search Section -->
            <div class="bg-white rounded-[2.5rem] p-8 shadow-premium border border-slate-50 mb-10">
                <form action="<?php echo e(route('landing.history')); ?>" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                    <div class="md:col-span-1">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Cari Nama/NOP</label>
                        <div class="relative">
                            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"></i>
                            <input type="text" name="search" value="<?php echo e($search); ?>" placeholder="Nama atau NOP..." 
                                class="w-full bg-slate-50 border border-slate-100 rounded-xl py-3 pl-11 pr-4 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-primary/10 transition-all">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Mulai Tanggal</label>
                        <input type="date" name="start_date" value="<?php echo e($startDate); ?>" 
                            class="w-full bg-slate-50 border border-slate-100 rounded-xl py-3 px-4 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-primary/10 transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Sampai Tanggal</label>
                        <input type="date" name="end_date" value="<?php echo e($endDate); ?>" 
                            class="w-full bg-slate-50 border border-slate-100 rounded-xl py-3 px-4 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-primary/10 transition-all">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="flex-1 bg-primary text-white py-3 rounded-xl font-black text-sm shadow-lg shadow-primary/20 hover:bg-primary-dark transition-all">
                            FILTER
                        </button>
                        <a href="<?php echo e(route('landing.history')); ?>" class="bg-slate-100 text-slate-500 p-3 rounded-xl hover:bg-slate-200 transition-all">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                    </div>
                </form>
            </div>

            <!-- History Table -->
            <div class="bg-white rounded-[2.5rem] shadow-premium border border-slate-50 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="py-6 px-8 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal Bayar</th>
                                <th class="py-6 px-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Wajib Pajak</th>
                                <th class="py-6 px-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Alamat</th>
                                <th class="py-6 px-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Jumlah Bayar</th>
                                <th class="py-6 px-8 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php $__empty_1 = true; $__currentLoopData = $pembayaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="group hover:bg-slate-50/50 transition-all duration-300">
                                <td class="py-6 px-8">
                                    <p class="text-sm font-black text-slate-900"><?php echo e(\Carbon\Carbon::parse($pay->tgl_bayar)->format('d/m/Y')); ?></p>
                                </td>
                                <td class="py-6 px-6">
                                    <p class="font-black text-slate-900 text-sm mb-0.5"><?php echo e($pay->nama_wp); ?></p>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider"><?php echo e($pay->nop); ?></p>
                                </td>
                                <td class="py-6 px-6">
                                    <p class="text-xs font-medium text-slate-500 line-clamp-1"><?php echo e($pay->alamat_wajib_pajak); ?></p>
                                </td>
                                <td class="py-6 px-6 text-right">
                                    <span class="text-sm font-black text-slate-900">Rp <?php echo e(number_format($pay->jumlah_bayar, 0, ',', '.')); ?></span>
                                </td>
                                <td class="py-6 px-8 text-center">
                                    <span class="inline-flex items-center gap-1.5 py-1.5 px-4 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-600 uppercase tracking-widest">
                                        LUNAS
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="py-32 text-center">
                                    <i class="fas fa-history text-5xl text-slate-200 mb-6 block"></i>
                                    <p class="text-slate-400 font-bold text-sm">Belum ada riwayat pembayaran yang ditemukan.</p>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if($pembayaran->hasPages()): ?>
                <div class="bg-slate-50/50 px-8 py-6 border-t border-slate-100">
                    <?php echo e($pembayaran->appends(request()->all())->links()); ?>

                </div>
                <?php endif; ?>
            </div>

        </div>
    </main>

    <footer class="bg-white py-12 border-t border-slate-100 mt-20">
        <div class="container mx-auto px-6 text-center text-[10px] font-black text-slate-400 tracking-[0.3em] uppercase">
            &copy; 2024 SISTEM PBB DESA CIKEDUK • RIWAYAT PEMBAYARAN DIGITAL
        </div>
    </footer>

    <style>
        .pagination { display: flex; gap: 0.5rem; justify-content: center; }
        .pagination li { list-style: none; }
        .pagination li a, .pagination li span { padding: 0.5rem 1rem; border-radius: 0.75rem; background: white; border: 1px solid #e2e8f0; font-size: 0.875rem; font-weight: 700; color: #64748b; transition: all 0.3s; }
        .pagination li.active span { background: #1e40af; color: white; border-color: #1e40af; }
        .pagination li a:hover { border-color: #1e40af; color: #1e40af; }
    </style>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\pbb-cikeduk\resources\views/landing/history.blade.php ENDPATH**/ ?>