<?php $__env->startSection('title', 'Kelola Kolektor'); ?>

<?php $__env->startSection('content'); ?>
<!-- Header & Actions -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-black text-slate-900">Kelola Kolektor</h1>
        <p class="text-sm font-medium text-slate-500">Manajemen petugas penagih PBB di lapangan</p>
    </div>
    
    <div>
        <button data-modal-target="addModal" class="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl font-bold text-sm transition-all shadow-lg shadow-primary/20 active:scale-95">
            <i class="fas fa-plus"></i> Tambah Kolektor
        </button>
    </div>
</div>

<!-- Table Container -->
<div class="bg-white rounded-[2.5rem] shadow-premium border border-slate-50 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="py-5 px-8 text-[10px] font-black text-slate-400 uppercase tracking-widest">No</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">ID Kolektor</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Kolektor</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Wilayah</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">No HP</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                    <th class="py-5 px-8 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php $__empty_1 = true; $__currentLoopData = $collectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $collector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="group hover:bg-slate-50/50 transition-colors">
                    <td class="py-4 px-8 text-xs font-bold text-slate-400"><?php echo e($index + 1); ?></td>
                    <td class="py-4 px-4">
                        <span class="text-xs font-black text-primary px-2.5 py-1 bg-blue-50 rounded-lg">KOL<?php echo e(sprintf('%03d', $collector->id)); ?></span>
                    </td>
                    <td class="py-4 px-4 text-sm font-black text-slate-900"><?php echo e($collector->nama); ?></td>
                    <td class="py-4 px-4 text-xs font-bold text-slate-500 uppercase tracking-wider"><?php echo e($collector->wilayah); ?></td>
                    <td class="py-4 px-4 text-center">
                        <span class="text-xs font-bold text-slate-600"><?php echo e($collector->no_hp); ?></span>
                    </td>
                    <td class="py-4 px-4 text-center">
                        <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-600 uppercase tracking-wider">
                            Aktif
                        </span>
                    </td>
                    <td class="py-4 px-8 text-center">
                        <div class="flex justify-center gap-2">
                            <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-primary hover:bg-primary hover:text-white transition-all">
                                <i class="fas fa-edit text-xs"></i>
                            </button>
                            <form action="<?php echo e(route('collectors.destroy', $collector->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white transition-all">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="py-12 text-center text-slate-400 font-bold text-sm">Data Kolektor tidak ditemukan.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Template (Simplified) -->
<div id="addModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4">
    <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl p-8 animate-fade-in-up">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-black text-slate-900">Tambah Kolektor</h3>
            <button onclick="closeModal('addModal')" class="text-slate-400 hover:text-slate-600"><i class="fas fa-times"></i></button>
        </div>
        <form action="<?php echo e(route('collectors.store')); ?>" method="POST" class="space-y-6">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Nama Kolektor</label>
                <input type="text" name="nama" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-3 px-4 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-primary-light transition-all" required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email Login</label>
                    <input type="email" name="email" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-3 px-4 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-primary-light transition-all" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Password</label>
                    <input type="password" name="password" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-3 px-4 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-primary-light transition-all" required>
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Wilayah Tugas</label>
                <input type="text" name="wilayah" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-3 px-4 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-primary-light transition-all" required>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">No HP</label>
                <input type="text" name="no_hp" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-3 px-4 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-primary-light transition-all" required>
            </div>
            <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-black py-4 rounded-2xl shadow-xl shadow-primary/20 transition-all">
                Simpan Data
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

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pbb-cikeduk\resources\views/collectors/index.blade.php ENDPATH**/ ?>