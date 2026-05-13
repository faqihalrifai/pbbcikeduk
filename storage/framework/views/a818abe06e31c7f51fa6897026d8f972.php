<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pelayanan PBB - Desa Cikeduk</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Tailwind CSS CDN (v4 style variables used) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af',
                        'primary-light': '#3b82f6',
                        'primary-dark': '#1e3a8a',
                        background: '#f8fafc',
                    },
                    borderRadius: {
                        '2xl': '1rem',
                        '3xl': '1.5rem',
                    },
                    boxShadow: {
                        'premium': '0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05)',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-gradient {
            background: radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 1) 0%, rgba(240, 249, 255, 1) 90%);
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-background text-slate-700 antialiased">

    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-nav border-b border-slate-100">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center overflow-hidden shadow-lg border border-slate-100">
                    <img src="<?php echo e(asset('logo.jpeg')); ?>" class="w-full h-full object-cover" alt="Logo Desa">
                </div>
                <div>
                    <h1 class="text-sm font-extrabold text-slate-900 leading-tight">SISTEM PELAYANAN</h1>
                    <p class="text-[10px] font-semibold text-primary tracking-widest uppercase">Pajak Bumi dan Bangunan (PBB)</p>
                </div>
            </div>
            
            <div class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600">
                <a href="#" class="text-primary border-b-2 border-primary pb-1">Beranda</a>
                <a href="<?php echo e(route('landing.informasi')); ?>" class="hover:text-primary transition-colors">Informasi PBB</a>
                <a href="<?php echo e(route('landing.balik_nama')); ?>" class="hover:text-primary transition-colors">Balik Nama</a>
                <a href="#cek-tagihan" class="hover:text-primary transition-colors">Cek Tagihan</a>
                <a href="#tentang" class="hover:text-primary transition-colors">Tentang</a>
                <a href="<?php echo e(route('login')); ?>" class="bg-primary text-white px-6 py-2.5 rounded-xl hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">Login</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 hero-gradient overflow-hidden">
        <div class="container mx-auto px-6 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-12 md:mb-0">
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-6 leading-tight">
                    Sistem Pelayanan <br>
                    <span class="text-primary">Pajak Bumi dan Bangunan</span>
                </h2>
                <p class="text-lg text-slate-600 mb-8 max-w-lg leading-relaxed">
                    Melayani pembayaran dan pengelolaan data PBB secara cepat, aman, dan transparan. Mudahkan kewajiban pajak Anda bersama kami.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="<?php echo e(route('login')); ?>" class="bg-slate-900 text-white px-8 py-3.5 rounded-xl font-bold shadow-xl hover:bg-slate-800 transition-all active:scale-95">Login Admin</a>
                    <a href="<?php echo e(route('kolektor.dashboard')); ?>" class="bg-white text-slate-900 border border-slate-200 px-8 py-3.5 rounded-xl font-bold shadow-lg hover:bg-slate-50 transition-all active:scale-95">Login Kolektor</a>
                    <a href="#cek-tagihan" class="bg-primary-light text-white px-8 py-3.5 rounded-xl font-bold shadow-xl shadow-primary-light/30 hover:bg-primary transition-all active:scale-95">Cek Tagihan</a>
                </div>
            </div>
            <div class="md:w-1/2 relative">
                <div class="relative z-10 animate-float">
                    <!-- Placeholder for house illustration -->
                    <div class="w-full h-80 bg-gradient-to-br from-blue-100 to-blue-50 rounded-3xl flex items-center justify-center border border-white shadow-2xl overflow-hidden">
                        <i class="fas fa-home text-[120px] text-primary/20"></i>
                        <img src="<?php echo e(asset('rumah.jpeg')); ?>" alt="House Illustration" class="absolute inset-0 w-full h-full object-cover mix-blend-multiply opacity-80">
                    </div>
                </div>
                <!-- Decorative Elements -->
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-400/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-10 -left-10 w-60 h-60 bg-primary/10 rounded-full blur-3xl"></div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="container mx-auto px-6 -mt-10 relative z-20">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-premium border border-slate-50 flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-primary">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Wajib Pajak</p>
                    <h3 class="text-2xl font-black text-slate-900"><?php echo e(number_format($stats['total_wp'], 0, ',', '.')); ?></h3>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-premium border border-slate-50 flex items-center gap-4">
                <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-emerald-600">
                    <i class="fas fa-wallet text-xl"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">PBB Dibayar</p>
                    <h3 class="text-2xl font-black text-slate-900">Rp <?php echo e(number_format($stats['total_bayar'] / 1000000, 1, ',', '.')); ?>M</h3>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-premium border border-slate-50 flex items-center gap-4">
                <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-rose-600">
                    <i class="fas fa-chart-line text-xl"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tunggakan</p>
                    <h3 class="text-2xl font-black text-slate-900">Rp <?php echo e(number_format($stats['total_tunggakan'] / 1000000, 1, ',', '.')); ?>M</h3>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-premium border border-slate-50 flex items-center gap-4">
                <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600">
                    <i class="fas fa-user-tie text-xl"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kolektor</p>
                    <h3 class="text-2xl font-black text-slate-900"><?php echo e($stats['total_kolektor']); ?></h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Informasi PBB (Latest Payments) Section -->
    <section id="informasi" class="py-24 bg-white overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-black text-slate-900 mb-4">Informasi Pembayaran Terkini</h2>
                    <p class="text-slate-500 max-w-lg">Daftar wajib pajak yang telah melakukan pelunasan PBB baru-baru ini.</p>
                </div>
                <div class="hidden md:block">
                    <span class="text-xs font-black text-primary uppercase tracking-[0.2em] bg-blue-50 px-4 py-2 rounded-lg">Update Real-time</span>
                </div>
            </div>

            <div class="bg-slate-50/50 rounded-[2.5rem] p-8 border border-slate-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-slate-200/50">
                                <th class="py-4 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Wajib Pajak</th>
                                <th class="py-4 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Wilayah</th>
                                <th class="py-4 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Status</th>
                                <th class="py-4 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php $__empty_1 = true; $__currentLoopData = $pembayaranTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="group hover:bg-white transition-all duration-300">
                                <td class="py-5 px-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-primary shadow-sm group-hover:bg-primary group-hover:text-white transition-colors">
                                            <i class="fas fa-user text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-slate-900"><?php echo e($pay->tunggakan->wajibPajak->nama); ?></p>
                                            <p class="text-[10px] font-bold text-slate-400 uppercase"><?php echo e($pay->tunggakan->wajibPajak->nop); ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-5 px-4 text-center">
                                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider"><?php echo e($pay->tunggakan->wajibPajak->alamat); ?></span>
                                </td>
                                <td class="py-5 px-4 text-right">
                                    <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-600 uppercase tracking-wider">
                                        Lunas
                                    </span>
                                </td>
                                <td class="py-5 px-4 text-center">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest"><?php echo e($pay->created_at->diffForHumans()); ?></span>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="py-20 text-center text-slate-400 font-bold text-sm italic">Belum ada data pembayaran terbaru.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-24 container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-black text-slate-900 mb-4">Layanan Kami</h2>
            <div class="w-20 h-1.5 bg-primary mx-auto rounded-full"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <a href="<?php echo e(route('landing.payment')); ?>" class="group bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 text-left">
                <div class="w-16 h-16 bg-blue-50 text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
                    <i class="fas fa-money-bill-transfer text-2xl"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-3">Pembayaran PBB</h4>
                <p class="text-slate-500 text-sm leading-relaxed">Lakukan pembayaran PBB secara online melalui berbagai metode.</p>
            </a>
            <a href="<?php echo e(route('landing.sppt')); ?>" class="group bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 text-left">
                <div class="w-16 h-16 bg-blue-50 text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
                    <i class="fas fa-print text-2xl"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-3">Cetak SPPT</h4>
                <p class="text-slate-500 text-sm leading-relaxed">Cetak SPPT dengan mudah hanya dengan nomor NOP.</p>
            </a>
            <a href="<?php echo e(route('landing.history')); ?>" class="group bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 text-left">
                <div class="w-16 h-16 bg-blue-50 text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
                    <i class="fas fa-history text-2xl"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-3">Riwayat Pembayaran</h4>
                <p class="text-slate-500 text-sm leading-relaxed">Lihat riwayat pembayaran pajak Anda secara lengkap.</p>
            </a>
            <a href="<?php echo e(route('landing.complaint')); ?>" class="group bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 text-left">
                <div class="w-16 h-16 bg-blue-50 text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
                    <i class="fas fa-comment-dots text-2xl"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-3">Pengaduan</h4>
                <p class="text-slate-500 text-sm leading-relaxed">Sampaikan keluhan dan saran terkait pelayanan kami.</p>
            </a>
            <a href="<?php echo e(route('landing.balik_nama')); ?>" class="group bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 text-left">
                <div class="w-16 h-16 bg-blue-50 text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
                    <i class="fas fa-id-card-clip text-2xl"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-3">Balik Nama PBB</h4>
                <p class="text-slate-500 text-sm leading-relaxed">Lakukan pengajuan balik nama sertifikat PBB secara online.</p>
            </a>
        </div>
    </section>

    <!-- Search Section -->
    <section id="cek-tagihan" class="py-24 bg-slate-900 text-white overflow-hidden relative">
        <div class="absolute top-0 right-0 w-1/3 h-full bg-primary/10 skew-x-12 translate-x-1/2"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-black mb-4">Cek Tagihan PBB</h2>
                    <p class="text-slate-400">Masukkan Nomor Objek Pajak (NOP) Anda untuk melihat tagihan</p>
                </div>
                
                <div class="bg-white/5 backdrop-blur-xl p-8 rounded-3xl border border-white/10 shadow-2xl">
                    <form action="<?php echo e(route('landing.cek')); ?>" method="POST" class="flex flex-col md:flex-row gap-4">
                        <?php echo csrf_field(); ?>
                        <div class="flex-1 relative">
                            <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input type="text" name="nop" placeholder="Contoh: 32.01.010.001.001.0001" required 
                                class="w-full bg-white/10 border border-white/20 rounded-2xl py-4 pl-14 pr-6 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-light transition-all">
                        </div>
                        <button type="submit" class="bg-primary-light hover:bg-primary text-white font-bold py-4 px-10 rounded-2xl shadow-xl shadow-primary-light/20 transition-all active:scale-95">
                            Cari Tagihan
                        </button>
                    </form>
                </div>

                <?php if(isset($pbb)): ?>
                <div class="mt-8 bg-white text-slate-900 rounded-3xl p-8 shadow-2xl animate-fade-in-up">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b border-slate-100 pb-6 mb-6">
                        <div>
                            <h3 class="text-2xl font-black">Hasil Pencarian</h3>
                            <p class="text-slate-500">NOP: <?php echo e($pbb->nop); ?></p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <?php if($pbb->status == 'Lunas'): ?>
                                <span class="bg-emerald-100 text-emerald-700 px-6 py-2 rounded-full font-bold text-sm uppercase">Lunas</span>
                            <?php else: ?>
                                <span class="bg-rose-100 text-rose-700 px-6 py-2 rounded-full font-bold text-sm uppercase">Belum Lunas</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase mb-1">Nama Wajib Pajak</p>
                            <p class="text-lg font-bold"><?php echo e($pbb->nama_wajib_pajak); ?></p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase mb-1">Tahun Pajak</p>
                            <p class="text-lg font-bold"><?php echo e($pbb->tahun); ?></p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-xs font-bold text-slate-400 uppercase mb-1">Alamat Objek Pajak</p>
                            <p class="text-lg font-bold"><?php echo e($pbb->alamat); ?></p>
                        </div>
                        <div class="md:col-span-2 bg-slate-50 p-6 rounded-2xl flex justify-between items-center">
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase mb-1">Total Tagihan</p>
                                <p class="text-3xl font-black text-primary">Rp <?php echo e(number_format($pbb->jumlah_tagihan, 0, ',', '.')); ?></p>
                            </div>
                            <?php if($pbb->status != 'Lunas'): ?>
                            <button class="bg-primary text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:bg-primary-dark transition-all">
                                Bayar Sekarang
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Tentang PBB Cikeduk Section -->
    <section id="tentang" class="py-24 container mx-auto px-6 border-t border-slate-100">
        <div class="flex flex-col md:flex-row items-center gap-16">
            <div class="md:w-1/2">
                <div class="relative">
                    <div class="w-full h-[400px] bg-slate-100 rounded-[3rem] overflow-hidden shadow-2xl relative z-10">
                        <img src="<?php echo e(asset('rumah.jpeg')); ?>" alt="Kantor Desa Cikeduk" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-primary rounded-3xl flex items-center justify-center text-white text-4xl shadow-2xl z-20 animate-bounce">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                </div>
            </div>
            <div class="md:w-1/2">
                <h4 class="text-primary font-black uppercase tracking-[0.3em] text-xs mb-4">Tentang Kami</h4>
                <h2 class="text-4xl font-black text-slate-900 mb-8 leading-tight">Mengenal Sistem <br> <span class="text-primary">PBB Desa Cikeduk</span></h2>
                <div class="space-y-6 text-slate-600 leading-relaxed">
                    <p>
                        <strong>PBB Cikeduk</strong> adalah platform inovatif yang dirancang khusus untuk mempermudah masyarakat Desa Cikeduk dalam mengelola kewajiban Pajak Bumi dan Bangunan (PBB) mereka. Kami berkomitmen untuk memberikan transparansi total dalam setiap transaksi pajak.
                    </p>
                    <p>
                        Melalui sistem ini, setiap warga dapat melakukan pengecekan tagihan secara mandiri, melihat riwayat pembayaran secara real-time, dan mempermudah kerja kolektor desa dalam melakukan penagihan di lapangan.
                    </p>
                    <div class="grid grid-cols-2 gap-6 pt-4">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-primary text-xl"></i>
                            <span class="text-sm font-bold text-slate-900">Transparansi Data</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-primary text-xl"></i>
                            <span class="text-sm font-bold text-slate-900">Keamanan Terjamin</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-primary text-xl"></i>
                            <span class="text-sm font-bold text-slate-900">Akses 24/7</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-primary text-xl"></i>
                            <span class="text-sm font-bold text-slate-900">Layanan Cepat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative bg-slate-900 text-white pt-24 pb-12 overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-black/70 backdrop-blur-[2px] z-10"></div>
            <!-- Ganti URL gambar di bawah ini dengan foto kelompok Anda -->
            <img src="<?php echo e(asset('kelompok.jpeg')); ?>" 
                class="w-full h-full object-cover" alt="Foto Kelompok GASS">
        </div>

        <div class="container mx-auto px-6 relative z-20">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-16 mb-20 border-b border-white/10 pb-16">
                <!-- Brand & Description -->
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center overflow-hidden shadow-xl border border-white/10">
                            <img src="<?php echo e(asset('logo.jpeg')); ?>" class="w-full h-full object-cover" alt="Logo Desa">
                        </div>
                        <h1 class="text-2xl font-black tracking-tight">SISTEM PBB <span class="text-primary-light">CIKEDUK</span></h1>
                    </div>
                    <p class="text-slate-300 max-w-md leading-relaxed text-sm mb-8 italic">
                        "Melayani dengan transparansi, membangun dengan digitalisasi. Solusi cerdas untuk tata kelola pajak desa yang mandiri dan akuntabel."
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center text-white hover:bg-primary transition-all"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center text-white hover:bg-primary transition-all"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center text-white hover:bg-primary transition-all"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="font-black text-xs uppercase tracking-[0.3em] mb-8 text-primary-light">Hubungi Kami</h4>
                    <ul class="space-y-6 text-sm">
                        <li class="flex items-start gap-4">
                            <div class="w-8 h-8 bg-white/5 rounded-lg flex items-center justify-center text-primary-light flex-shrink-0">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <span class="text-slate-200 font-medium">Jl. Nursefi, Desa Cikeduk, Kab. Cirebon, Kode Pos 45155</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <div class="w-8 h-8 bg-white/5 rounded-lg flex items-center justify-center text-primary-light flex-shrink-0">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <span class="text-slate-200 font-medium">08987756212</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <div class="w-8 h-8 bg-white/5 rounded-lg flex items-center justify-center text-primary-light flex-shrink-0">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <span class="text-slate-200 font-medium">info@pbb-cikeduk.id</span>
                        </li>
                    </ul>
                </div>

                <!-- Quick Menu -->
                <div>
                    <h4 class="font-black text-xs uppercase tracking-[0.3em] mb-8 text-primary-light">Navigasi</h4>
                    <ul class="space-y-4 text-sm font-bold">
                        <li><a href="<?php echo e(route('landing.informasi')); ?>" class="text-slate-300 hover:text-white transition-colors">Informasi PBB</a></li>
                        <li><a href="#cek-tagihan" class="text-slate-300 hover:text-white transition-colors">Cek Tagihan</a></li>
                        <li><a href="<?php echo e(route('landing.payment')); ?>" class="text-slate-300 hover:text-white transition-colors">Pembayaran</a></li>
                        <li><a href="<?php echo e(route('landing.complaint')); ?>" class="text-slate-300 hover:text-white transition-colors">Pengaduan</a></li>
                        <li><a href="<?php echo e(route('landing.balik_nama')); ?>" class="text-slate-300 hover:text-white transition-colors">Balik Nama PBB</a></li>
                    </ul>
                </div>
            </div>

            <!-- Developer Section -->
            <div class="bg-white/5 backdrop-blur-md rounded-[2.5rem] p-10 border border-white/10 mb-16 shadow-2xl">
                <div class="flex flex-col md:flex-row items-center justify-between gap-10">
                    <div class="text-center md:text-left">
                        <div class="flex items-center gap-3 justify-center md:justify-start mb-2">
                            <i class="fas fa-code text-primary-light"></i>
                            <h4 class="text-xl font-black tracking-tight">Dikembangkan oleh <span class="text-primary-light underline decoration-2 underline-offset-4">Kelompok GASS</span></h4>
                        </div>
                        <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">Inovasi Digital untuk Desa Cikeduk</p>
                    </div>
                    
                    <div class="flex flex-wrap justify-center gap-6">
                        <div class="text-center">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">Anggota Tim</p>
                            <div class="flex -space-x-3">
                                <?php $__currentLoopData = ['AR', 'SR', 'SL', 'SS']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $initial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="w-10 h-10 rounded-full border-2 border-slate-800 bg-primary flex items-center justify-center text-[10px] font-black shadow-lg" title="Anggota"><?php echo e($initial); ?></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="h-12 w-px bg-white/10 hidden md:block"></div>
                        <div class="text-center md:text-left">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Dosen Pengampu</p>
                            <p class="text-sm font-black text-white">Rudi Kurniawan, M.T</p>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-10 pt-8 border-t border-white/5">
                    <?php $__currentLoopData = ['Ainur Rizki', 'Silvana Rohimatul Jannah', 'Siti Liza Azzahrah', 'Syifa Salsabilah']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center gap-2 px-4 py-2 bg-white/5 rounded-xl border border-white/5 group hover:bg-primary transition-all cursor-default">
                        <i class="fas fa-user-circle text-[10px] text-primary-light group-hover:text-white"></i>
                        <span class="text-[10px] font-bold text-slate-300 group-hover:text-white"><?php echo e($name); ?></span>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-[10px] font-black text-slate-500 tracking-[0.3em] uppercase">
                    &copy; 2024 SISTEM PELAYANAN PBB DESA CIKEDUK • ALL RIGHTS RESERVED
                </p>
                <div class="flex gap-8">
                    <a href="#" class="text-[10px] font-black text-slate-500 hover:text-white uppercase tracking-widest transition-colors">Keamanan</a>
                    <a href="#" class="text-[10px] font-black text-slate-500 hover:text-white uppercase tracking-widest transition-colors">Privasi</a>
                    <a href="#" class="text-[10px] font-black text-slate-500 hover:text-white uppercase tracking-widest transition-colors">Bantuan</a>
                </div>
            </div>
        </div>
    </footer>

    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards;
        }
    </style>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\pbb-cikeduk\resources\views/landing/index.blade.php ENDPATH**/ ?>