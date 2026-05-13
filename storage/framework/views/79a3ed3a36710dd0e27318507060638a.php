<?php $__env->startSection('title', 'Pengaturan Website'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Pengaturan Sistem</div>
            <div class="card-body">
                <form action="<?php echo e(route('settings.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label>Nama Desa / Instansi</label>
                        <input type="text" name="nama_instansi" class="form-control" value="<?php echo e($settings['nama_instansi'] ?? 'Pemerintah Desa Cikeduk'); ?>">
                    </div>
                    <div class="mb-3">
                        <label>Tahun Anggaran Berjalan</label>
                        <input type="number" name="tahun_anggaran" class="form-control" value="<?php echo e($settings['tahun_anggaran'] ?? date('Y')); ?>">
                    </div>
                    <div class="mb-3">
                        <label>Pesan Selamat Datang (Landing Page)</label>
                        <textarea name="pesan_landing" class="form-control"><?php echo e($settings['pesan_landing'] ?? 'Selamat Datang di Sistem Pelayanan PBB Online'); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Kontak Layanan</label>
                        <input type="text" name="kontak_layanan" class="form-control" value="<?php echo e($settings['kontak_layanan'] ?? '0812-3456-7890'); ?>">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pbb-cikeduk\resources\views/settings/index.blade.php ENDPATH**/ ?>