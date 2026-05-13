<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Kolektor;

echo "Users:\n";
print_r(User::all(['id', 'name', 'email', 'role'])->toArray());

echo "\nCollectors:\n";
print_r(Kolektor::all()->toArray());
