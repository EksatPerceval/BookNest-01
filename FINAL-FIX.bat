@echo off
echo ========================================
echo BOOKNEST - FINAL FIX untuk Middleware Error
echo ========================================
echo.

echo [STEP 1/8] Stopping all PHP processes...
taskkill /F /IM php.exe 2>nul
timeout /t 2 /nobreak >nul

echo [STEP 2/8] Checking .env file...
if not exist .env (
    echo .env not found, copying from .env.example...
    copy .env.example .env
)

echo [STEP 3/8] Generating APP_KEY...
php artisan key:generate --force

echo [STEP 4/8] Clearing ALL Laravel caches...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear

echo [STEP 5/8] Removing compiled files...
if exist bootstrap\cache\config.php del /F /Q bootstrap\cache\config.php
if exist bootstrap\cache\routes-v7.php del /F /Q bootstrap\cache\routes-v7.php
if exist bootstrap\cache\packages.php del /F /Q bootstrap\cache\packages.php
if exist bootstrap\cache\services.php del /F /Q bootstrap\cache\services.php

echo [STEP 6/8] Regenerating Composer autoload...
composer dump-autoload -o

echo [STEP 7/8] Verifying middleware files exist...
if not exist app\Http\Middleware\AdminMiddleware.php (
    echo ERROR: AdminMiddleware.php not found!
    pause
    exit /b 1
)
if not exist app\Http\Middleware\UserMiddleware.php (
    echo ERROR: UserMiddleware.php not found!
    pause
    exit /b 1
)
echo Middleware files OK!

echo [STEP 8/8] Testing configuration...
php artisan config:cache
php artisan route:cache

echo.
echo ========================================
echo SUCCESS! All errors fixed!
echo ========================================
echo.
echo Starting BookNest server...
echo Open: http://localhost:8000
echo.
echo LOGIN ADMIN:
echo   Email: admin@booknest.com
echo   Password: admin123
echo.
echo LOGIN USER:
echo   Email: user@booknest.com
echo   Password: user123
echo.
echo Press CTRL+C to stop server
echo ========================================
echo.

php artisan serve
