@extends('layouts.admin')

@section('title', 'Detail Pengajuan Balik Nama')

@section('content')
<div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
        <a href="{{ route('admin.balik_nama.index') }}" class="text-xs font-black text-primary uppercase tracking-widest hover:underline flex items-center gap-2 mb-2">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
        <h1 class="text-2xl font-black text-slate-900">Detail Pengajuan</h1>
        <p class="text-sm font-medium text-slate-500">NOP: {{ $balikNama->nop }}</p>
    </div>
    
    <div class="flex gap-3">
        <form action="{{ route('admin.balik_nama.update', $balikNama->id) }}" method="POST" class="flex gap-3">
            @csrf
            @method('PATCH')
            <select name="status" class="bg-white border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold text-slate-900 focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all appearance-none pr-10 relative">
                <option value="Menunggu Verifikasi" {{ $balikNama->status == 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                <option value="Diproses" {{ $balikNama->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="Disetujui" {{ $balikNama->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="Ditolak" {{ $balikNama->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit" class="bg-primary text-white px-6 py-3 rounded-2xl font-black text-xs shadow-lg shadow-primary/20 hover:bg-primary-dark transition-all">
                UPDATE STATUS
            </button>
        </form>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Info Section -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Data Pemilik -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-premium border border-slate-50">
            <h3 class="text-lg font-black text-slate-900 mb-6 flex items-center gap-3">
                <i class="fas fa-info-circle text-primary"></i> Informasi Pengajuan
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Nama Pemilik Lama</p>
                    <p class="text-sm font-bold text-slate-900">{{ $balikNama->nama_pemilik_lama }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">NOP</p>
                    <p class="text-sm font-black text-primary">{{ $balikNama->nop }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Alamat Objek Pajak</p>
                    <p class="text-sm font-bold text-slate-700 leading-relaxed">{{ $balikNama->alamat_objek }}</p>
                </div>
                
                <div class="md:col-span-2 border-t border-slate-50 pt-6"></div>

                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Nama Pemilik Baru</p>
                    <p class="text-sm font-black text-slate-900">{{ $balikNama->nama_pemilik_baru }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">NIK</p>
                    <p class="text-sm font-bold text-slate-900">{{ $balikNama->nik }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">No HP / WA</p>
                    <p class="text-sm font-bold text-slate-900">{{ $balikNama->no_hp }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Alamat Baru</p>
                    <p class="text-sm font-bold text-slate-700">{{ $balikNama->alamat_baru }}</p>
                </div>
            </div>
        </div>

        <!-- Dokumen Pendukung -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-premium border border-slate-50">
            <h3 class="text-lg font-black text-slate-900 mb-6 flex items-center gap-3">
                <i class="fas fa-file-alt text-primary"></i> Dokumen Pendukung
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @php
                    $docs = [
                        'ktp' => ['label' => 'KTP', 'icon' => 'fa-id-card'],
                        'kk' => ['label' => 'Kartu Keluarga', 'icon' => 'fa-users'],
                        'bukti_kepemilikan' => ['label' => 'Bukti Kepemilikan', 'icon' => 'fa-file-contract'],
                        'sppt_lama' => ['label' => 'SPPT Lama', 'icon' => 'fa-file-invoice-dollar'],
                    ];
                @endphp

                @foreach($docs as $key => $doc)
                <div class="group flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100 hover:border-primary transition-all">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-primary shadow-sm">
                            <i class="fas {{ $doc['icon'] }}"></i>
                        </div>
                        <div>
                            <p class="text-xs font-black text-slate-900 uppercase tracking-wide">{{ $doc['label'] }}</p>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">File Lampiran</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.balik_nama.download', [$balikNama->id, $key]) }}" class="w-8 h-8 bg-primary text-white rounded-lg flex items-center justify-center hover:bg-primary-dark transition-all">
                        <i class="fas fa-download text-xs"></i>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Timeline / Sidebar Info -->
    <div class="space-y-8">
        <div class="bg-white p-8 rounded-[2.5rem] shadow-premium border border-slate-50">
            <h3 class="text-lg font-black text-slate-900 mb-6">Status Pengajuan</h3>
            
            <div class="relative pl-8 space-y-8 before:content-[''] before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-100">
                <div class="relative">
                    <div class="absolute -left-[27px] top-1 w-4 h-4 rounded-full border-4 border-white bg-emerald-500 shadow-sm"></div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Diterima Sistem</p>
                    <p class="text-xs font-bold text-slate-900">{{ $balikNama->created_at->format('d M Y, H:i') }}</p>
                </div>

                <div class="relative">
                    @php
                        $isProcessed = in_array($balikNama->status, ['Diproses', 'Disetujui', 'Ditolak']);
                        $dotColor = $isProcessed ? 'bg-primary' : 'bg-slate-200';
                    @endphp
                    <div class="absolute -left-[27px] top-1 w-4 h-4 rounded-full border-4 border-white {{ $dotColor }} shadow-sm"></div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Verifikasi Admin</p>
                    <p class="text-xs font-bold text-slate-900">{{ $isProcessed ? 'Sudah Diperiksa' : 'Menunggu Antrean' }}</p>
                </div>

                <div class="relative">
                    @php
                        $isFinal = in_array($balikNama->status, ['Disetujui', 'Ditolak']);
                        $finalColor = $isFinal ? ($balikNama->status == 'Disetujui' ? 'bg-emerald-500' : 'bg-rose-500') : 'bg-slate-200';
                    @endphp
                    <div class="absolute -left-[27px] top-1 w-4 h-4 rounded-full border-4 border-white {{ $finalColor }} shadow-sm"></div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Hasil Akhir</p>
                    <p class="text-xs font-bold text-slate-900">
                        @if($isFinal)
                            {{ $balikNama->status }} pada {{ $balikNama->updated_at->format('d M Y') }}
                        @else
                            Menunggu Keputusan
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
