<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #0f172a;
            color: #e2e8f0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* ── Background Orbs ── */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            pointer-events: none;
            z-index: 0;
        }
        .orb-1 { width: 600px; height: 600px; background: rgba(16,185,129,0.1); top: -20%; right: -10%; }
        .orb-2 { width: 500px; height: 500px; background: rgba(59,130,246,0.08); bottom: -20%; left: -10%; }
        .orb-3 { width: 300px; height: 300px; background: rgba(168,85,247,0.06); top: 50%; left: 50%; transform: translate(-50%, -50%); }

        .texture {
            position: absolute;
            inset: 0;
            background-image: url('https://www.transparenttextures.com/patterns/cubes.png');
            opacity: 0.04;
            pointer-events: none;
        }

        /* ── Main Content ── */
        .error-wrap {
            position: relative;
            z-index: 10;
            text-align: center;
            padding: 2rem;
            max-width: 700px;
        }

        /* ── Jumpy 404 Digits ── */
        .digits {
            display: inline-flex;
            gap: 0.15em;
            margin-bottom: 1.5rem;
        }
        .digit {
            font-size: clamp(7rem, 18vw, 14rem);
            font-weight: 900;
            line-height: 1;
            letter-spacing: -0.04em;
            background: linear-gradient(135deg, #34d399, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: bounce-digit 2s ease-in-out infinite;
            cursor: default;
            transition: filter 0.3s;
            text-shadow: 0 0 60px rgba(16,185,129,0.25);
        }
        .digit:hover {
            filter: brightness(1.3);
            animation-play-state: paused;
        }
        .digit:nth-child(1) { animation-delay: 0s; }
        .digit:nth-child(2) { animation-delay: 0.25s; }
        .digit:nth-child(3) { animation-delay: 0.5s; }

        @keyframes bounce-digit {
            0%, 100% { transform: translateY(0) scale(1); }
            30% { transform: translateY(-28px) scale(1.05); }
            50% { transform: translateY(0) scale(0.98); }
            65% { transform: translateY(-10px) scale(1.02); }
            80% { transform: translateY(0) scale(1); }
        }

        /* ── Glow ring behind digits ── */
        .glow-ring {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -60%);
            width: 420px;
            height: 420px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(16,185,129,0.08) 0%, transparent 70%);
            pointer-events: none;
            animation: pulse-glow 4s ease-in-out infinite;
        }
        @keyframes pulse-glow {
            0%, 100% { transform: translate(-50%, -60%) scale(1); opacity: 0.6; }
            50% { transform: translate(-50%, -60%) scale(1.15); opacity: 1; }
        }

        .subtitle {
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            font-weight: 800;
            color: #fff;
            margin-bottom: 0.75rem;
            letter-spacing: -0.02em;
        }
        .description {
            font-size: 1.15rem;
            color: #94a3b8;
            line-height: 1.7;
            max-width: 520px;
            margin: 0 auto 2.5rem;
        }

        /* ── Jumpy Buttons ── */
        .btn-row {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            border-radius: 999px;
            font-weight: 700;
            font-size: 1.05rem;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }
        .btn-primary {
            background: #10b981;
            color: #0f172a;
            box-shadow: 0 0 25px rgba(16,185,129,0.35);
            animation: bounce-btn 2.5s ease-in-out infinite;
        }
        .btn-primary:hover {
            background: #34d399;
            box-shadow: 0 0 40px rgba(16,185,129,0.55);
            transform: translateY(-4px) scale(1.05) !important;
        }
        .btn-secondary {
            background: rgba(30,41,59,0.8);
            color: #e2e8f0;
            border: 1px solid #334155;
            backdrop-filter: blur(10px);
            animation: bounce-btn 2.5s ease-in-out infinite 1.25s;
        }
        .btn-secondary:hover {
            background: #334155;
            border-color: #475569;
            transform: translateY(-4px) scale(1.05) !important;
        }

        @keyframes bounce-btn {
            0%, 100% { transform: translateY(0); }
            25% { transform: translateY(-8px); }
            40% { transform: translateY(0); }
            55% { transform: translateY(-4px); }
            70% { transform: translateY(0); }
        }

        /* ── Floating particles ── */
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(16,185,129,0.4);
            border-radius: 50%;
            pointer-events: none;
            animation: float-up linear infinite;
        }
        @keyframes float-up {
            0% { transform: translateY(100vh) scale(0); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-20vh) scale(1); opacity: 0; }
        }

        @media (max-width: 640px) {
            .btn-row { flex-direction: column; align-items: stretch; }
            .btn { justify-content: center; }
        }
    </style>
</head>
<body>
    <div class="texture"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- Floating particles -->
    <div class="particle" style="left:10%;animation-duration:8s;animation-delay:0s;"></div>
    <div class="particle" style="left:25%;animation-duration:12s;animation-delay:2s;width:3px;height:3px;"></div>
    <div class="particle" style="left:40%;animation-duration:9s;animation-delay:4s;background:rgba(59,130,246,0.3);"></div>
    <div class="particle" style="left:55%;animation-duration:11s;animation-delay:1s;"></div>
    <div class="particle" style="left:70%;animation-duration:10s;animation-delay:3s;width:5px;height:5px;background:rgba(168,85,247,0.3);"></div>
    <div class="particle" style="left:85%;animation-duration:7s;animation-delay:5s;"></div>
    <div class="particle" style="left:15%;animation-duration:14s;animation-delay:6s;background:rgba(59,130,246,0.25);"></div>
    <div class="particle" style="left:60%;animation-duration:13s;animation-delay:7s;width:3px;height:3px;"></div>

    <div class="error-wrap">
        <div class="glow-ring"></div>

        <!-- Jumpy 404 -->
        <div class="digits">
            <span class="digit">4</span>
            <span class="digit">0</span>
            <span class="digit">4</span>
        </div>

        <h2 class="subtitle">Oops! Page not found.</h2>
        <p class="description">
            The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Let's bounce you back!
        </p>

        <!-- Jumpy Buttons -->
        <div class="btn-row">
            <a href="{{ url('/') }}" class="btn btn-primary">
                <i class="fa-solid fa-house"></i> Jump to Home
            </a>
            <a href="{{ url('/contact') }}" class="btn btn-secondary">
                <i class="fa-solid fa-life-ring"></i> Contact Support
            </a>
        </div>
    </div>
</body>
</html>
