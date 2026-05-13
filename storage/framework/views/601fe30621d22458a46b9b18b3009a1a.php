<?php $__env->startSection('title', 'Kelola Data PBB'); ?>

<?php $__env->startSection('content'); ?>
<!-- Header & Actions -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-black text-slate-900">Kelola Data PBB</h1>
        <p class="text-sm font-medium text-slate-500">Manajemen data objek pajak dan status pembayaran</p>
    </div>
    
    <div class="flex flex-wrap gap-3">
        <?php if(in_array(auth()->user()->role, ['admin', 'petugas'])): ?>
        <button data-modal-target="importModal" class="flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-lg shadow-emerald-500/20 active:scale-95">
            <i class="fas fa-file-excel"></i> Import Excel
        </button>
        <a href="<?php echo e(route('pbbs.export')); ?>" class="flex items-center gap-2 bg-rose-500 hover:bg-rose-600 text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-lg shadow-rose-500/20 active:scale-95">
            <i class="fas fa-file-pdf"></i> Export PDF
        </a>
        <button data-modal-target="addModal" class="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-lg shadow-primary/20 active:scale-95">
            <i class="fas fa-plus"></i> Tambah Data
        </button>
        <?php endif; ?>
    </div>
</div>

<!-- Filters & Search -->
<div class="bg-white p-6 rounded-[2rem] shadow-premium border border-slate-50 mb-8">
    <form action="<?php echo e(route('pbbs.index')); ?>" method="GET" class="flex flex-col lg:flex-row gap-4">
        <div class="flex flex-col md:flex-row gap-4 flex-1">
            <div class="w-full md:w-40">
                <select name="tahun" class="w-full bg-slate-50 border border-slate-100 rounded-xl py-2.5 px-4 text-sm font-bold text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary-light transition-all appearance-none">
                    <option value="2026">2026</option>
                    <option value="2025">2025</option>
                    <option value="2024">2024</option>
                </select>
            </div>
            <div class="w-full md:w-48">
                <select name="status" class="w-full bg-slate-50 border border-slate-100 rounded-xl py-2.5 px-4 text-sm font-bold text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary-light transition-all appearance-none">
                    <option value="">Semua Status</option>
                    <option value="Lunas" <?php echo e(request('status') == 'Lunas' ? 'selected' : ''); ?>>Lunas</option>
                    <option value="Belum Lunas" <?php echo e(request('status') == 'Belum Lunas' ? 'selected' : ''); ?>>Belum Lunas</option>
                </select>
            </div>
            <div class="relative flex-1">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari NOP atau Nama Wajib Pajak..." 
                    class="w-full bg-slate-50 border border-slate-100 rounded-xl py-2.5 pl-12 pr-4 text-sm font-medium text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary-light transition-all">
            </div>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-slate-900 text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-slate-800 transition-all active:scale-95">
                Filter
            </button>
            <?php if(request()->anyFilled(['search', 'status', 'tahun'])): ?>
            <a href="<?php echo e(route('pbbs.index')); ?>" class="bg-slate-100 text-slate-600 px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-slate-200 transition-all active:scale-95">
                Reset
            </a>
            <?php endif; ?>
        </div>
    </form>
</div>

