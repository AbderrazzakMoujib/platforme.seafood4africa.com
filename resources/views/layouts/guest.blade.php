<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                background: linear-gradient(135deg, #e8f4fd 0%, #f0f9ff 50%, #e0f2fe 100%);
                min-height: 100vh;
            }
            .auth-card {
                background: #fff;
                border-radius: 16px;
                box-shadow: 0 8px 32px rgba(0,136,204,0.12);
                padding: 36px 40px;
                width: 100%;
                max-width: 480px;
            }
            .auth-logo {
                display: flex;
                justify-content: center;
                margin-bottom: 24px;
            }
            .auth-logo img {
                height: 64px;
                object-fit: contain;
            }
            /* Override Tailwind form inputs */
            .auth-card input[type="text"],
            .auth-card input[type="email"],
            .auth-card input[type="password"],
            .auth-card input[type="tel"],
            .auth-card select,
            .auth-card textarea {
                border: 1.5px solid #d1d5db;
                border-radius: 8px;
                padding: 9px 14px;
                font-size: 14px;
                transition: border-color 0.2s;
                width: 100%;
                background: #fff;
            }
            .auth-card input:focus,
            .auth-card select:focus,
            .auth-card textarea:focus {
                border-color: #0088cc;
                outline: none;
                box-shadow: 0 0 0 3px rgba(0,136,204,0.12);
            }
            .auth-card label {
                font-size: 13px;
                font-weight: 600;
                color: #374151;
            }
            .auth-card .btn-primary {
                background: #0088cc;
                color: #fff;
                border: none;
                border-radius: 8px;
                padding: 10px 24px;
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
                transition: background 0.2s;
            }
            .auth-card .btn-primary:hover { background: #0070aa; }
            .auth-card .btn-gray {
                background: #6b7280;
                color: #fff;
                border: none;
                border-radius: 8px;
                padding: 10px 24px;
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
                transition: background 0.2s;
            }
            .auth-card .btn-gray:hover { background: #4b5563; }
            @media (max-width: 520px) {
                .auth-card { padding: 24px 16px; }
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div style="min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:24px 16px;">
            <div class="auth-logo">
                <a href="/">
                    <img src="{{ asset('img/LOGO- SEAFOOD 4 AFRICA FORUM AFRICAIN DE L\'INDUSTRIE DE LA PÊCHE ET DE L\'AQUACULTURE MAROC - DAKHLA - 04 AU 06 FEVRIER 2026_2nd EDITION_blue.webp') }}" alt="Seafood4Africa" onerror="this.style.display='none'">
                </a>
            </div>
            <div class="auth-card">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
