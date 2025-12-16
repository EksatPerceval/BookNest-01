@echo off
echo ========================================
echo   BOOKNEST - Fix dan Start Aplikasi
echo ========================================
echo.

echo [1/6] Stopping existing server...
taskkill /F /IM php.exe 2>nul
timeout /t 2 /nobreak >nul

echo [2/6] Clearing all Laravel cache...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan clear-compiled

echo [3/6] Regenerating autoloader...
composer dump-autoload -o

echo [4/6] Optimizing application...
php artisan optimize:clear
php artisan config:cache
php artisan route:cache

echo [5/6] Verifying middleware registration...
php artisan route:list | findstr "admin"

echo.
echo [6/6] Starting server...
echo ========================================
echo   Server running at: http://localhost:8000
echo   Press Ctrl+C to stop
echo ========================================
echo.
echo Login Admin:
echo   Email: admin@booknest.com
echo   Password: admin123
echo.
echo Login User:
echo   Email: user@booknest.com
echo   Password: user123
echo.

php artisan serve
