<?php $__env->startSection('title', 'Input Pembayaran'); ?>

<?php $__env->startSection('content'); ?>
<!-- Header -->
<div class="mb-10">
    <h1 class="text-2xl font-black text-slate-900">Input Pembayaran</h1>
    <p class="text-sm font-medium text-slate-500">Form input transaksi pembayaran PBB baru</p>
</div>

<div class="max-w-5xl">
    <div class="bg-white rounded-[2.5rem] shadow-premium border border-slate-50 overflow-hidden">
        <form action="<?php echo e(route('payments.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="p-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <!-- Left Column: PBB Info -->
                    <div class="space-y-8">
                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3 ml-1">Cari NOP / Wajib Pajak</label>
                            <div class="relative">
                                <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                <select name="tunggakan_id" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 pl-14 pr-10 text-sm font-bold text-slate-900 appearance-none focus:outline-none focus:ring-2 focus:ring-primary-light transition-all" required>
                                    <option value="">Pilih NOP...</option>
                                    <?php $__currentLoopData = $tunggakans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tunggakan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tunggakan->id); ?>">
                                            <?php echo e($tunggakan->wajibPajak->nop); ?> - <?php echo e($tunggakan->wajibPajak->nama); ?> (<?php echo e($tunggakan->tahun); ?>)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <i class="fas fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none"></i>
                            </div>
                        </div>

                        <div class="p-6 bg-slate-50 rounded-[2rem] border border-slate-100 space-y-4">
                            <div class="flex justify-between items-center pb-3 border-b border-slate-200">
                                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Detail Objek Pajak</span>
                                <i class="fas fa-info-circle text-primary"></i>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase mb-1">Nama WP</p>
                                    <p id="wp-name" class="text-sm font-black text-slate-900">-</p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase mb-1">Tahun</p>
                                    <p id="pbb-year" class="text-sm font-black text-slate-900">-</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-[10px] font-black text-slate-400 uppercase mb-1">Alamat</p>
                                    <p id="pbb-address" class="text-sm font-black text-slate-900 leading-tight">-</p>
                                </div>
                                <div class="col-span-2 pt-2">
                                    <p class="text-[10px] font-black text-slate-400 uppercase mb-1">Ketetapan PBB</p>
                                    <p id="pbb-amount" class="text-xl font-black text-primary">Rp 0</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Payment Info -->
                    <div class="space-y-8">
                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3 ml-1">Jumlah Bayar</label>
                            <div class="relative">
                                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-sm font-black text-slate-400">Rp</span>
                                <input type="number" name="jumlah_bayar" required placeholder="0"
                                    class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 pl-14 pr-6 text-2xl font-black text-primary placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-primary-light transition-all">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3 ml-1">Tanggal Bayar</label>
                                <input type="date" name="tanggal_bayar" value="<?php echo e(date('Y-m-d')); ?>" required
                                    class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-primary-light transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3 ml-1">Kolektor</label>
                                <div class="relative">
                                    <select name="kolektor_id" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold text-slate-700 appearance-none focus:outline-none focus:ring-2 focus:ring-primary-light transition-all" required>
                                        <?php $__currentLoopData = $collectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coll): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($coll->id); ?>"><?php echo e($coll->nama); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none"></i>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3 ml-1">Keterangan</label>
                            <textarea name="keterangan" rows="3" placeholder="Tambahkan catatan jika perlu..."
                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-primary-light transition-all"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-slate-50/50 p-8 border-t border-slate-100 flex justify-end gap-4">
                <a href="<?php echo e(route('payments.index')); ?>" class="px-8 py-3.5 rounded-2xl font-black text-sm text-slate-500 hover:bg-slate-100 transition-all">
                    Batal
                </a>
                <button type="submit" class="px-10 py-3.5 rounded-2xl bg-primary text-white font-black text-sm shadow-xl shadow-primary/20 hover:bg-primary-dark transition-all active:scale-95 flex items-center gap-2">
                    <i class="fas fa-save"></i>
                    Simpan Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    // Simple logic to show detail when selecting tunggakan
    // In a real app, this should probably use AJAX or data attributes
    const tunggakanData = {
        <?php $__currentLoopData = $tunggakans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        "<?php echo e($t->id); ?>": {
            name: "<?php echo e($t->wajibPajak->nama); ?>",
            year: "<?php echo e($t->tahun); ?>",
            address: "<?php echo e($t->wajibPajak->alamat); ?>",
            amount: "Rp <?php echo e(number_format($t->jumlah_tagihan, 0, ',', '.')); ?>",
            rawAmount: "<?php echo e($t->jumlah_tagihan); ?>"
        },
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    };

    $('select[name="tunggakan_id"]').change(function() {
        const id = $(this).val();
        if (id && tunggakanData[id]) {
            const data = tunggakanData[id];
            $('#wp-name').text(data.name);
            $('#pbb-year').text(data.year);
            $('#pbb-address').text(data.address);
            $('#pbb-amount').text(data.amount);
            $('input[name="jumlah_bayar"]').val(data.rawAmount);
        } else {
            $('#wp-name, #pbb-year, #pbb-address').text('-');
            $('#pbb-amount').text('Rp 0');
            $('input[name="jumlah_bayar"]').val('');
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pbb-cikeduk\resources\views/payments/create.blade.php ENDPATH**/ ?>