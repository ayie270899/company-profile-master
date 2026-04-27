<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$tableName = 'contact_messages';

if (Schema::hasTable($tableName)) {
    echo "TABLE EXISTS: $tableName\n";
    $columns = Schema::getColumnListing($tableName);
    echo "COLUMNS: " . implode(', ', $columns) . "\n";
} else {
    echo "TABLE MISSING: $tableName\n";
}
