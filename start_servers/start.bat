@echo off
REM Change directory to the parent folder containing the project files
cd ..

echo Starting DCMS Servers...

REM Start Background Tasks (Queue and Scheduler) invisibly
echo Starting background processors silently...
wscript.exe start_background_workers.vbs

REM Open Laravel server in a new window
start "Laravel API Server" cmd /c "php artisan serve --host=0.0.0.0 --port=3000"

REM Build production assets so styles load correctly over Cloudflare
echo Building styles for external sharing...
call npm run build

echo.
echo ==============================================================================
echo All local servers are starting up! Background workers are running silently.
echo Starting Cloudflare Tunnel in this window...
echo.
echo Watch below for your "trycloudflare.com" sharing link!
echo Leave this window open to keep the tunnel active.
echo ==============================================================================
echo.

REM Run Cloudflare directly in the main window so the link shows up here
cloudflared tunnel --url http://127.0.0.1:3000