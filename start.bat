@echo off
echo Starting DCMS Servers...

REM Start Background Tasks (Queue and Scheduler) invisibly
echo Starting background processors silently...
wscript.exe start_background_workers.vbs

REM Open Laravel server in a new window
start "Laravel API Server" cmd /c "php artisan serve --port=3000"

REM Open Vite server in a new window
start "Vite Frontend Server" cmd /c "npm run dev"

echo Both servers are starting up! Background workers are running silently.
echo You can close this window.
exit