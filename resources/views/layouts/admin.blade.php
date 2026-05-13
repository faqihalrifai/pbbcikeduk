<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Sistem PBB</title>
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
                        sidebar: '#0f172a',
                    },
                    borderRadius: {
                        'premium': '1rem',
                        '2xl': '1.25rem',
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
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
        @media (max-width: 1024px) {
            .sidebar-hidden { transform: translateX(-100%); }
        }
    </style>
    @stack('styles')
</head>
<body class="text-slate-700 antialiased overflow-x-hidden">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-sidebar text-white transition-transform duration-300 transform lg:translate-x-0 sidebar-hidden">
            <div class="h-full flex flex-col">
                <!-- Brand -->
                <div class="p-8 flex items-center gap-4 border-b border-white/5">
                    <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center shadow-lg shadow-primary/20">
                        <i class="fas fa-landmark text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-sm font-black tracking-tight leading-tight uppercase">SISTEM PBB</h1>
                        <p class="text-[10px] text-slate-400 font-bold tracking-widest uppercase">{{ auth()->user()->role === 'kolektor' ? 'Kolektor Desa' : 'Administrator' }}</p>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 sidebar-scroll overflow-y-auto">
                    <div class="space-y-1">
                        <p class="px-4 text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">Utama</p>
                        
                        @php
                            $dashboardRoute = auth()->user()->role === 'kolektor' ? 'kolektor.dashboard' : 'dashboard';
                        @endphp
                        <a href="{{ route($dashboardRoute) }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all {{ request()->routeIs('dashboard') || request()->routeIs('kolektor.dashboard') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <i class="fas fa-grid-2 text-lg"></i>
                            <span class="font-bold text-sm">Dashboard</span>
                        </a>

                        @if(in_array(auth()->user()->role, ['admin', 'petugas']))
                        <a href="{{ route('pbbs.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all {{ request()->routeIs('pbbs.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <i class="fas fa-file-invoice-dollar text-lg"></i>
                            <span class="font-bold text-sm">Kelola Data PBB</span>
                        </a>
                        @endif

                        @if(in_array(auth()->user()->role, ['admin']))
                        <a href="{{ route('collectors.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all {{ request()->routeIs('collectors.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <i class="fas fa-users-gear text-lg"></i>
                            <span class="font-bold text-sm">Kelola Kolektor</span>
                        </a>
                        @endif

                        <a href="{{ route('payments.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all {{ request()->routeIs('payments.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <i class="fas fa-wallet text-lg"></i>
                            <span class="font-bold text-sm">Sistem Pembayaran</span>
                        </a>
                    </div>

                    <div class="mt-8 space-y-1">
                        <p class="px-4 text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">Laporan & Pengaturan</p>
                        
                        <a href="{{ route('reports.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all {{ request()->routeIs('reports.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <i class="fas fa-chart-pie text-lg"></i>
                            <span class="font-bold text-sm">Laporan</span>
                        </a>

                        @if(auth()->user()->role == 'admin')
                        <a href="{{ route('admin.balik_nama.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all {{ request()->routeIs('admin.balik_nama.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <i class="fas fa-file-signature text-lg"></i>
                            <span class="font-bold text-sm">Pengajuan Balik Nama</span>
                        </a>
                        @endif

                        @if(auth()->user()->role == 'admin')
                        <a href="{{ route('settings.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all {{ request()->routeIs('settings.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <i class="fas fa-sliders text-lg"></i>
                            <span class="font-bold text-sm">Pengaturan Web</span>
                        </a>
                        @endif
                    </div>
                </nav>

                <!-- Footer Sidebar -->
                <div class="p-6">
                    <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="w-full flex items-center justify-center gap-3 px-4 py-4 rounded-2xl bg-rose-500/10 text-rose-500 hover:bg-rose-500 hover:text-white transition-all font-bold text-sm">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 lg:ml-72 min-h-screen flex flex-col">
            <!-- Topbar -->
            <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-100 px-8 py-4 flex justify-between items-center">
                <button id="sidebarToggle" class="lg:hidden w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-slate-600">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="hidden md:flex items-center gap-4 bg-slate-50 px-4 py-2 rounded-2xl border border-slate-100 w-96">
                    <i class="fas fa-search text-slate-400 text-sm"></i>
                    <input type="text" placeholder="Cari NOP atau Nama WP..." class="bg-transparent border-none focus:ring-0 text-sm w-full placeholder-slate-400">
                </div>

                <div class="flex items-center gap-6">
                    <div class="hidden sm:flex flex-col text-right">
                        <span class="text-xs font-black text-slate-900 uppercase">{{ auth()->user()->name }}</span>
                        <span class="text-[10px] font-bold text-primary uppercase tracking-widest">{{ auth()->user()->role }}</span>
                    </div>
                    <div class="relative group">
                        <button class="w-12 h-12 rounded-2xl overflow-hidden border-2 border-primary/20 p-0.5 group-hover:border-primary transition-all">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=1e40af&color=fff" alt="Profile" class="w-full h-full rounded-[14px] object-cover">
                        </button>
                        <!-- Dropdown Menu (optional) -->
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-8 flex-1">
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="p-8 text-center border-t border-slate-100">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">&copy; {{ date('Y') }} SISTEM PELAYANAN PBB ONLINE. ALL RIGHTS RESERVED.</p>
            </footer>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        $(document).ready(function() {
            $('#sidebarToggle').click(function() {
                $('#sidebar').toggleClass('sidebar-hidden');
            });

            // Close sidebar on mobile when clicking outside
            $(document).click(function(event) {
                if (!$(event.target).closest('#sidebar, #sidebarToggle').length) {
                    if (!$('#sidebar').hasClass('sidebar-hidden')) {
                        $('#sidebar').addClass('sidebar-hidden');
                    }
                }
            });
        });
    </script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end',
            customClass: { popup: 'rounded-3xl' }
        });
    </script>
    @endif

    @stack('scripts')
</body>
</html>
