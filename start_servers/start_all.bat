@echo off
echo Starting both Laravel and Vite Servers...
cd ..
start "Laravel Server" cmd /k "php artisan serve --port=3000"
start "Vite Server" cmd /k "npm run dev"
echo Servers started in separate windows!
pause
