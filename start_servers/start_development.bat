@echo off
setlocal
cd /d "%~dp0.."

echo =========================================
echo       Starting Development Servers         
echo =========================================

:: Ensure dependencies are present
if not exist "vendor\autoload.php" (
    echo [!] Missing vendor packages. Running composer install...
    call composer install
)
if not exist "node_modules\" (
    echo [!] Missing Node modules. Running npm install...
    call npm install
)

echo.
echo [1] Clearing Application Caches...
call php artisan optimize:clear >nul 2>&1

echo [2] Starting Laravel Server (Port 8000)...
start "Laravel [Port 8000]" cmd /k "title Laravel Server & php artisan serve --host=0.0.0.0 --port=8000"

echo [3] Starting Vite Frontend Server...
start "Vite [Frontend]" cmd /k "title Vite Server & npm run dev"

echo [4] Starting Background Workers...
if exist "start_background_workers.vbs" (
    start "Background Workers" wscript.exe start_background_workers.vbs
    echo      - Background workers started.
) else (
    echo      - Background workers script not found. Skipping.
)

echo [5] Starting Cloudflare Tunnel...
start "Cloudflare Tunnel" cmd /k "title Cloudflare Tunnel & cloudflared tunnel --url http://127.0.0.1:8000"

echo.
echo =========================================
echo   Servers successfully started!          
echo   Local URL: http://localhost:8000       
echo   Check the 'Cloudflare Tunnel' window for your public URL!
echo =========================================
echo.
pause
