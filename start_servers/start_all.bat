@echo off
echo Starting both Laravel and Vite Servers...
cd ..
start "Laravel Server" cmd /k "php artisan serve --port=3000"
start "Vite Server" cmd /k "npm run dev"

echo Starting background queue and scheduler silently...
wscript.exe start_background_workers.vbs

echo Servers started in separate windows and background tasks are running!
pause
