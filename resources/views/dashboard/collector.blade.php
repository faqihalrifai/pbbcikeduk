@extends('layouts.admin')

@section('title', 'Dashboard Kolektor')

@section('content')
<!-- Header Section -->
<div class="mb-10">
    <h1 class="text-2xl font-black text-slate-900">Dashboard Kolektor</h1>
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
            <p class="text-[10px] font-bold text-slate-400 mt-2 tracking-widest uppercase">Target Wilayah</p>
        </div>
    </div>

    <!-- Total Setoran Saya -->
    <div class="bg-white p-6 rounded-[2rem] shadow-premium border border-slate-50 relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
        <div class="relative z-10">
            <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center text-white mb-4 shadow-lg shadow-emerald-500/20">
                <i class="fas fa-wallet text-xl"></i>
            </div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Total Setoran Saya</p>
            <h3 class="text-2xl font-black text-slate-900">Rp {{ number_format($totalSetoran, 0, ',', '.') }}</h3>
            <p class="text-[10px] font-bold text-emerald-500 mt-2 tracking-widest uppercase">Semua Transaksi</p>
        </div>
    </div>

    <!-- Setoran Hari Ini -->
    <div class="bg-white p-6 rounded-[2rem] shadow-premium border border-slate-50 relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
        <div class="relative z-10">
            <div class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center text-white mb-4 shadow-lg shadow-amber-500/20">
                <i class="fas fa-calendar-day text-xl"></i>
            </div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Setoran Hari Ini</p>
            <h3 class="text-2xl font-black text-slate-900">Rp {{ number_format($setoranHariIni, 0, ',', '.') }}</h3>
            <p class="text-[10px] font-bold text-amber-600 mt-2 tracking-widest uppercase">Target Harian</p>
        </div>
    </div>

    <!-- Total Tagihan Desa -->
    <div class="bg-white p-6 rounded-[2rem] shadow-premium border border-slate-50 relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-rose-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
        <div class="relative z-10">
            <div class="w-12 h-12 bg-rose-500 rounded-2xl flex items-center justify-center text-white mb-4 shadow-lg shadow-rose-500/20">
                <i class="fas fa-chart-line text-xl"></i>
            </div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Total Tagihan Desa</p>
            <h3 class="text-2xl font-black text-slate-900">Rp {{ number_format($jumlahTagihan, 0, ',', '.') }}</h3>
            <p class="text-[10px] font-bold text-rose-500 mt-2 tracking-widest uppercase">Potensi Desa</p>
        </div>
    </div>
</div>

<!-- Recent Collections Table -->
<div class="bg-white p-8 rounded-[2.5rem] shadow-premium border border-slate-50 mb-10">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h4 class="text-lg font-black text-slate-900">Riwayat Penagihan Saya</h4>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">10 Transaksi Terakhir</p>
        </div>
        <a href="{{ route('payments.index') }}" class="text-xs font-black text-primary uppercase tracking-widest hover:underline">Lihat Semua</a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="py-5 px-8 text-[10px] font-black text-slate-400 uppercase tracking-widest">NOP</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Wajib Pajak</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Jumlah Bayar</th>
                    <th class="py-5 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Tanggal</th>
                    <th class="py-5 px-8 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($pembayaranTerbaru as $pay)
                <tr class="group hover:bg-slate-50/50 transition-colors">
                    <td class="py-4 px-8 text-xs font-black text-primary">{{ $pay->tunggakan->wajibPajak->nop }}</td>
                    <td class="py-4 px-4 text-sm font-black text-slate-900">{{ $pay->tunggakan->wajibPajak->nama }}</td>
                    <td class="py-4 px-4 text-sm font-black text-primary text-right">Rp {{ number_format($pay->jumlah_bayar, 0, ',', '.') }}</td>
                    <td class="py-4 px-4 text-center text-xs font-bold text-slate-500">{{ $pay->tanggal_bayar->format('d/m/Y') }}</td>
                    <td class="py-4 px-8 text-center">
                        <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-600 uppercase tracking-wider">
                            Lunas
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-12 text-center text-slate-400 font-bold text-sm">Belum ada transaksi pembayaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
