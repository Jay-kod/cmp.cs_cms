<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{ asset('images/logo-favicon.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/logo-favicon.png') }}">

        <title>{{ config('app.name', 'DCMS') }} - Admin Portal</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --color-primary-guest: #16a34a; /* Provide fallback since this page doesn't have the global dynamic colors block */
                --color-secondary-guest: #15803d;
            }
            body {
                margin: 0;
            }
            .login-wrapper {
                height: 100vh;
                display: flex;
                background-color: #f3f4f6;
                background-image: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
                overflow: hidden;
            }
            .login-left {
                flex: 1.2;
                background: linear-gradient(135deg, var(--color-primary, var(--color-primary-guest)) 0%, var(--color-secondary, var(--color-secondary-guest)) 100%);
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                color: white;
                padding: 4rem;
                position: relative;
                overflow: hidden;
            }
            .login-left::before {
                content: '';
                position: absolute;
                inset: 0;
                background-image: radial-gradient(circle at 20% 80%, rgba(255,255,255,0.1) 0%, transparent 40%),
                                  radial-gradient(circle at 80% 20%, rgba(0,0,0,0.1) 0%, transparent 40%);
                pointer-events: none;
            }
            .login-right {
                flex: 1;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 2rem;
            }
            .login-card {
                background: white;
                padding: 2rem;
                border-radius: 12px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.05);
                width: 100%;
                max-width: 450px;
                animation: slide-up 0.4s ease-out;
            }
            @keyframes slide-up {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            @media (max-width: 900px) {
                .login-left { display: none; }
                .login-wrapper { 
                    justify-content: center; 
                    align-items: center; 
                    padding: 1rem; 
                    height: auto; 
                    min-height: 100vh; 
                    overflow-y: auto; 
                }
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="login-wrapper">
            <div class="login-left">
                <x-application-logo style="margin-bottom: 2rem;" />
                <h1 style="color: white; font-size: 2.5rem; text-align: center; margin-bottom: 1rem;">Departmental CMS</h1>
                <p style="text-align: center; font-size: 1.1rem; opacity: 0.9; max-width: 400px; line-height: 1.6;">Secure administrative portal for managing departmental content, staff profiles, news, and academic information.</p>
            </div>
            
            <div class="login-right">
                <div class="login-card">
                    <div style="text-align: center; margin-bottom: 2rem; display: none;" class="mobile-logo">
                        <x-application-logo />
                    </div>
                    {{ $slot }}
                </div>
            </div>
        </div>
        <style>
            @media (max-width: 900px) {
                .mobile-logo { display: block !important; }
            }
        </style>
    </body>
</html>
