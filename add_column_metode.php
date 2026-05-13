<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

try {
    if (!Schema::hasColumn('pembayarans', 'metode_pembayaran')) {
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->string('metode_pembayaran')->nullable()->after('bukti_bayar');
        });
        echo "Column 'metode_pembayaran' added successfully.\n";
    } else {
        echo "Column 'metode_pembayaran' already exists.\n";
    }
    
    // Set default value for existing rows
    DB::table('pembayarans')->whereNull('metode_pembayaran')->update(['metode_pembayaran' => 'Kolektor']);
    echo "Default values set for existing rows.\n";

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
