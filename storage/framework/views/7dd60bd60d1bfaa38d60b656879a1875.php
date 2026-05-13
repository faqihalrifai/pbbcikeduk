<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak SPPT Online - PBB Cikeduk</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { primary: '#1e40af', 'primary-light': '#3b82f6' },
                    borderRadius: { '2xl': '1rem', '3xl': '1.5rem' },
                    boxShadow: { 'premium': '0 20px 50px -12px rgba(0, 0, 0, 0.1)' }
                }
            }
        }
    </script>
    <style> body { font-family: 'Inter', sans-serif; background: #f8fafc; } </style>
</head>
<body class="min-h-screen flex flex-col">

    <!-- Header -->
    <nav class="bg-white border-b border-slate-100 py-6">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <a href="<?php echo e(route('landing')); ?>" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center overflow-hidden border border-slate-100 shadow-sm">
                    <img src="<?php echo e(asset('logo.jpeg')); ?>" class="w-full h-full object-cover" alt="Logo">
                </div>
                <span class="font-black text-slate-900 tracking-tight uppercase text-sm">Kembali</span>
            </a>
            <h1 class="text-lg font-black text-slate-900">LAYANAN CETAK SPPT</h1>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-6 py-12">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-[2.5rem] p-10 shadow-premium border border-slate-50 text-center">
                <div class="w-20 h-20 bg-blue-50 text-primary rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-inner">
                    <i class="fas fa-file-pdf text-3xl"></i>
                </div>
                <h2 class="text-3xl font-black text-slate-900 mb-4">Cetak Dokumen SPPT</h2>
                <p class="text-slate-500 mb-10 max-w-md mx-auto">Silakan masukkan Nomor Objek Pajak (NOP) Anda untuk mengunduh atau mencetak dokumen SPPT Digital.</p>

                <div class="space-y-6 text-left mb-10">
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Nomor Objek Pajak (NOP)</label>
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1 relative">
                                <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                <input type="text" id="nop_input" placeholder="Masukkan 18 Digit NOP..." 
                                    class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 pl-14 pr-6 text-lg font-black text-slate-900 focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all">
                            </div>
                            <button id="search_button" class="bg-primary text-white px-8 py-4 rounded-2xl font-black shadow-lg shadow-primary/20 hover:bg-primary-dark transition-all active:scale-95">
                                <i class="fas fa-search mr-2"></i> CARI DATA
                            </button>
                        </div>
                        <p id="error_msg" class="hidden mt-4 text-xs font-bold text-rose-500 bg-rose-50 p-4 rounded-xl border border-rose-100">
                            <i class="fas fa-exclamation-circle mr-2"></i> Nomor Objek Pajak (NOP) tidak ditemukan. Pastikan nomor yang Anda masukkan benar.
                        </p>
                    </div>

                    <!-- Result Card -->
                    <div id="result_card" class="hidden animate-fade-in">
                        <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase mb-1">Nama Wajib Pajak</p>
                                    <p id="wp_name" class="font-black text-slate-900 text-lg">-</p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase mb-1">Tahun Pajak</p>
                                    <p id="wp_year" class="font-black text-slate-900 text-lg">-</p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-[10px] font-black text-slate-400 uppercase mb-1">Alamat Objek</p>
                                    <p id="wp_address" class="font-black text-slate-900 text-sm">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div id="action_buttons" class="hidden grid grid-cols-1 md:grid-cols-3 gap-4">
                    <button onclick="generateSppt('preview')" class="flex items-center justify-center gap-3 bg-slate-900 text-white py-4 rounded-2xl font-black text-sm shadow-xl hover:bg-slate-800 transition-all active:scale-95">
                        <i class="fas fa-eye"></i> PREVIEW
                    </button>
                    <button onclick="generateSppt('download')" class="flex items-center justify-center gap-3 bg-primary text-white py-4 rounded-2xl font-black text-sm shadow-xl shadow-primary/20 hover:bg-primary-dark transition-all active:scale-95">
                        <i class="fas fa-download"></i> DOWNLOAD
                    </button>
                    <button onclick="generateSppt('print')" class="flex items-center justify-center gap-3 bg-emerald-500 text-white py-4 rounded-2xl font-black text-sm shadow-xl shadow-emerald-500/20 hover:bg-emerald-600 transition-all active:scale-95">
                        <i class="fas fa-print"></i> CETAK
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const nopInput = document.getElementById('nop_input');
        const searchButton = document.getElementById('search_button');
        const errorMsg = document.getElementById('error_msg');
        const resultCard = document.getElementById('result_card');
        const actionButtons = document.getElementById('action_buttons');
        const wpName = document.getElementById('wp_name');
        const wpYear = document.getElementById('wp_year');
        const wpAddress = document.getElementById('wp_address');

        searchButton.addEventListener('click', async () => {
            const nop = nopInput.value;
            if (nop.length < 5) return;

            searchButton.disabled = true;
            searchButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> MENCARI...';

            try {
                const response = await fetch(`/pbb/lookup/${nop}`);
                const data = await response.json();
                
                if (data.success) {
                    wpName.textContent = data.nama;
                    wpYear.textContent = data.tahun;
                    wpAddress.textContent = data.alamat;
                    resultCard.classList.remove('hidden');
                    actionButtons.classList.remove('hidden');
                    errorMsg.classList.add('hidden');
                } else {
                    resultCard.classList.add('hidden');
                    actionButtons.classList.add('hidden');
                    errorMsg.classList.remove('hidden');
                }
            } catch (err) { 
                console.error(err);
            } finally {
                searchButton.disabled = false;
                searchButton.innerHTML = '<i class="fas fa-search mr-2"></i> CARI DATA';
            }
        });

        // Trigger search on Enter key
        nopInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') searchButton.click();
        });

        function generateSppt(action) {
            const nop = nopInput.value;
            const url = `<?php echo e(route('landing.sppt.generate')); ?>?nop=${nop}&action=${action}`;
            
            if (action === 'download') {
                window.location.href = url;
            } else {
                window.open(url, '_blank');
            }
        }
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\pbb-cikeduk\resources\views/landing/sppt.blade.php ENDPATH**/ ?>