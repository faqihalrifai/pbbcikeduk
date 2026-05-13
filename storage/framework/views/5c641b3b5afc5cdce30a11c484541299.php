<?php $__env->startSection('title', 'Laporan PBB'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-10">
    <h1 class="text-2xl font-black text-slate-900">Laporan PBB</h1>
    <p class="text-sm font-medium text-slate-500">Seluruh data Pajak Bumi dan Bangunan Desa Cikeduk</p>
</div>

<div class="bg-white p-8 rounded-[2.5rem] shadow-premium border border-slate-50 mb-10">
    <form action="<?php echo e(route('reports.index')); ?>" method="GET" class="flex flex-col md:flex-row gap-4 mb-8">
        <div class="flex-grow relative">
            <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input type="text" name="search" value="<?php echo e($search); ?>" placeholder="Cari NOP atau Nama..." 
                class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 pl-14 pr-6 text-sm font-bold text-slate-900 focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all">
        </div>
        <div class="w-full md:w-48">
            <select name="status" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold text-slate-900 focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all appearance-none">
                <option value="">Semua Status</option>
                <option value="Lunas" <?php echo e($status == 'Lunas' ? 'selected' : ''); ?>>Lunas</option>
                <option value="Belum Lunas" <?php echo e($status == 'Belum Lunas' ? 'selected' : ''); ?>>Belum Lunas</option>
            </select>
        </div>
        <button type="submit" class="bg-primary text-white px-8 py-4 rounded-2xl font-black text-sm shadow-lg shadow-primary/20 hover:bg-primary-dark transition-all">
            FILTER
        </button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-100">
                    <th class="pb-4 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">NOP</th>
                    <th class="pb-4 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Wajib Pajak</th>
                    <th class="pb-4 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Alamat</th>
                    <th class="pb-4 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Ketetapan</th>
                    <th class="pb-4 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $pbbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pbb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="group hover:bg-slate-50 transition-colors">
                    <td class="py-4 px-4 border-b border-slate-50">
                        <span class="text-xs font-bold text-slate-500"><?php echo e($pbb->nop); ?></span>
                    </td>
                    <td class="py-4 px-4 border-b border-slate-50">
                        <span class="text-sm font-black text-slate-900"><?php echo e($pbb->nama_wp); ?></span>
                    </td>
                    <td class="py-4 px-4 border-b border-slate-50">
                        <span class="text-xs font-medium text-slate-500"><?php echo e($pbb->alamat_wajib_pajak); ?></span>
                    </td>
                    <td class="py-4 px-4 border-b border-slate-50 text-right">
                        <span class="text-sm font-black text-primary">Rp <?php echo e(number_format($pbb->ketetapan_pbb, 0, ',', '.')); ?></span>
                    </td>
                    <td class="py-4 px-4 border-b border-slate-50 text-center">
                        <?php if($pbb->status == 'Lunas'): ?>
                        <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-600 uppercase tracking-wider">
                            <i class="fas fa-check-circle text-[8px]"></i> Lunas
                        </span>
                        <?php else: ?>
                        <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-[10px] font-black bg-rose-100 text-rose-600 uppercase tracking-wider">
                            <i class="fas fa-clock text-[8px]"></i> Belum Lunas
                        </span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="py-10 text-center text-slate-400 font-bold text-sm">Tidak ada data ditemukan.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-8">
        <?php echo e($pbbs->appends(request()->all())->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pbb-cikeduk\resources\views/dashboard/report.blade.php ENDPATH**/ ?>