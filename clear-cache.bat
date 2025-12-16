@echo off
echo ========================================
echo BOOKNEST - Clear Cache & Fix Errors
echo ========================================
echo.

echo [1/5] Clearing application cache...
php artisan cache:clear

echo [2/5] Clearing config cache...
php artisan config:clear

echo [3/5] Clearing route cache...
php artisan route:clear

echo [4/5] Clearing view cache...
php artisan view:clear

echo [5/5] Optimizing autoloader...
composer dump-autoload

echo.
echo ========================================
echo Cache cleared successfully!
echo ========================================
echo.
echo You can now run: php artisan serve
echo.
pause
