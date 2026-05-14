@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Pengaturan Sistem</div>
            <div class="card-body">
                <form action="{{ route('settings.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Nama Desa / Instansi</label>
                        <input type="text" name="nama_instansi" class="form-control" value="{{ $settings['nama_instansi'] ?? 'Pemerintah Desa Cikeduk' }}">
                    </div>
                    <div class="mb-3">
                        <label>Tahun Anggaran Berjalan</label>
                        <input type="number" name="tahun_anggaran" class="form-control" value="{{ $settings['tahun_anggaran'] ?? date('Y') }}">
                    </div>
                    <div class="mb-3">
                        <label>Pesan Selamat Datang (Landing Page)</label>
                        <textarea name="pesan_landing" class="form-control">{{ $settings['pesan_landing'] ?? 'Selamat Datang di Sistem Pelayanan PBB Online' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Kontak Layanan</label>
                        <input type="text" name="kontak_layanan" class="form-control" value="{{ $settings['kontak_layanan'] ?? '0812-3456-7890' }}">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
