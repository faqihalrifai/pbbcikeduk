@extends('layouts.admin')

@section('title', 'Laporan PBB')

@section('content')
<div class="mb-10">
    <h1 class="text-2xl font-black text-slate-900">Laporan PBB</h1>
    <p class="text-sm font-medium text-slate-500">Seluruh data Pajak Bumi dan Bangunan Desa Cikeduk</p>
</div>

<div class="bg-white p-8 rounded-[2.5rem] shadow-premium border border-slate-50 mb-10">
    <form action="{{ route('reports.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 mb-8">
        <div class="flex-grow relative">
            <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari NOP atau Nama..." 
                class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 pl-14 pr-6 text-sm font-bold text-slate-900 focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all">
        </div>
        <div class="w-full md:w-48">
            <select name="status" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 text-sm font-bold text-slate-900 focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all appearance-none">
                <option value="">Semua Status</option>
                <option value="Lunas" {{ $status == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="Belum Lunas" {{ $status == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
            </select>
        </div>
        <button type="submit" class="bg-primary text-white px-8 py-4 rounded-2xl font-black text-sm shadow-lg shadow-primary/20 hover:bg-primary-dark transition-all">
            FILTER
        </button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-100">
                    <th class="pb-4 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">NOP</th>
                    <th class="pb-4 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Wajib Pajak</th>
                    <th class="pb-4 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Alamat</th>
                    <th class="pb-4 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Ketetapan</th>
                    <th class="pb-4 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pbbs as $pbb)
                <tr class="group hover:bg-slate-50 transition-colors">
                    <td class="py-4 px-4 border-b border-slate-50">
                        <span class="text-xs font-bold text-slate-500">{{ $pbb->nop }}</span>
                    </td>
                    <td class="py-4 px-4 border-b border-slate-50">
                        <span class="text-sm font-black text-slate-900">{{ $pbb->nama_wp }}</span>
                    </td>
                    <td class="py-4 px-4 border-b border-slate-50">
                        <span class="text-xs font-medium text-slate-500">{{ $pbb->alamat_wajib_pajak }}</span>
                    </td>
                    <td class="py-4 px-4 border-b border-slate-50 text-right">
                        <span class="text-sm font-black text-primary">Rp {{ number_format($pbb->ketetapan_pbb, 0, ',', '.') }}</span>
                    </td>
                    <td class="py-4 px-4 border-b border-slate-50 text-center">
                        @if($pbb->status == 'Lunas')
                        <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-600 uppercase tracking-wider">
                            <i class="fas fa-check-circle text-[8px]"></i> Lunas
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-[10px] font-black bg-rose-100 text-rose-600 uppercase tracking-wider">
                            <i class="fas fa-clock text-[8px]"></i> Belum Lunas
                        </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-10 text-center text-slate-400 font-bold text-sm">Tidak ada data ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-8">
        {{ $pbbs->appends(request()->all())->links() }}
    </div>
</div>
@endsection
