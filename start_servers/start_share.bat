@echo off
setlocal
cd /d "%~dp0.."

echo =========================================
echo       Starting Public Sharing Mode         
echo =========================================

echo.
echo [1] Compiling CSS and Javascript (Making styles visible to others)...
call npm run build

echo [2] Clearing Application Caches...
call php artisan optimize:clear >nul 2>&1

echo [3] Starting Laravel Server (Port 8000)...
start "Laravel [Port 8000]" cmd /k "title Laravel Server & php artisan serve --host=0.0.0.0 --port=8000"

echo [4] Starting Background Workers...
if exist "start_background_workers.vbs" (
    start "Background Workers" wscript.exe start_background_workers.vbs
)

echo [5] Starting ngrok Tunnel...
start "ngrok Tunnel" cmd /k "title ngrok Tunnel & ngrok http 8000"

echo.
echo =========================================
echo   Sharing Servers successfully started!  
echo   Your styles are now compiled.          
echo   Check the 'ngrok Tunnel' window        
echo   for your public URL to share!          
echo =========================================
echo.
pause
