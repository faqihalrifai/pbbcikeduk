<!DOCTYPE html>
<html>
<head>
    <title>SPPT PBB - {{ $pbb->nop }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #333; line-height: 1.4; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .logo { width: 80px; height: auto; margin-bottom: 5px; }
        .title { font-size: 18px; font-weight: bold; margin: 0; text-transform: uppercase; }
        .subtitle { font-size: 12px; margin: 2px 0; font-weight: bold; }
        .doc-title { text-align: center; font-size: 16px; font-weight: bold; text-decoration: underline; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .table td { padding: 8px; border: 1px solid #000; font-size: 12px; }
        .label { font-weight: bold; width: 35%; background-color: #f2f2f2; }
        .value { width: 65%; }
        .footer { margin-top: 30px; text-align: right; }
        .signature-box { margin-top: 40px; display: inline-block; text-align: center; }
        .signature { margin-top: 60px; border-top: 1px solid #000; width: 200px; display: inline-block; }
        .qr-code { float: left; width: 80px; height: 80px; margin-top: 10px; }
        .disclaimer { font-size: 9px; color: #555; margin-top: 60px; border-top: 1px dashed #ccc; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('logo.jpeg'))) }}" class="logo">
        <div class="title">PEMERINTAH KABUPATEN CIREBON</div>
        <div class="subtitle">KECAMATAN DEPOK - DESA CIKEDUK</div>
        <div class="subtitle" style="font-weight: normal; font-style: italic;">Alamat: Jl. Nursefi, Desa Cikeduk, Kecamatan Depok, Kab. Cirebon</div>
    </div>

    <div class="doc-title">SURAT PEMBERITAHUAN PAJAK TERHUTANG (SPPT)</div>

    <table class="table">
        <tr>
            <td class="label">NOMOR OBJEK PAJAK (NOP)</td>
            <td class="value"><strong>{{ $pbb->nop }}</strong></td>
        </tr>
        <tr>
            <td class="label">TAHUN PAJAK</td>
            <td class="value">2026</td>
        </tr>
        <tr>
            <td class="label">NAMA WAJIB PAJAK</td>
            <td class="value">{{ $pbb->nama_wp }}</td>
        </tr>
        <tr>
            <td class="label">ALAMAT WAJIB PAJAK</td>
            <td class="value">{{ $pbb->alamat_wajib_pajak }}</td>
        </tr>
        <tr>
            <td class="label">LETAK OBJEK PAJAK</td>
            <td class="value">BLOK: {{ $pbb->blok ?? '-' }}, NO URUT: {{ $pbb->no_urut ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">LUAS TANAH / BUMI</td>
            <td class="value">{{ $pbb->luas ?? '-' }} m2</td>
        </tr>
        <tr>
            <td class="label" style="background-color: #ddd;">TOTAL PAJAK TERHUTANG</td>
            <td class="value" style="font-size: 16px; font-weight: bold;">
                Rp {{ number_format($pbb->ketetapan_pbb, 0, ',', '.') }}
            </td>
        </tr>
        <tr>
            <td class="label">STATUS PEMBAYARAN</td>
            <td class="value">
                <strong style="color: {{ $pbb->status == 'Lunas' ? '#059669' : '#dc2626' }}">
                    {{ strtoupper($pbb->status ?? 'BELUM LUNAS') }}
                </strong>
            </td>
        </tr>
    </table>

    <div class="footer">
        <div class="signature-box">
            <div>Ditetapkan di Cikeduk, {{ date('d F Y') }}</div>
            <div>Kepala Desa Cikeduk</div>
            <div class="signature"></div>
            <div style="font-weight: bold; margin-top: 5px;">( H. AHMAD SYAFI'I )</div>
        </div>
    </div>

    <div class="qr-code">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=VALID_SPPT_{{ $pbb->nop }}_{{ $pbb->status }}" width="80">
    </div>

    <div class="disclaimer">
        * Dokumen ini adalah salinan digital resmi dari Sistem PBB Desa Cikeduk.<br>
        * Pastikan melakukan pembayaran melalui saluran resmi untuk menghindari denda.<br>
        * Simpan bukti ini sebagai referensi tagihan pajak Anda.
    </div>
</body>
</html>
