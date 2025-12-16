@echo off
echo ====================================
echo BOOKNEST - INSTALLER MIDDLEWARE
echo ====================================
echo.

echo [1/5] Membuat file middleware...
php create-middleware.php

if %ERRORLEVEL% NEQ 0 (
    echo.
    echo [ERROR] Gagal membuat file middleware!
    echo Pastikan Anda berada di folder booknest yang benar.
    pause
    exit /b 1
)

echo.
echo [2/5] Regenerate autoloader...
call composer dump-autoload

echo.
echo [3/5] Clear config cache...
call php artisan config:clear

echo.
echo [4/5] Clear route cache...
call php artisan route:clear

echo.
echo [5/5] Clear application cache...
call php artisan cache:clear

echo.
echo ====================================
echo INSTALASI SELESAI!
echo ====================================
echo.
echo Middleware AdminMiddleware dan UserMiddleware sudah dibuat.
echo.
echo Jalankan server dengan: php artisan serve
echo Atau gunakan: start-server.bat
echo.
echo Login Admin:
echo Email: admin@booknest.com
echo Password: admin123
echo.
pause