<!-- Table Container -->
<div class="bg-white rounded-[2.5rem] shadow-premium border border-slate-50 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="py-5 px-8 text-[10px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">No Urut</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Blok</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Urut</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">NOP Gabung</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">NOP</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Nama WP</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Nama WP Lainnya</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Ketetapan PBB</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Nama Kolektor</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Luas</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">Alamat WP</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap text-right">Hutang PBB</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Tgl Bayar</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Jumlah Bayar</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Column1</th>
                    <?php if(in_array(auth()->user()->role, ['admin', 'petugas'])): ?>
                    <th class="py-5 px-8 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php $__empty_1 = true; $__currentLoopData = $pbbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $pbb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="group hover:bg-slate-50/50 transition-colors">
                    <td class="py-4 px-8 text-xs font-bold text-slate-400"><?php echo e($pbb->no_urut); ?></td>
                    <td class="py-4 px-4 text-xs font-bold text-slate-600"><?php echo e($pbb->blok); ?></td>
                    <td class="py-4 px-4 text-xs font-bold text-slate-600"><?php echo e($pbb->urut); ?></td>
                    <td class="py-4 px-4 text-xs font-bold text-slate-600"><?php echo e($pbb->nop_gabung); ?></td>
                    <td class="py-4 px-4 text-xs font-black text-primary"><?php echo e($pbb->nop); ?></td>
                    <td class="py-4 px-4 text-sm font-black text-slate-900"><?php echo e($pbb->nama_wp); ?></td>
                    <td class="py-4 px-4 text-sm text-slate-500"><?php echo e($pbb->nama_wp_lainnya ?? '-'); ?></td>
                    <td class="py-4 px-4 text-sm font-bold text-slate-900">Rp <?php echo e(number_format($pbb->ketetapan_pbb, 0, ',', '.')); ?></td>
                    <td class="py-4 px-4 text-sm text-slate-600"><?php echo e($pbb->nama_kolektor ?? '-'); ?></td>
                    <td class="py-4 px-4 text-sm text-slate-600"><?php echo e($pbb->luas); ?></td>
                    <td class="py-4 px-4 text-xs text-slate-500"><?php echo e($pbb->alamat_wajib_pajak); ?></td>
                    <td class="py-4 px-4 text-sm font-bold text-rose-500 text-right">Rp <?php echo e(number_format($pbb->hutang_pbb, 0, ',', '.')); ?></td>
                    <td class="py-4 px-4 text-xs text-center text-slate-500"><?php echo e($pbb->tgl_bayar ?? '-'); ?></td>
                    <td class="py-4 px-4 text-sm font-bold text-emerald-500 text-right">Rp <?php echo e(number_format($pbb->jumlah_bayar, 0, ',', '.')); ?></td>
                    <td class="py-4 px-4 text-center">
                        <?php
                            $status = strtolower(trim($pbb->status));
                            $badgeClass = $status == 'lunas' ? 'bg-emerald-100 text-emerald-600' : 'bg-rose-100 text-rose-600';
                            $icon = $status == 'lunas' ? 'fa-check-circle' : 'fa-clock';
                        ?>
                        <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-[10px] font-black <?php echo e($badgeClass); ?> uppercase tracking-wider">
                            <i class="fas <?php echo e($icon); ?> text-[8px]"></i> <?php echo e($pbb->status); ?>

                        </span>
                    </td>
                    <td class="py-4 px-4 text-xs text-slate-400"><?php echo e($pbb->column1 ?? '-'); ?></td>
                    <?php if(in_array(auth()->user()->role, ['admin', 'petugas'])): ?>
                    <td class="py-4 px-8 text-center">
                        <div class="flex justify-center gap-2">
                            <button onclick="openEditModal(<?php echo e($pbb->id); ?>)" class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-primary hover:bg-primary hover:text-white transition-all">
                                <i class="fas fa-edit text-xs"></i>
                            </button>
                        </div>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="py-12 text-center text-slate-400 font-bold text-sm">Data PBB tidak ditemukan.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="p-8 bg-slate-50/50 border-t border-slate-100 flex justify-between items-center">
        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Menampilkan <?php echo e($pbbs->firstItem() ?? 0); ?> - <?php echo e($pbbs->lastItem() ?? 0); ?> dari <?php echo e($pbbs->total()); ?> data</p>
        <div class="flex gap-2">
            <?php echo e($pbbs->links('pagination::tailwind')); ?>

        </div>
    </div>
</div>

<!-- Modal Templates (Simplified for UI view) -->
<div id="importModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4">
    <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl p-8 animate-fade-in-up">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-black text-slate-900">Import Data Excel</h3>
            <button onclick="closeModal('importModal')" class="text-slate-400 hover:text-slate-600"><i class="fas fa-times"></i></button>
        </div>
        <form action="<?php echo e(route('pbbs.import')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
            <?php echo csrf_field(); ?>
            <div class="p-4 bg-blue-50 border border-blue-100 rounded-2xl">
                <p class="text-xs font-bold text-primary leading-relaxed"><i class="fas fa-info-circle mr-2"></i>Pastikan format file sesuai dengan template DHKP yang telah ditentukan.</p>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Pilih File Excel</label>
                <input type="file" name="file_excel" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-3 px-4 text-sm" required>
            </div>
            <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-black py-4 rounded-2xl shadow-xl shadow-emerald-500/20 transition-all">
                Mulai Import
            </button>
        </form>
    </div>
</div>

<script>
    function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
    function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
    
    document.querySelectorAll('[data-modal-target]').forEach(btn => {
        btn.onclick = () => openModal(btn.dataset.modalTarget);
    });

    window.onclick = (e) => {
        if (e.target.id.includes('Modal')) closeModal(e.target.id);
    }
</script>

<style>
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fade-in-up 0.3s ease-out forwards; }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pbb-cikeduk\resources\views/pbbs/index.blade.php ENDPATH**/ ?>