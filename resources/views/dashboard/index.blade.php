@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<!-- Header Section -->
<div class="mb-10">
    <h1 class="text-2xl font-black text-slate-900">Dashboard</h1>
    <p class="text-sm font-medium text-slate-500">Selamat datang kembali, <span class="text-primary font-bold">{{ auth()->user()->name }}</span></p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <!-- Total Wajib Pajak -->
    <div class="bg-white p-6 rounded-[2rem] shadow-premium border border-slate-50 relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
        <div class="relative z-10">
            <div class="w-12 h-12 bg-primary rounded-2xl flex items-center justify-center text-white mb-4 shadow-lg shadow-primary/20">
                <i class="fas fa-users text-xl"></i>
            </div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Total Wajib Pajak</p>
            <h3 class="text-2xl font-black text-slate-900">{{ number_format($totalWajibPajak) }}</h3>
            <p class="text-[10px] font-bold text-emerald-500 mt-2 flex items-center gap-1">
                <i class="fas fa-arrow-up"></i> 12% <span class="text-slate-400">dari bulan lalu</span>
            </p>
        </div>
    </div>

    <!-- Total PBB -->
    <div class="bg-white p-6 rounded-[2rem] shadow-premium border border-slate-50 relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
        <div class="relative z-10">
            <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center text-white mb-4 shadow-lg shadow-emerald-500/20">
                <i class="fas fa-landmark text-xl"></i>
            </div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Total PBB</p>
            <h3 class="text-2xl font-black text-slate-900">Rp {{ number_format($totalPbb, 0, ',', '.') }}</h3>
            <p class="text-[10px] font-bold text-emerald-500 mt-2 flex items-center gap-1">
                <i class="fas fa-arrow-up"></i> 8% <span class="text-slate-400">dari tahun lalu</span>
            </p>
        </div>
    </div>

    <!-- Total Pembayaran -->
    <div class="bg-white p-6 rounded-[2rem] shadow-premium border border-slate-50 relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
        <div class="relative z-10">
            <div class="w-12 h-12 bg-primary-light rounded-2xl flex items-center justify-center text-white mb-4 shadow-lg shadow-primary-light/20">
                <i class="fas fa-wallet text-xl"></i>
            </div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Total Pembayaran</p>
            <h3 class="text-2xl font-black text-slate-900">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</h3>
            <p class="text-[10px] font-bold text-emerald-500 mt-2 flex items-center gap-1">
                <i class="fas fa-arrow-up"></i> 15% <span class="text-slate-400">dari bulan lalu</span>
            </p>
        </div>
    </div>

    <!-- Total Tunggakan -->
    <div class="bg-white p-6 rounded-[2rem] shadow-premium border border-slate-50 relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-rose-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
        <div class="relative z-10">
            <div class="w-12 h-12 bg-rose-500 rounded-2xl flex items-center justify-center text-white mb-4 shadow-lg shadow-rose-500/20">
                <i class="fas fa-chart-line-down text-xl"></i>
            </div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Total Tunggakan</p>
            <h3 class="text-2xl font-black text-slate-900">Rp {{ number_format($totalTunggakan, 0, ',', '.') }}</h3>
            <p class="text-[10px] font-bold text-rose-500 mt-2 flex items-center gap-1">
                <i class="fas fa-arrow-down"></i> 5% <span class="text-slate-400">dari bulan lalu</span>
            </p>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
    <!-- Line Chart -->
    <div class="lg:col-span-2 bg-white p-8 rounded-[2.5rem] shadow-premium border border-slate-50">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h4 class="text-lg font-black text-slate-900">Grafik Pembayaran Bulanan</h4>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Tahun {{ date('Y') }}</p>
            </div>
            <div class="flex gap-2">
                <button class="w-8 h-8 rounded-lg bg-slate-50 text-slate-400 hover:text-primary transition-colors">
                    <i class="fas fa-ellipsis-h text-xs"></i>
                </button>
            </div>
        </div>
        <div class="h-[300px]">
            <canvas id="lineChart"></canvas>
        </div>
    </div>

    <!-- Donut Chart -->
    <div class="bg-white p-8 rounded-[2.5rem] shadow-premium border border-slate-50">
        <div class="mb-8">
            <h4 class="text-lg font-black text-slate-900">Grafik Tunggakan</h4>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Persentase Pelunasan</p>
        </div>
        <div class="h-[250px] relative">
            <canvas id="pieChart"></canvas>
        </div>
        <div class="mt-8 space-y-3">
            <div class="flex justify-between items-center px-2">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 rounded-full bg-primary-light"></div>
                    <span class="text-sm font-bold text-slate-600">Lunas</span>
                </div>
                <span class="text-sm font-black text-slate-900">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between items-center px-2">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 rounded-full bg-rose-500"></div>
                    <span class="text-sm font-bold text-slate-600">Tunggakan</span>
                </div>
                <span class="text-sm font-black text-slate-900">Rp {{ number_format($totalTunggakan, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Recent Transactions -->
<div class="bg-white p-8 rounded-[2.5rem] shadow-premium border border-slate-50 mb-10">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h4 class="text-lg font-black text-slate-900">Pembayaran Terbaru</h4>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">5 Transaksi Terakhir</p>
        </div>
        <a href="{{ route('payments.index') }}" class="text-xs font-black text-primary uppercase tracking-widest hover:underline">Lihat Semua</a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-100">
                    <th class="pb-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">No NOP</th>
                    <th class="pb-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Wajib Pajak</th>
                    <th class="pb-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Jumlah Bayar</th>
                    <th class="pb-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Tanggal</th>
                    <th class="pb-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pembayaranTerbaru as $pay)
                <tr class="group hover:bg-slate-50 transition-colors">
                    <td class="py-4 border-b border-slate-50">
                        <span class="text-xs font-bold text-slate-500">{{ $pay->tunggakan->wajibPajak->nop ?? '-' }}</span>
                    </td>
                    <td class="py-4 border-b border-slate-50">
                        <span class="text-sm font-black text-slate-900">{{ $pay->tunggakan->wajibPajak->nama ?? '-' }}</span>
                    </td>
                    <td class="py-4 border-b border-slate-50 text-right">
                        <span class="text-sm font-black text-primary">Rp {{ number_format($pay->jumlah_bayar, 0, ',', '.') }}</span>
                    </td>
                    <td class="py-4 border-b border-slate-50 text-center">
                        <span class="text-xs font-bold text-slate-500">{{ $pay->tanggal_bayar->format('d M Y') }}</span>
                    </td>
                    <td class="py-4 border-b border-slate-50 text-center">
                        <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-600 uppercase tracking-wider">
                            <i class="fas fa-check-circle text-[8px]"></i> Lunas
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-10 text-center text-slate-400 font-bold text-sm">Belum ada transaksi pembayaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxLine = document.getElementById('lineChart').getContext('2d');
    const lineGradient = ctxLine.createLinearGradient(0, 0, 0, 300);
    lineGradient.addColorStop(0, 'rgba(59, 130, 246, 0.2)');
    lineGradient.addColorStop(1, 'rgba(59, 130, 246, 0)');

    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Pembayaran',
                data: {!! json_encode($dataPembayaran) !!},
                borderColor: '#3b82f6',
                borderWidth: 4,
                backgroundColor: lineGradient,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#3b82f6',
                pointBorderWidth: 3,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e293b',
                    titleFont: { size: 12, weight: 'bold' },
                    bodyFont: { size: 14, weight: 'black' },
                    padding: 12,
                    cornerRadius: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: { 
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false },
                    ticks: {
                        font: { size: 10, weight: 'bold' },
                        color: '#94a3b8',
                        callback: function(value) {
                            if (value >= 1000000000) return (value / 1000000000).toFixed(1) + 'M';
                            if (value >= 1000000) return (value / 1000000).toFixed(0) + 'jt';
                            return value;
                        }
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 10, weight: 'bold' }, color: '#94a3b8' }
                }
            }
        }
    });

    const ctxPie = document.getElementById('pieChart').getContext('2d');
    new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: ['Lunas', 'Tunggakan'],
            datasets: [{
                data: [{{ $totalPembayaran }}, {{ $totalTunggakan }}],
                backgroundColor: ['#3b82f6', '#ef4444'],
                hoverOffset: 10,
                borderWidth: 0,
                borderRadius: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '80%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    cornerRadius: 12,
                    displayColors: false
                }
            }
        }
    });
</script>
@endpush
