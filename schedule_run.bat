@echo off
cd C:\laragon\www\web-fisme
php artisan schedule:run >> storage\logs\scheduler.log 2>&1
