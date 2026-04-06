<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name', 'DCMS') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo-favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-favicon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            box-sizing: border-box;
        }
        .error-container {
            width: 100%;
        }
        * {
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="error-container">
        @yield('content')
    </div>
</body>
</html>
