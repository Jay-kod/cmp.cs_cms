@echo off
cd /d "%~dp0.."
echo Starting both Laravel and Vite Servers...
start "Laravel Server" cmd /k "php artisan serve --port=8000"
start "Vite Server" cmd /k "npm run dev"

echo Starting background queue and scheduler silently...
start "Background Workers" wscript.exe start_background_workers.vbs

echo Servers started in separate windows and background tasks are running!
pause
