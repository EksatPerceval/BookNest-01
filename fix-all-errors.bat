@echo off
echo ================================================
echo    BOOKNEST - FIX ALL ERRORS
echo ================================================
echo.

cd /d "%~dp0"

echo [1/6] Menghentikan server yang berjalan...
taskkill /F /IM php.exe 2>nul
timeout /t 2 /nobreak >nul

echo [2/6] Membersihkan semua cache Laravel...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo [3/6] Regenerating composer autoload...
composer dump-autoload

echo [4/6] Clearing bootstrap cache...
if exist bootstrap\cache\config.php del bootstrap\cache\config.php
if exist bootstrap\cache\routes-v7.php del bootstrap\cache\routes-v7.php
if exist bootstrap\cache\packages.php del bootstrap\cache\packages.php
if exist bootstrap\cache\services.php del bootstrap\cache\services.php

echo [5/6] Optimizing application...
php artisan optimize:clear

echo [6/6] Memulai server Laravel...
echo.
echo ================================================
echo    Server siap di: http://localhost:8000
echo    Login Admin:
echo    Email: admin@booknest.com
echo    Password: admin123
echo ================================================
echo.

php artisan serve
