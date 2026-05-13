<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Online - PBB Cikeduk</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af',
                        'primary-light': '#3b82f6',
                    },
                    borderRadius: {
                        '2xl': '1rem',
                        '3xl': '1.5rem',
                    },
                    boxShadow: {
                        'premium': '0 20px 50px -12px rgba(0, 0, 0, 0.1)',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; background: #f8fafc; }
        .payment-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .payment-card:hover { transform: translateY(-5px); border-color: #1e40af; background: #eff6ff; }
        .payment-card.active { border-color: #1e40af; background: #eff6ff; ring: 2px; ring-color: #1e40af; }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <!-- Header -->
    <nav class="bg-white border-b border-slate-100 py-6">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <a href="<?php echo e(route('landing')); ?>" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center overflow-hidden border border-slate-100 shadow-sm">
                    <img src="<?php echo e(asset('logo.jpeg')); ?>" class="w-full h-full object-cover" alt="Logo">
                </div>
                <span class="font-black text-slate-900 tracking-tight">KEMBALI KE BERANDA</span>
            </a>
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sistem Pembayaran Terenkripsi</span>
            </div>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-6 py-12">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <!-- Left Column: Input Details -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Step 1: NOP Lookup -->
                    <div class="bg-white rounded-[2.5rem] p-10 shadow-premium border border-slate-50">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 bg-blue-50 text-primary rounded-2xl flex items-center justify-center font-black text-xl">1</div>
                            <h2 class="text-2xl font-black text-slate-900">Informasi Objek Pajak</h2>
                        </div>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Nomor Objek Pajak (NOP)</label>
                                <div class="relative">
                                    <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                    <input type="text" id="nop_input" placeholder="Masukkan 18 digit NOP Anda..." 
                                        class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 pl-14 pr-6 text-lg font-black text-slate-900 focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all">
                                </div>
                            </div>

                            <div id="details_card" class="hidden animate-fade-in">
                                <div class="bg-blue-50/50 rounded-3xl p-8 border border-blue-100/50">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        <div>
                                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Nama Wajib Pajak</p>
                                            <p id="wp_name" class="text-lg font-black text-slate-900">-</p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Jumlah Tagihan</p>
                                            <p id="wp_amount" class="text-2xl font-black text-primary">Rp 0</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Payment Method -->
                    <div class="bg-white rounded-[2.5rem] p-10 shadow-premium border border-slate-50">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 bg-blue-50 text-primary rounded-2xl flex items-center justify-center font-black text-xl">2</div>
                            <h2 class="text-2xl font-black text-slate-900">Metode Pembayaran</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Bank BRI -->
                            <div class="payment-card border border-slate-100 rounded-3xl p-6 cursor-pointer flex items-center gap-4" data-method="bri">
                                <div class="w-14 h-14 bg-white shadow-sm border border-slate-100 rounded-2xl flex items-center justify-center p-2">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2e/BRI_Logo.svg" class="w-full" alt="BRI">
                                </div>
                                <div>
                                    <p class="font-black text-slate-900">Bank BRI</p>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Virtual Account</p>
                                </div>
                            </div>

                            <!-- DANA -->
                            <div class="payment-card border border-slate-100 rounded-3xl p-6 cursor-pointer flex items-center gap-4" data-method="dana">
                                <div class="w-14 h-14 bg-white shadow-sm border border-slate-100 rounded-2xl flex items-center justify-center p-2">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg" class="w-full" alt="DANA">
                                </div>
                                <div>
                                    <p class="font-black text-slate-900">DANA</p>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">E-Wallet</p>
                                </div>
                            </div>

                            <!-- Alfamart -->
                            <div class="payment-card border border-slate-100 rounded-3xl p-6 cursor-pointer flex items-center gap-4" data-method="alfamart">
                                <div class="w-14 h-14 bg-white shadow-sm border border-slate-100 rounded-2xl flex items-center justify-center p-2">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Alfamart_logo.svg" class="w-full" alt="Alfamart">
                                </div>
                                <div>
                                    <p class="font-black text-slate-900">Alfamart</p>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Gerai Retail</p>
                                </div>
                            </div>

                            <!-- Indomaret -->
                            <div class="payment-card border border-slate-100 rounded-3xl p-6 cursor-pointer flex items-center gap-4" data-method="indomaret">
                                <div class="w-14 h-14 bg-white shadow-sm border border-slate-100 rounded-2xl flex items-center justify-center p-2">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png" class="w-full" alt="Indomaret">
                                </div>
                                <div>
                                    <p class="font-black text-slate-900">Indomaret</p>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Gerai Retail</p>
                                </div>
                            </div>

                            <!-- QRIS -->
                            <div class="payment-card border border-slate-100 rounded-3xl p-6 cursor-pointer flex items-center gap-4 col-span-1 md:col-span-2" data-method="qris">
                                <div class="w-14 h-14 bg-white shadow-sm border border-slate-100 rounded-2xl flex items-center justify-center p-2">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg" class="w-full" alt="QRIS">
                                </div>
                                <div>
                                    <p class="font-black text-slate-900">QRIS</p>
                                    <p class="text-[10px] font-bold text-emerald-500 uppercase tracking-widest">Bayar Instan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Summary & QRIS -->
                <div class="space-y-8">
                    <div class="bg-slate-900 rounded-[2.5rem] p-10 shadow-2xl text-white sticky top-12">
                        <h3 class="text-xl font-black mb-8">Ringkasan Pembayaran</h3>
                        
                        <div class="space-y-6 mb-10 pb-10 border-b border-white/10">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-white/50 font-medium">Tagihan PBB</span>
                                <span id="summary_amount" class="font-black">Rp 0</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-white/50 font-medium">Biaya Admin</span>
                                <span class="font-black">Rp 2.500</span>
                            </div>
                            <div class="pt-4 flex justify-between items-center">
                                <span class="text-lg font-black">Total</span>
                                <span id="total_amount" class="text-2xl font-black text-primary-light">Rp 0</span>
                            </div>
                        </div>

                        <!-- QRIS View -->
                        <div id="qris_section" class="hidden text-center space-y-6 mb-10">
                            <div class="bg-white p-4 rounded-3xl inline-block shadow-xl">
                                <img id="qris_code" src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=PEMBAYARAN_PBB_CIKEDUK" class="w-48 h-48" alt="QRIS Code">
                            </div>
                            <p class="text-[10px] font-black text-white/40 uppercase tracking-widest">Scan QRIS untuk membayar</p>
                        </div>

                        <button id="pay_button" class="w-full bg-primary-light hover:bg-white hover:text-primary transition-all duration-300 py-5 rounded-2xl font-black text-lg shadow-xl shadow-primary-light/20 disabled:opacity-50 disabled:cursor-not-allowed">
                            BAYAR SEKARANG
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const nopInput = document.getElementById('nop_input');
        const detailsCard = document.getElementById('details_card');
        const wpName = document.getElementById('wp_name');
        const wpAmount = document.getElementById('wp_amount');
        const summaryAmount = document.getElementById('summary_amount');
        const totalAmount = document.getElementById('total_amount');
        const qrisSection = document.getElementById('qris_section');
        const payButton = document.getElementById('pay_button');
        
        let currentPbb = null;
        let selectedMethod = null;

        // NOP Lookup
        nopInput.addEventListener('input', async (e) => {
            const nop = e.target.value;
            if (nop.length >= 10) {
                try {
                    const response = await fetch(`/pbb/lookup/${nop}`);
                    const data = await response.json();
                    
                    if (data.success) {
                        currentPbb = data;
                        wpName.textContent = data.nama;
                        wpAmount.textContent = 'Rp ' + data.formatted_tagihan;
                        summaryAmount.textContent = 'Rp ' + data.formatted_tagihan;
                        totalAmount.textContent = 'Rp ' + (data.tagihan + 2500).toLocaleString('id-ID');
                        detailsCard.classList.remove('hidden');
                        checkForm();
                    } else {
                        currentPbb = null;
                        detailsCard.classList.add('hidden');
                        checkForm();
                    }
                } catch (err) {
                    console.error('Error looking up NOP:', err);
                }
            }
        });

        // Payment Method Selection
        document.querySelectorAll('.payment-card').forEach(card => {
            card.addEventListener('click', () => {
                document.querySelectorAll('.payment-card').forEach(c => c.classList.remove('active'));
                card.classList.add('active');
                selectedMethod = card.dataset.method;
                
                if (selectedMethod === 'qris') {
                    qrisSection.classList.remove('hidden');
                } else {
                    qrisSection.classList.add('hidden');
                }
                checkForm();
            });
        });

        function checkForm() {
            payButton.disabled = !(currentPbb && selectedMethod);
        }

        payButton.addEventListener('click', () => {
            Swal.fire({
                title: 'Konfirmasi Pembayaran',
                text: `Apakah Anda yakin ingin membayar PBB atas nama ${currentPbb.nama} melalui ${selectedMethod.toUpperCase()}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1e40af',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Bayar Sekarang!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses Pembayaran...',
                        html: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Simulate payment success
                    setTimeout(() => {
                        Swal.fire({
                            title: 'Pembayaran Berhasil!',
                            text: 'Terima kasih, pembayaran PBB Anda telah kami terima.',
                            icon: 'success',
                            confirmButtonColor: '#1e40af'
                        }).then(() => {
                            window.location.href = "<?php echo e(route('landing')); ?>";
                        });
                    }, 2000);
                }
            });
        });
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\pbb-cikeduk\resources\views/landing/payment.blade.php ENDPATH**/ ?>