<?php
// Prevent unauthorized access by checking a simple query parameter
if (!isset($_GET['key']) || $_GET['key'] !== 'elmalak') {
    die('Unauthorized access.');
}

// Bootstrap Laravel console kernel
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

use Illuminate\Contracts\Console\Kernel;
$kernel = $app->make(Kernel::class);

// Run optimize:clear
$status = $kernel->call('optimize:clear');

echo "<div style='font-family: sans-serif; padding: 20px; background: #0f172a; color: #f8fafc; border-radius: 10px; max-width: 600px; margin: 40px auto; border: 1px solid #334155;'>";
echo "<h1 style='color: #10b981; margin-top: 0;'>Laravel Cache Cleared!</h1>";
echo "<p>Artisan command <code>optimize:clear</code> completed with exit status: <strong>" . $status . "</strong></p>";
echo "<p style='color: #94a3b8; font-size: 14px;'>All route caches, configuration caches, compiled views, and application caches have been successfully reset.</p>";
echo "<p style='color: #f59e0b; font-size: 14px; font-weight: bold;'>⚠️ Please delete this file (public/clear.php) after verifying your website to keep it secure.</p>";
echo "</div>";
