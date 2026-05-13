<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Pbb;

echo "NOP samples from database:\n";
$nops = Pbb::take(10)->get(['nop', 'nama_wajib_pajak']);
foreach ($nops as $pbb) {
    echo "- '{$pbb->nop}' ({$pbb->nama_wajib_pajak})\n";
}
