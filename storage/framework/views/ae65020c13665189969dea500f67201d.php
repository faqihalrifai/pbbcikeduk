<?php $__env->startSection('title', 'Riwayat Pembayaran'); ?>

<?php $__env->startSection('content'); ?>
<!-- Header & Actions -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-black text-slate-900">Riwayat Penagihan</h1>
        <p class="text-sm font-medium text-slate-500">Log transaksi pembayaran PBB yang telah diproses</p>
    </div>
    
    <?php if(in_array(auth()->user()->role, ['admin', 'petugas', 'kolektor'])): ?>
    <div>
        <a href="<?php echo e(route('payments.create')); ?>" class="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl font-bold text-sm transition-all shadow-lg shadow-primary/20 active:scale-95">
            <i class="fas fa-plus"></i> Input Pembayaran
        </a>
    </div>
    <?php endif; ?>
</div>

<!-- Filters -->
<div class="bg-white p-6 rounded-[2rem] shadow-premium border border-slate-50 mb-8">
    <form action="<?php echo e(route('payments.index')); ?>" method="GET" class="flex flex-col lg:flex-row gap-4">
        <div class="flex flex-col md:flex-row gap-4 flex-1">
            <div class="flex flex-row gap-2 flex-1">
                <input type="date" name="from" class="w-full bg-slate-50 border border-slate-100 rounded-xl py-2.5 px-4 text-sm font-bold text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary-light transition-all">
                <input type="date" name="to" class="w-full bg-slate-50 border border-slate-100 rounded-xl py-2.5 px-4 text-sm font-bold text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary-light transition-all">
            </div>
            <div class="relative flex-1">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input type="text" name="search" placeholder="Cari NOP atau Nama Wajib Pajak..." 
                    class="w-full bg-slate-50 border border-slate-100 rounded-xl py-2.5 pl-12 pr-4 text-sm font-medium text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary-light transition-all">
            </div>
        </div>
        <button type="submit" class="bg-primary text-white px-8 py-2.5 rounded-xl font-bold text-sm hover:bg-primary-dark transition-all active:scale-95">
            Filter
        </button>
    </form>
</div>

<!-- Table Container -->
<div class="bg-white rounded-[2.5rem] shadow-premium border border-slate-50 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="py-5 px-8 text-[10px] font-black text-slate-400 uppercase tracking-widest">No</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">NOP</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Wajib Pajak</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Jumlah Bayar</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Metode</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                    <th class="py-5 px-8 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="group hover:bg-slate-50/50 transition-colors">
                    <td class="py-4 px-8 text-xs font-bold text-slate-400"><?php echo e($index + 1); ?></td>
                    <td class="py-4 px-4 text-xs font-bold text-slate-600"><?php echo e($pay->tanggal_bayar->format('d/m/Y')); ?></td>
                    <td class="py-4 px-4 text-xs font-black text-primary"><?php echo e($pay->tunggakan->wajibPajak->nop); ?></td>
                    <td class="py-4 px-4">
                        <div class="text-sm font-black text-slate-900"><?php echo e($pay->tunggakan->wajibPajak->nama); ?></div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-tight">Tahun <?php echo e($pay->tunggakan->tahun); ?></div>
                    </td>
                    <td class="py-4 px-4 text-sm font-black text-primary text-right">Rp <?php echo e(number_format($pay->jumlah_bayar, 0, ',', '.')); ?></td>
                    <td class="py-4 px-4 text-center">
                        <span class="text-xs font-bold text-slate-600">Tunai</span>
                    </td>
                    <td class="py-4 px-4 text-center">
                        <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-600 uppercase tracking-wider">
                            Lunas
                        </span>
                    </td>
                    <td class="py-4 px-8 text-center">
                        <a href="<?php echo e(route('payments.print', $pay->id)); ?>" target="_blank" class="inline-flex items-center gap-2 bg-blue-50 text-primary px-4 py-2 rounded-lg font-bold text-[10px] uppercase tracking-wider hover:bg-primary hover:text-white transition-all">
                            <i class="fas fa-print"></i> Cetak
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="py-12 text-center text-slate-400 font-bold text-sm">Belum ada data pembayaran.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pbb-cikeduk\resources\views/payments/index.blade.php ENDPATH**/ ?>