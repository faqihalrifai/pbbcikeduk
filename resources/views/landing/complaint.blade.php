<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Pengaduan - PBB Cikeduk</title>
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

    <!-- Header -->
    <nav class="bg-white border-b border-slate-100 py-6 sticky top-0 z-50">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <a href="{{ route('landing') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center overflow-hidden border border-slate-100 shadow-sm">
                    <img src="{{ asset('logo.jpeg') }}" class="w-full h-full object-cover" alt="Logo">
                </div>
                <span class="font-black text-slate-900 tracking-tight uppercase text-sm">Beranda</span>
            </a>
            <h1 class="text-lg font-black text-slate-900">PUSAT PENGADUAN LAYANAN</h1>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-6 py-12">
        <div class="max-w-6xl mx-auto">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                
                <!-- Left: Complaint Form -->
                <div>
                    <div class="bg-white rounded-[2.5rem] p-10 shadow-premium border border-slate-50">
                        <h2 class="text-3xl font-black text-slate-900 mb-4">Kirim Pengaduan</h2>
                        <p class="text-slate-500 mb-10">Sampaikan keluhan, saran, atau pertanyaan Anda terkait pelayanan PBB Desa Cikeduk.</p>

                        @if(session('success'))
                        <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-2xl flex items-center gap-3 animate-fade-in">
                            <i class="fas fa-check-circle text-xl"></i>
                            <p class="font-bold text-sm">{{ session('success') }}</p>
                        </div>
                        @endif

                        <form action="{{ route('landing.complaint.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Nama Lengkap</label>
                                    <input type="text" name="nama" required placeholder="Nama Anda"
                                        class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Nomor HP / WhatsApp</label>
                                    <input type="text" name="no_hp" required placeholder="Contoh: 08123456789"
                                        class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Judul Pengaduan</label>
                                <input type="text" name="judul" required placeholder="Misal: Kesalahan Nama di SPPT"
                                    class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all">
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Isi Pengaduan</label>
                                <textarea name="isi" required rows="5" placeholder="Jelaskan secara detail pengaduan Anda..."
                                    class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all"></textarea>
                            </div>

                            <button type="submit" class="w-full bg-primary text-white py-5 rounded-2xl font-black text-lg shadow-xl shadow-primary/20 hover:bg-primary-dark transition-all active:scale-95 flex items-center justify-center gap-3">
                                <i class="fas fa-paper-plane"></i> KIRIM PENGADUAN
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Right: Complaint History -->
                <div class="space-y-8">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-black text-slate-900">Riwayat Pengaduan</h3>
                        <span class="text-[10px] font-black text-primary bg-blue-50 px-3 py-1 rounded-full uppercase tracking-widest">Terbaru</span>
                    </div>

                    <div class="space-y-4">
                        @forelse($complaints as $c)
                        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-all">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-slate-900">{{ $c->nama }}</p>
                                        <p class="text-[10px] font-bold text-slate-400">{{ $c->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                @if($c->status == 'Selesai')
                                <span class="text-[9px] font-black bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full uppercase tracking-widest">Selesai</span>
                                @else
                                <span class="text-[9px] font-black bg-orange-100 text-orange-600 px-3 py-1 rounded-full uppercase tracking-widest">{{ $c->status }}</span>
                                @endif
                            </div>
                            <h4 class="font-bold text-slate-800 text-sm mb-2">{{ $c->judul }}</h4>
                            <p class="text-slate-500 text-xs leading-relaxed line-clamp-2 italic">"{{ $c->isi }}"</p>
                        </div>
                        @empty
                        <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2rem] p-12 text-center">
                            <i class="fas fa-comments text-4xl text-slate-200 mb-4 block"></i>
                            <p class="text-slate-400 font-bold text-sm">Belum ada pengaduan publik.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    </main>

    <footer class="bg-white py-12 border-t border-slate-100 mt-20">
        <div class="container mx-auto px-6 text-center text-[10px] font-black text-slate-400 tracking-[0.3em] uppercase">
            &copy; 2024 SISTEM PBB DESA CIKEDUK • LAYANAN PENGADUAN MASYARAKAT
        </div>
    </footer>

</body>
</html>
