<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-favicon.png') }}">

    <title>{{ config('app.name', 'DCMS') }} - Super Admin Portal</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Inter', sans-serif; }

        .sa-wrapper {
            height: 100vh;
            display: flex;
            background: #0f172a;
            position: relative;
            overflow: hidden;
        }

        /* Animated background pattern */
        .sa-wrapper::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(ellipse at 20% 50%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(234, 179, 8, 0.1) 0%, transparent 50%),
                radial-gradient(ellipse at 60% 80%, rgba(99, 102, 241, 0.08) 0%, transparent 50%);
            pointer-events: none;
            animation: bg-shift 8s ease-in-out infinite alternate;
        }
        @keyframes bg-shift {
            0%   { opacity: 0.7; }
            100% { opacity: 1; }
        }

        /* Grid pattern overlay */
        .sa-wrapper::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 50px 50px;
            pointer-events: none;
        }

        .sa-left {
            flex: 1.2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 4rem;
            position: relative;
            z-index: 1;
        }

        .sa-shield {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #eab308 0%, #ca8a04 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            box-shadow: 0 20px 40px rgba(234, 179, 8, 0.2);
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        .sa-shield i {
            font-size: 2.5rem;
            color: #0f172a;
        }

        .sa-left h1 {
            color: #f8fafc;
            font-size: 2.5rem;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            text-align: center;
            margin: 0 0 0.75rem 0;
        }
        .sa-left .sa-subtitle {
            color: #eab308;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 1.5rem;
        }
        .sa-left p {
            color: #94a3b8;
            font-size: 1.05rem;
            text-align: center;
            max-width: 380px;
            line-height: 1.7;
        }

        .sa-features {
            margin-top: 2.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .sa-feature {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #cbd5e1;
            font-size: 0.9rem;
        }
        .sa-feature i {
            color: #eab308;
            font-size: 0.85rem;
            width: 20px;
            text-align: center;
        }

        .sa-right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        .sa-card {
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(148, 163, 184, 0.1);
            padding: 2rem;
            border-radius: 16px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            animation: card-in 0.5s ease-out;
        }
        @keyframes card-in {
            from { opacity: 0; transform: translateY(30px) scale(0.98); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .sa-card-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .sa-card-header .sa-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(234, 179, 8, 0.1);
            border: 1px solid rgba(234, 179, 8, 0.2);
            color: #eab308;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            margin-bottom: 1.25rem;
        }
        .sa-card-header h2 {
            color: #f1f5f9;
            font-size: 1.6rem;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            margin: 0 0 0.4rem 0;
        }
        .sa-card-header p {
            color: #64748b;
            font-size: 0.85rem;
            margin: 0;
        }

        .sa-form-group {
            margin-bottom: 1.25rem;
        }
        .sa-form-group label {
            display: block;
            font-weight: 500;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
            color: #cbd5e1;
        }
        .sa-input-wrap {
            position: relative;
        }
        .sa-input-wrap .sa-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #475569;
            font-size: 0.9rem;
            pointer-events: none;
            transition: color 0.2s;
        }
        .sa-input {
            width: 100%;
            padding: 0.8rem 0.8rem 0.8rem 2.8rem;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(148, 163, 184, 0.15);
            border-radius: 10px;
            color: #f1f5f9;
            font-size: 0.95rem;
            outline: none;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
        }
        .sa-input:focus {
            border-color: rgba(234, 179, 8, 0.5);
            box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.08);
            background: rgba(15, 23, 42, 0.8);
        }
        .sa-input:focus + .sa-icon,
        .sa-input:focus ~ .sa-icon {
            color: #eab308;
        }
        .sa-input::placeholder {
            color: #475569;
        }

        .sa-input-wrap .sa-toggle-pw {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #475569;
            cursor: pointer;
            transition: color 0.2s;
            background: none;
            border: none;
            padding: 0;
            font-size: 0.9rem;
        }
        .sa-input-wrap .sa-toggle-pw:hover {
            color: #eab308;
        }

        .sa-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .sa-remember {
            display: flex;
            align-items: center;
            cursor: pointer;
            gap: 0.5rem;
        }
        .sa-remember input[type="checkbox"] {
            width: 1rem;
            height: 1rem;
            border-radius: 4px;
            accent-color: #eab308;
        }
        .sa-remember span {
            font-size: 0.85rem;
            color: #94a3b8;
        }
        .sa-forgot {
            font-size: 0.85rem;
            color: #eab308;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        .sa-forgot:hover {
            color: #facc15;
        }

        .sa-btn {
            width: 100%;
            background: linear-gradient(135deg, #eab308 0%, #ca8a04 100%);
            color: #0f172a;
            padding: 0.85rem;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-family: 'Outfit', sans-serif;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(234, 179, 8, 0.25);
        }
        .sa-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(234, 179, 8, 0.35);
        }
        .sa-btn:active {
            transform: translateY(0px);
            box-shadow: 0 2px 8px rgba(234, 179, 8, 0.2);
        }

        .sa-footer {
            text-align: center;
            margin-top: 1.5rem;
        }
        .sa-footer a {
            color: #64748b;
            font-size: 0.82rem;
            text-decoration: none;
            transition: color 0.2s;
        }
        .sa-footer a:hover {
            color: #94a3b8;
        }

        .sa-error {
            color: #f87171;
            font-size: 0.8rem;
            margin-top: 0.5rem;
            font-weight: 500;
        }
        .sa-session-status {
            margin-bottom: 1.5rem;
            background: rgba(234, 179, 8, 0.1);
            border: 1px solid rgba(234, 179, 8, 0.2);
            color: #eab308;
            padding: 0.75rem;
            border-radius: 8px;
            font-size: 0.85rem;
        }

        /* Mobile */
        .sa-mobile-header { display: none; }
        @media (max-width: 900px) {
            .sa-left { display: none; }
            .sa-wrapper { 
                justify-content: center; 
                align-items: center; 
                padding: 1rem; 
                height: auto; 
                min-height: 100vh; 
                overflow-y: auto; 
            }
            .sa-mobile-header {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-bottom: 1.5rem;
            }
            .sa-mobile-shield {
                width: 60px;
                height: 60px;
                background: linear-gradient(135deg, #eab308 0%, #ca8a04 100%);
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1rem;
            }
            .sa-mobile-shield i { font-size: 1.5rem; color: #0f172a; }
        }
    </style>
</head>
<body class="antialiased">
    <div class="sa-wrapper">
        {{-- Left Panel --}}
        <div class="sa-left">
            <div class="sa-shield">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div class="sa-subtitle">Super Admin</div>
            <h1>System Control</h1>
            <p>Highest-level administrative access for system configuration, user management, and departmental settings.</p>

            <div class="sa-features">
                <div class="sa-feature"><i class="fa-solid fa-users-gear"></i> Full User & Role Management</div>
                <div class="sa-feature"><i class="fa-solid fa-sliders"></i> Department Settings Control</div>
                <div class="sa-feature"><i class="fa-solid fa-database"></i> Database Backup & Restore</div>
                <div class="sa-feature"><i class="fa-solid fa-chart-line"></i> Advanced Analytics Access</div>
            </div>
        </div>

        {{-- Right Panel - Login Card --}}
        <div class="sa-right">
            <div data-aos="fade-up" class="sa-card">
                {{-- Mobile header --}}
                <div class="sa-mobile-header">
                    <div class="sa-mobile-shield"><i class="fa-solid fa-shield-halved"></i></div>
                </div>

                <div class="sa-card-header">
                    <div class="sa-badge"><i class="fa-solid fa-lock"></i> Restricted Access</div>
                    <h2>Super Admin Login</h2>
                    <p>This portal is for super administrators only</p>
                </div>

                @if (session('status'))
                    <div class="sa-session-status">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('super-admin.login', [], false) }}">
                    @csrf

                    {{-- Email --}}
                    <div class="sa-form-group">
                        <label for="email">Email Address</label>
                        <div class="sa-input-wrap">
                            <input id="email" class="sa-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="admin@example.com">
                            <span class="sa-icon"><i class="fa-solid fa-envelope"></i></span>
                        </div>
                        @if ($errors->has('email'))
                            <div class="sa-error">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    {{-- Password --}}
                    <div class="sa-form-group">
                        <label for="password">Password</label>
                        <div class="sa-input-wrap">
                            <input id="password" class="sa-input" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password" style="padding-right: 2.8rem;">
                            <span class="sa-icon"><i class="fa-solid fa-lock"></i></span>
                            <button type="button" class="sa-toggle-pw" onclick="const p=document.getElementById('password'); const i=this.querySelector('i'); if(p.type==='password'){p.type='text';i.classList.remove('fa-eye');i.classList.add('fa-eye-slash');}else{p.type='password';i.classList.remove('fa-eye-slash');i.classList.add('fa-eye');}">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                        @if ($errors->has('password'))
                            <div class="sa-error">{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                    {{-- Remember + Forgot --}}
                    <div class="sa-row">
                        <label class="sa-remember">
                            <input type="checkbox" name="remember">
                            <span>Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="sa-forgot" href="{{ route('password.request') }}">Forgot password?</a>
                        @endif
                    </div>

                    <button type="submit" class="sa-btn">
                        <i class="fa-solid fa-shield-halved"></i> Authenticate
                    </button>

                    {{-- Dev/super-admin credentials hint (remove before production) --}}
                    @if(app()->environment('local') || config('app.debug'))
                    <div style="background: linear-gradient(135deg, #1e293b, #0f172a); border: 1px solid rgba(234,179,8,0.3); border-radius: 10px; padding: 1rem 1.25rem; margin-top: 1.25rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.6rem;">
                            <div style="width: 22px; height: 22px; background: #eab308; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-code" style="font-size: 0.65rem; color: #0f172a;"></i>
                            </div>
                            <span style="font-size: 0.8rem; font-weight: 700; color: #eab308; text-transform: uppercase; letter-spacing: 0.5px;">Dev Credentials</span>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 0.3rem; font-size: 0.82rem; font-family: 'Courier New', monospace;">
                            <div style="display: flex; justify-content: space-between;">
                                <span style="color: #94a3b8;">Email:</span>
                                <span style="color: #f8fafc; font-weight: 600;">superadmin@cmpnsuk.edu.ng</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span style="color: #94a3b8;">Password:</span>
                                <span style="color: #f8fafc; font-weight: 600;">12345678</span>
                            </div>
                        </div>
                        <button type="button"
                            onclick="(function(){const e=document.getElementById('email')||document.querySelector('input[name=email]'); const p=document.getElementById('password')||document.querySelector('input[name=password]'); if(e){e.value='superadmin@cmpnsuk.edu.ng'; e.dispatchEvent(new Event('input',{bubbles:true}));} if(p){p.value='12345678'; p.dispatchEvent(new Event('input',{bubbles:true}));} const f=document.forms[0]; if(f){f.submit();}})();"
                            style="margin-top: 0.75rem; width: 100%; padding: 0.45rem; background: #eab308; color: #0f172a; border: none; border-radius: 6px; font-size: 0.78rem; font-weight: 700; cursor: pointer; transition: background 0.2s;"
                            onmouseover="this.style.background='#ca8a04'" onmouseout="this.style.background='#eab308'"><i class="fa-solid fa-bolt" style="margin-right: 4px;"></i> Auto-fill & Login</button>
                    </div>
                    @endif
                </form>

                <div class="sa-footer">
                    <a href="{{ route('login') }}"><i class="fa-solid fa-arrow-left" style="margin-right: 4px;"></i> Back to Admin Login</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
