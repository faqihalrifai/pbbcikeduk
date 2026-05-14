<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balik Nama PBB - Desa Cikeduk</title>
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
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="text-slate-700 antialiased">

    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-nav border-b border-slate-100">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('landing') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center overflow-hidden shadow-lg border border-slate-100 group-hover:scale-110 transition-transform">
                    <img src="{{ asset('logo.jpeg') }}" class="w-full h-full object-cover" alt="Logo Desa">
                </div>
                <div>
                    <h1 class="text-sm font-extrabold text-slate-900 leading-tight">SISTEM PELAYANAN</h1>
                    <p class="text-[10px] font-semibold text-primary tracking-widest uppercase">Pajak Bumi dan Bangunan (PBB)</p>
                </div>
            </a>
            
            <div class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600">
                <a href="{{ route('landing') }}" class="hover:text-primary transition-colors">Beranda</a>
                <a href="{{ route('landing.informasi') }}" class="hover:text-primary transition-colors">Informasi PBB</a>
                <a href="{{ route('landing.balik_nama') }}" class="text-primary border-b-2 border-primary pb-1">Balik Nama</a>
                <a href="{{ route('login') }}" class="bg-primary text-white px-6 py-2.5 rounded-xl hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">Login</a>
            </div>
        </div>
    </nav>

    <main class="pt-32 pb-20 container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-black text-slate-900 mb-4">Pengajuan Balik Nama PBB</h2>
                <p class="text-slate-500">Silakan lengkapi formulir di bawah ini untuk melakukan proses balik nama sertifikat PBB Anda.</p>
                <div class="w-20 h-1.5 bg-primary mx-auto rounded-full mt-6"></div>
            </div>

            @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 p-6 rounded-3xl mb-10 flex items-center gap-4 animate-fade-in-up">
                <div class="w-12 h-12 bg-emerald-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/20">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div>
                    <h4 class="font-black">Berhasil!</h4>
                    <p class="text-sm opacity-90">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            <form action="{{ route('landing.balik_nama.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <!-- Section: Data Pemilik Lama -->
                <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-premium border border-slate-50">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-blue-50 text-primary rounded-2xl flex items-center justify-center">
                            <i class="fas fa-user-clock text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-slate-900">Data Pemilik Lama</h3>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Informasi sertifikat saat ini</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-500 uppercase tracking-widest ml-1">Nama Pemilik Lama</label>
                            <input type="text" name="nama_pemilik_lama" value="{{ old('nama_pemilik_lama') }}" placeholder="Sesuai SPPT" required
                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold text-slate-900 focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all @error('nama_pemilik_lama') border-rose-500 @enderror">
                            @error('nama_pemilik_lama') <p class="text-[10px] font-bold text-rose-500 ml-2">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-500 uppercase tracking-widest ml-1">NOP (Nomor Objek Pajak)</label>
                            <input type="text" name="nop" value="{{ old('nop') }}" placeholder="Contoh: 32.01..." required
                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold text-slate-900 focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all @error('nop') border-rose-500 @enderror">
                            @error('nop') <p class="text-[10px] font-bold text-rose-500 ml-2">{{ $message }}</p> @enderror
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-xs font-black text-slate-500 uppercase tracking-widest ml-1">Alamat Objek Pajak</label>
                            <textarea name="alamat_objek" rows="3" placeholder="Alamat lengkap sesuai SPPT" required
                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold text-slate-900 focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all @error('alamat_objek') border-rose-500 @enderror">{{ old('alamat_objek') }}</textarea>
                            @error('alamat_objek') <p class="text-[10px] font-bold text-rose-500 ml-2">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Section: Data Pemilik Baru -->
                <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-premium border border-slate-50">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-blue-50 text-primary rounded-2xl flex items-center justify-center">
                            <i class="fas fa-user-plus text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-slate-900">Data Pemilik Baru</h3>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Informasi calon pemilik baru</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-500 uppercase tracking-widest ml-1">Nama Pemilik Baru</label>
                            <input type="text" name="nama_pemilik_baru" value="{{ old('nama_pemilik_baru') }}" placeholder="Sesuai KTP" required
                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold text-slate-900 focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all @error('nama_pemilik_baru') border-rose-500 @enderror">
                            @error('nama_pemilik_baru') <p class="text-[10px] font-bold text-rose-500 ml-2">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-500 uppercase tracking-widest ml-1">NIK (Sesuai KTP)</label>
                            <input type="text" name="nik" value="{{ old('nik') }}" placeholder="16 Digit Angka" required
                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold text-slate-900 focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all @error('nik') border-rose-500 @enderror">
                            @error('nik') <p class="text-[10px] font-bold text-rose-500 ml-2">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-500 uppercase tracking-widest ml-1">Nomor HP / WhatsApp</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="08..." required
                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold text-slate-900 focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all @error('no_hp') border-rose-500 @enderror">
                            @error('no_hp') <p class="text-[10px] font-bold text-rose-500 ml-2">{{ $message }}</p> @enderror
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-xs font-black text-slate-500 uppercase tracking-widest ml-1">Alamat Baru</label>
                            <textarea name="alamat_baru" rows="3" placeholder="Alamat tinggal pemilik baru" required
                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold text-slate-900 focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all @error('alamat_baru') border-rose-500 @enderror">{{ old('alamat_baru') }}</textarea>
                            @error('alamat_baru') <p class="text-[10px] font-bold text-rose-500 ml-2">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Section: Upload Dokumen -->
                <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-premium border border-slate-50">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-blue-50 text-primary rounded-2xl flex items-center justify-center">
                            <i class="fas fa-file-upload text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-slate-900">Upload Dokumen Pendukung</h3>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">PDF, JPG, PNG (Maks 2MB)</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- KTP -->
                        <div class="space-y-4">
                            <label class="text-xs font-black text-slate-500 uppercase tracking-widest ml-1 block">Upload KTP</label>
                            <div class="relative group">
                                <input type="file" name="ktp" accept=".pdf,.jpg,.jpeg,.png" required onchange="previewFile(this, 'preview-ktp')"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div id="preview-ktp" class="w-full h-40 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center p-4 transition-all group-hover:border-primary group-hover:bg-blue-50/50">
                                    <i class="fas fa-id-card text-3xl text-slate-300 mb-3 group-hover:text-primary group-hover:scale-110 transition-all"></i>
                                    <p class="text-xs font-bold text-slate-400 group-hover:text-primary">Klik atau seret file ke sini</p>
                                </div>
                            </div>
                            @error('ktp') <p class="text-[10px] font-bold text-rose-500 ml-2">{{ $message }}</p> @enderror
                        </div>

                        <!-- KK -->
                        <div class="space-y-4">
                            <label class="text-xs font-black text-slate-500 uppercase tracking-widest ml-1 block">Upload KK</label>
                            <div class="relative group">
                                <input type="file" name="kk" accept=".pdf,.jpg,.jpeg,.png" required onchange="previewFile(this, 'preview-kk')"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div id="preview-kk" class="w-full h-40 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center p-4 transition-all group-hover:border-primary group-hover:bg-blue-50/50">
                                    <i class="fas fa-users text-3xl text-slate-300 mb-3 group-hover:text-primary group-hover:scale-110 transition-all"></i>
                                    <p class="text-xs font-bold text-slate-400 group-hover:text-primary">Klik atau seret file ke sini</p>
                                </div>
                            </div>
                            @error('kk') <p class="text-[10px] font-bold text-rose-500 ml-2">{{ $message }}</p> @enderror
                        </div>

                        <!-- Bukti Kepemilikan -->
                        <div class="space-y-4">
                            <label class="text-xs font-black text-slate-500 uppercase tracking-widest ml-1 block">Upload Bukti Kepemilikan (Sertifikat/AJB)</label>
                            <div class="relative group">
                                <input type="file" name="bukti_kepemilikan" accept=".pdf,.jpg,.jpeg,.png" required onchange="previewFile(this, 'preview-bukti')"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div id="preview-bukti" class="w-full h-40 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center p-4 transition-all group-hover:border-primary group-hover:bg-blue-50/50">
                                    <i class="fas fa-file-contract text-3xl text-slate-300 mb-3 group-hover:text-primary group-hover:scale-110 transition-all"></i>
                                    <p class="text-xs font-bold text-slate-400 group-hover:text-primary">Klik atau seret file ke sini</p>
                                </div>
                            </div>
                            @error('bukti_kepemilikan') <p class="text-[10px] font-bold text-rose-500 ml-2">{{ $message }}</p> @enderror
                        </div>

                        <!-- SPPT Lama -->
                        <div class="space-y-4">
                            <label class="text-xs font-black text-slate-500 uppercase tracking-widest ml-1 block">Upload SPPT Lama</label>
                            <div class="relative group">
                                <input type="file" name="sppt_lama" accept=".pdf,.jpg,.jpeg,.png" required onchange="previewFile(this, 'preview-sppt')"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div id="preview-sppt" class="w-full h-40 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center p-4 transition-all group-hover:border-primary group-hover:bg-blue-50/50">
                                    <i class="fas fa-file-invoice-dollar text-3xl text-slate-300 mb-3 group-hover:text-primary group-hover:scale-110 transition-all"></i>
                                    <p class="text-xs font-bold text-slate-400 group-hover:text-primary">Klik atau seret file ke sini</p>
                                </div>
                            </div>
                            @error('sppt_lama') <p class="text-[10px] font-bold text-rose-500 ml-2">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-center pt-6">
                    <button type="submit" class="bg-primary text-white px-12 py-5 rounded-[2rem] font-black text-lg shadow-2xl shadow-primary/30 hover:bg-primary-dark hover:-translate-y-1 transition-all active:scale-95 flex items-center gap-3">
                        Kirim Pengajuan <i class="fas fa-paper-plane text-sm"></i>
                    </button>
                </div>
            </form>
        </div>
    </main>

    <footer class="p-8 text-center border-t border-slate-100 bg-white">
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">&copy; 2024 SISTEM PBB DESA CIKEDUK • ALL RIGHTS RESERVED</p>
    </footer>

    <script>
        function previewFile(input, previewId) {
            const container = document.getElementById(previewId);
            const file = input.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    let content = '';
                    if (file.type.startsWith('image/')) {
                        content = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-2xl">`;
                    } else {
                        content = `
                            <div class="flex flex-col items-center text-primary animate-pulse">
                                <i class="fas fa-file-pdf text-4xl mb-2"></i>
                                <p class="text-[10px] font-black uppercase tracking-widest">${file.name}</p>
                            </div>
                        `;
                    }
                    container.innerHTML = content;
                    container.classList.add('border-primary', 'bg-blue-50');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>

    <style>
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
