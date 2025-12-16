@echo off
echo ========================================
echo MEMPERBAIKI KOLOM ISI_BUKU
echo ========================================
echo.

echo [1/3] Menjalankan migration untuk memperbesar kolom isi_buku...
php artisan migrate

echo.
echo [2/3] Membersihkan cache...
php artisan cache:clear
php artisan config:clear

echo.
echo [3/3] Selesai!
echo.
echo Kolom isi_buku sekarang sudah bisa menampung teks buku yang sangat panjang
echo Silakan coba update buku lagi
echo.
pause
