<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PbbController;
use App\Http\Controllers\CollectorController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\BalikNamaController;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Kolektor;

Route::get('/fix-collector', function() {
    $user = User::updateOrCreate(
        ['email' => 'kolektordesa@gmail.com'],
        [
            'name' => 'Kolektor Desa',
            'password' => Hash::make('koletorcikeduk'),
            'role' => 'kolektor'
        ]
    );
    
    Kolektor::updateOrCreate(
        ['nama' => 'Kolektor Desa'],
        ['wilayah' => 'Cikeduk Pusat', 'no_hp' => '08123456789']
    );
    
    return "User kolektordesa@gmail.com berhasil dibuat/diperbarui dengan password 'koletorcikeduk' dan role 'kolektor'. Silakan login kembali.";
});

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::post('/cek-tagihan', [LandingController::class, 'cekTagihan'])->name('landing.cek');
Route::get('/pembayaran', [LandingController::class, 'paymentPage'])->name('landing.payment');
Route::get('/pbb/lookup/{nop}', [LandingController::class, 'lookupNop'])->name('pbb.lookup');
Route::get('/sppt', [LandingController::class, 'spptPage'])->name('landing.sppt');
Route::get('/sppt/generate', [LandingController::class, 'generateSppt'])->name('landing.sppt.generate');
Route::get('/informasi', [LandingController::class, 'informasiPage'])->name('landing.informasi');
Route::get('/riwayat', [LandingController::class, 'historyPage'])->name('landing.history');
Route::get('/pengaduan', [LandingController::class, 'complaintPage'])->name('landing.complaint');
Route::post('/pengaduan', [LandingController::class, 'storeComplaint'])->name('landing.complaint.store');

Route::get('/balik-nama', [LandingController::class, 'balikNamaPage'])->name('landing.balik_nama');
Route::post('/balik-nama', [LandingController::class, 'storeBalikNama'])->name('landing.balik_nama.store');

Route::get('/run-migration', function() {
    try {
        $msg = "";
        // Add metode_pembayaran
        if (!\Illuminate\Support\Facades\Schema::hasColumn('pembayarans', 'metode_pembayaran')) {
            \Illuminate\Support\Facades\Schema::table('pembayarans', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->string('metode_pembayaran')->nullable();
            });
            \Illuminate\Support\Facades\DB::table('pembayarans')->update(['metode_pembayaran' => 'Kolektor']);
            $msg .= "Added metode_pembayaran. ";
        }

        // Create complaints table
        if (!\Illuminate\Support\Facades\Schema::hasTable('complaints')) {
            \Illuminate\Support\Facades\Schema::create('complaints', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->string('no_hp');
                $table->string('judul');
                $table->text('isi');
                $table->string('status')->default('Menunggu');
                $table->timestamps();
            });
            $msg .= "Created complaints table. ";
        }

        return $msg ?: "Everything up to date.";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::get('/kolektor/login', [AuthController::class, 'showLoginForm'])->name('kolektor.login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function() {
        $user = auth()->user();
        if ($user->role === 'kolektor') {
            return redirect()->route('kolektor.dashboard');
        }
        return redirect()->route('dashboard'); // This is the named route for /admin/dashboard
    });

    // Admin & Petugas Routes
    Route::middleware('role:admin,petugas')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::get('pbbs/export', [PbbController::class, 'export'])->name('pbbs.export');
        Route::post('pbbs/import', [PbbController::class, 'import'])->name('pbbs.import');
        Route::resource('pbbs', PbbController::class)->except(['create', 'show']);
    });
    
    // Admin Only Routes
    Route::middleware('role:admin')->group(function () {
        Route::resource('collectors', CollectorController::class);
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

        Route::get('/admin/balik-nama', [BalikNamaController::class, 'index'])->name('admin.balik_nama.index');
        Route::get('/admin/balik-nama/{balikNama}', [BalikNamaController::class, 'show'])->name('admin.balik_nama.show');
        Route::patch('/admin/balik-nama/{balikNama}', [BalikNamaController::class, 'updateStatus'])->name('admin.balik_nama.update');
        Route::get('/admin/balik-nama/{balikNama}/download/{type}', [BalikNamaController::class, 'download'])->name('admin.balik_nama.download');
    });
    
    // Kolektor Dashboard
    Route::middleware('role:kolektor')->group(function () {
        Route::get('/kolektor/dashboard', [DashboardController::class, 'collectorIndex'])->name('kolektor.dashboard');
    });
    
    // Shared Payment & Report Routes
    Route::middleware('role:admin,petugas,kolektor')->group(function () {
        Route::resource('payments', PaymentController::class)->except(['edit', 'update', 'destroy']);
        Route::get('/payments/{payment}/print', [PaymentController::class, 'print'])->name('payments.print');
        Route::get('/laporan', [DashboardController::class, 'reportIndex'])->name('reports.index');
    });
});

Route::get('/debug-import', function() {
    $source = getenv('USERPROFILE') . '\\Downloads\\data-pbb.xlsx';
    $dest = storage_path('app/data-pbb.xlsx');
    
    if (file_exists($source)) {
        copy($source, $dest);
        echo "File copied from Downloads to storage/app.<br>";
    } else {
        echo "Source file not found in $source. Assuming it's already in storage/app.<br>";
    }

    if (!file_exists($dest)) {
        return "File data-pbb.xlsx tidak ditemukan di storage/app!";
    }

    try {
        $import = new \App\Imports\PbbImport();
        \Maatwebsite\Excel\Facades\Excel::import($import, storage_path('app/data-pbb.xlsx'));
        $count = \App\Models\Pbb::count();
        echo "Import Selesai!<br>";
        echo "Success Count: " . $import->successCount . "<br>";
        echo "Failed Count: " . $import->failedCount . "<br>";
        echo "Total data di tabel pbbs: " . $count . "<br>";
        if (!empty($import->errors)) {
            echo "Errors:<br><pre>";
            print_r($import->errors);
            echo "</pre>";
        }
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage() . "<br>";
        echo "Trace: <pre>" . $e->getTraceAsString() . "</pre>";
    }
});
