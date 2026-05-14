@extends('layouts.admin')

@section('title', 'Pengajuan Balik Nama')

@section('content')
<div class="mb-10">
    <h1 class="text-2xl font-black text-slate-900">Pengajuan Balik Nama</h1>
    <p class="text-sm font-medium text-slate-500">Daftar pengajuan balik nama sertifikat PBB dari masyarakat</p>
</div>

<div class="bg-white p-8 rounded-[2.5rem] shadow-premium border border-slate-50 mb-10">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-100">
                    <th class="pb-4 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Waktu Pengajuan</th>
                    <th class="pb-4 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">NOP</th>
                    <th class="pb-4 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Pemilik Lama</th>
                    <th class="pb-4 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Pemilik Baru</th>
                    <th class="pb-4 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                    <th class="pb-4 px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $item)
                <tr class="group hover:bg-slate-50 transition-colors">
                    <td class="py-4 px-4 border-b border-slate-50">
                        <span class="text-xs font-bold text-slate-500">{{ $item->created_at->format('d/m/Y H:i') }}</span>
                    </td>
                    <td class="py-4 px-4 border-b border-slate-50">
                        <span class="text-sm font-black text-slate-900">{{ $item->nop }}</span>
                    </td>
                    <td class="py-4 px-4 border-b border-slate-50">
                        <span class="text-sm font-bold text-slate-600">{{ $item->nama_pemilik_lama }}</span>
                    </td>
                    <td class="py-4 px-4 border-b border-slate-50">
                        <span class="text-sm font-black text-primary">{{ $item->nama_pemilik_baru }}</span>
                    </td>
                    <td class="py-4 px-4 border-b border-slate-50 text-center">
                        @php
                            $statusClasses = [
                                'Menunggu Verifikasi' => 'bg-amber-100 text-amber-600',
                                'Diproses' => 'bg-blue-100 text-blue-600',
                                'Disetujui' => 'bg-emerald-100 text-emerald-600',
                                'Ditolak' => 'bg-rose-100 text-rose-600',
                            ];
                            $class = $statusClasses[$item->status] ?? 'bg-slate-100 text-slate-600';
                        @endphp
                        <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-[10px] font-black {{ $class }} uppercase tracking-wider">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="py-4 px-4 border-b border-slate-50 text-right">
                        <a href="{{ route('admin.balik_nama.show', $item->id) }}" class="inline-flex items-center gap-2 bg-slate-100 text-slate-600 hover:bg-primary hover:text-white px-4 py-2 rounded-xl text-xs font-black transition-all">
                            DETAIL <i class="fas fa-chevron-right text-[10px]"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-10 text-center text-slate-400 font-bold text-sm">Belum ada pengajuan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-8">
        {{ $requests->links() }}
    </div>
</div>
@endsection
