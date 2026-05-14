<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Bukti Pembayaran - {{ $payment->tunggakan->wajibPajak->nop ?? 'PBB' }}</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f1f5f9; }
        @media print {
            .no-print { display: none !important; }
            body { background-color: white; }
            .print-area { box-shadow: none !important; border: none !important; margin: 0 !important; width: 100% !important; }
        }
    </style>
</head>
<body class="p-4 md:p-10 flex flex-col lg:flex-row justify-center gap-10">

    <!-- Print Preview Sidebar (Settings) -->
    <div class="no-print w-full lg:w-80 space-y-6">
        <div class="bg-white p-8 rounded-[2.5rem] shadow-premium border border-slate-50">
            <h3 class="text-xl font-black text-slate-900 mb-6">Cetak Bukti</h3>
            
            <div class="space-y-6">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Pilih Printer</label>
                    <select class="w-full bg-slate-50 border border-slate-100 rounded-xl py-2.5 px-4 text-xs font-bold text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary-light transition-all appearance-none">
                        <option>EPSON L3210 Series</option>
                        <option>Save as PDF</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Ukuran Kertas</label>
                    <select class="w-full bg-slate-50 border border-slate-100 rounded-xl py-2.5 px-4 text-xs font-bold text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary-light transition-all appearance-none">
                        <option>A4</option>
                        <option>A5</option>
                        <option>Thermal 80mm</option>
                    </select>
                </div>

                <div class="pt-4 flex flex-col gap-3">
                    <button onclick="window.print()" class="w-full bg-primary hover:bg-primary-dark text-white font-black py-4 rounded-2xl shadow-xl shadow-primary/20 transition-all flex items-center justify-center gap-2">
                        <i class="fas fa-print"></i> Cetak Sekarang
                    </button>
                    <button onclick="window.close()" class="w-full bg-slate-100 text-slate-600 font-black py-4 rounded-2xl hover:bg-slate-200 transition-all">
                        Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Area -->
    <div class="print-area bg-white w-full max-w-[800px] shadow-2xl p-10 md:p-16 border border-white">
        <!-- Header -->
        <div class="flex items-center gap-8 border-b-4 border-slate-900 pb-8 mb-10">
            <div class="w-24 h-24 flex-shrink-0">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Lambang_Kementerian_Keuangan_Republik_Indonesia.png/180px-Lambang_Kementerian_Keuangan_Republik_Indonesia.png" alt="Logo" class="w-full h-full object-contain grayscale brightness-0">
            </div>
            <div class="text-center flex-1">
                <h1 class="text-xl font-black uppercase tracking-tight">Pemerintah Kota Sejahtera</h1>
                <h2 class="text-2xl font-black uppercase tracking-tight">Badan Pendapatan Daerah</h2>
                <h3 class="text-sm font-bold uppercase text-slate-500 tracking-[0.2em] mt-1">Bukti Pembayaran PBB</h3>
            </div>
            <div class="w-24 h-24 border-2 border-slate-200 rounded-xl flex items-center justify-center">
                <i class="fas fa-qrcode text-5xl text-slate-300"></i>
            </div>
        </div>

        <!-- Receipt Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8 mb-12">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Nomor Objek Pajak (NOP)</p>
                <p class="text-base font-black text-slate-900">{{ $payment->tunggakan->wajibPajak->nop ?? '-' }}</p>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">ID Transaksi</p>
                <p class="text-base font-black text-slate-900">TRX-{{ date('Ymd', strtotime($payment->tanggal_bayar)) }}-{{ sprintf('%04d', $payment->id) }}</p>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Nama Wajib Pajak</p>
                <p class="text-base font-black text-slate-900">{{ $payment->tunggakan->wajibPajak->nama ?? '-' }}</p>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Tanggal Bayar</p>
                <p class="text-base font-black text-slate-900">{{ \Carbon\Carbon::parse($payment->tanggal_bayar)->format('d F Y') }}</p>
            </div>
            <div class="md:col-span-2">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Alamat Objek Pajak</p>
                <p class="text-sm font-bold text-slate-700 leading-relaxed">{{ $payment->tunggakan->wajibPajak->alamat ?? '-' }}</p>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Tahun Pajak</p>
                <p class="text-base font-black text-slate-900">{{ $payment->tunggakan->tahun ?? '-' }}</p>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Metode Pembayaran</p>
                <p class="text-base font-black text-slate-900">Tunai / Kolektor</p>
            </div>
        </div>

        <!-- Totals -->
        <div class="border-t-2 border-slate-100 pt-8 mb-16">
            <div class="flex justify-between items-center mb-4">
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Jumlah Tagihan</span>
                <span class="text-base font-black text-slate-900">Rp {{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between items-center pb-6 mb-6 border-b-2 border-slate-900">
                <span class="text-sm font-black text-slate-900 uppercase tracking-widest">Total Bayar</span>
                <span class="text-3xl font-black text-slate-900">Rp {{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</span>
                <span class="inline-flex items-center gap-2 py-2 px-6 rounded-full bg-slate-900 text-white text-xs font-black uppercase tracking-widest">
                    <i class="fas fa-check-circle"></i> Lunas
                </span>
            </div>
        </div>

        <!-- Footer / Signature -->
        <div class="flex justify-between items-end">
            <div class="space-y-4">
                <div class="w-32 h-32 border border-slate-100 rounded-2xl flex items-center justify-center p-2">
                    <!-- Placeholder QR Code -->
                    <div class="w-full h-full bg-slate-50 flex items-center justify-center">
                        <i class="fas fa-qrcode text-4xl text-slate-200"></i>
                    </div>
                </div>
                <p class="text-[8px] font-bold text-slate-400 uppercase tracking-[0.2em] max-w-[200px]">Terima kasih atas pembayaran Anda. Simpan bukti ini sebagai tanda pelunasan yang sah.</p>
            </div>
            <div class="text-center w-64">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-16">Petugas / Kolektor</p>
                <p class="text-sm font-black text-slate-900 underline">{{ $payment->kolektor->nama ?? 'Petugas Loket' }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">NIP. 19820310 200501 1 002</p>
            </div>
        </div>
    </div>

</body>
</html>
