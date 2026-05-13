<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi PBB - Desa Cikeduk</title>
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
            <h1 class="text-lg font-black text-slate-900">INFORMASI PBB DESA</h1>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-6 py-12">
        <div class="max-w-6xl mx-auto">
            
            <!-- Header & Search -->
            <div class="flex flex-col md:flex-row justify-between items-center gap-6 mb-12">
                <div>
                    <h2 class="text-3xl font-black text-slate-900">Data Wajib Pajak</h2>
                    <p class="text-slate-500">Menampilkan data PBB Desa Cikeduk Tahun 2026.</p>
                </div>
                
                <form action="<?php echo e(route('landing.informasi')); ?>" method="GET" class="w-full md:w-96 relative">
                    <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="search" value="<?php echo e($search); ?>" placeholder="Cari Nama atau NOP..." 
                        class="w-full bg-white border border-slate-200 rounded-2xl py-4 pl-14 pr-6 text-sm font-bold text-slate-900 focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all shadow-sm">
                </form>
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-[2.5rem] shadow-premium border border-slate-50 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="py-6 px-8 text-[10px] font-black text-slate-400 uppercase tracking-widest">Wajib Pajak (NOP)</th>
                                <th class="py-6 px-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Alamat</th>
                                <th class="py-6 px-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Ketetapan</th>
                                <th class="py-6 px-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                                <th class="py-6 px-8 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Tgl Bayar</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php $__empty_1 = true; $__currentLoopData = $pbb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="group hover:bg-slate-50/50 transition-all duration-300">
                                <td class="py-6 px-8">
                                    <p class="font-black text-slate-900 text-sm mb-0.5"><?php echo e($item->nama_wp); ?></p>
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider"><?php echo e($item->nop); ?></p>
                                </td>
                                <td class="py-6 px-6">
                                    <p class="text-xs font-medium text-slate-500 line-clamp-2 max-w-[200px]"><?php echo e($item->alamat_wajib_pajak); ?></p>
                                </td>
                                <td class="py-6 px-6 text-right">
                                    <span class="text-sm font-black text-primary">Rp <?php echo e(number_format($item->ketetapan_pbb, 0, ',', '.')); ?></span>
                                </td>
                                <td class="py-6 px-6 text-center">
                                    <?php if($item->status == 'Lunas'): ?>
                                    <span class="inline-flex items-center gap-1.5 py-1.5 px-4 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-600 uppercase tracking-widest">
                                        <i class="fas fa-check-circle text-[8px]"></i> LUNAS
                                    </span>
                                    <?php else: ?>
                                    <span class="inline-flex items-center gap-1.5 py-1.5 px-4 rounded-full text-[10px] font-black bg-rose-100 text-rose-600 uppercase tracking-widest">
                                        <i class="fas fa-clock text-[8px]"></i> BELUM LUNAS
                                    </span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-6 px-8 text-center">
                                    <?php if($item->tgl_bayar): ?>
                                    <p class="text-sm font-bold text-slate-900"><?php echo e(\Carbon\Carbon::parse($item->tgl_bayar)->format('d/m/Y')); ?></p>
                                    <?php else: ?>
                                    <p class="text-xs text-slate-400 font-bold">-</p>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="py-32 text-center">
                                    <div class="w-20 h-20 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-6">
                                        <i class="fas fa-search text-3xl"></i>
                                    </div>
                                    <p class="text-slate-400 font-bold text-sm">Tidak ada data PBB yang ditemukan.</p>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if($pbb->hasPages()): ?>
                <div class="bg-slate-50/50 px-8 py-6 border-t border-slate-100">
                    <?php echo e($pbb->appends(['search' => $search])->links()); ?>

                </div>
                <?php endif; ?>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white py-12 border-t border-slate-100 mt-20">
        <div class="container mx-auto px-6 text-center">
            <p class="text-xs text-slate-400 font-bold uppercase tracking-[0.2em]">&copy; 2024 SISTEM PBB DESA CIKEDUK</p>
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
<?php /**PATH C:\xampp\htdocs\pbb-cikeduk\resources\views/landing/informasi.blade.php ENDPATH**/ ?>