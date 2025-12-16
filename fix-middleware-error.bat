@echo off
echo ========================================
echo BOOKNEST - Fix Middleware Error
echo ========================================
echo.

echo [1/6] Stopping any running server...
taskkill /F /IM php.exe 2>nul

echo [2/6] Clearing all caches...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo [3/6] Clearing compiled files...
del /F /Q bootstrap\cache\*.php 2>nul

echo [4/6] Regenerating autoload...
composer dump-autoload

echo [5/6] Optimizing Laravel...
php artisan optimize:clear

echo [6/6] Starting server...
echo.
echo ========================================
echo All fixed! Starting BookNest...
echo ========================================
echo.
echo Open browser: http://localhost:8000
echo.
echo Login Admin:
echo Email: admin@booknest.com
echo Password: admin123
echo.

php artisan serve
