@echo off
echo ========================================
echo BOOKNEST - System Check
echo ========================================
echo.

echo Checking PHP version...
php -v
echo.

echo Checking Laravel version...
php artisan --version
echo.

echo Checking database connection...
php artisan db:show
echo.

echo Checking routes...
php artisan route:list --columns=Method,URI,Name
echo.

echo Checking middleware...
php artisan route:list | findstr "admin"
echo.

echo ========================================
echo System check completed!
echo ========================================
pause
