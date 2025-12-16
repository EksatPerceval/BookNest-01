<?php

/**
 * Script untuk membuat file middleware AdminMiddleware dan UserMiddleware
 * Jalankan: php create-middleware.php
 */

$adminMiddleware = <<<'PHP'
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Anda bukan admin.');
        }

        return $next($request);
    }
}
PHP;

$userMiddleware = <<<'PHP'
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
PHP;

echo "====================================\n";
echo "BOOKNEST - MIDDLEWARE CREATOR\n";
echo "====================================\n\n";

// Cek apakah folder middleware ada
$middlewarePath = __DIR__ . '/app/Http/Middleware';

if (!is_dir($middlewarePath)) {
    echo "[ERROR] Folder app/Http/Middleware tidak ditemukan!\n";
    echo "Pastikan Anda menjalankan script ini dari root folder booknest.\n\n";
    echo "Lokasi saat ini: " . __DIR__ . "\n";
    exit(1);
}

// Buat AdminMiddleware.php
$adminFile = $middlewarePath . '/AdminMiddleware.php';
if (file_put_contents($adminFile, $adminMiddleware)) {
    echo "[✓] AdminMiddleware.php berhasil dibuat!\n";
} else {
    echo "[✗] Gagal membuat AdminMiddleware.php\n";
}

// Buat UserMiddleware.php
$userFile = $middlewarePath . '/UserMiddleware.php';
if (file_put_contents($userFile, $userMiddleware)) {
    echo "[✓] UserMiddleware.php berhasil dibuat!\n";
} else {
    echo "[✗] Gagal membuat UserMiddleware.php\n";
}

echo "\n====================================\n";
echo "FILE MIDDLEWARE BERHASIL DIBUAT!\n";
echo "====================================\n\n";

echo "Langkah selanjutnya:\n";
echo "1. Jalankan: composer dump-autoload\n";
echo "2. Jalankan: php artisan config:clear\n";
echo "3. Jalankan: php artisan route:clear\n";
echo "4. Jalankan: php artisan serve\n\n";

echo "Login admin:\n";
echo "Email: admin@booknest.com\n";
echo "Password: admin123\n\n";
