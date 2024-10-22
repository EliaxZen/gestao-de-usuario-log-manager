<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Link para o CSS do aplicativo -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #F0F4F8; /* Cor de fundo suave */
        }

        .main-content {
            background-color: #FFFFFF; /* Fundo branco */
            border-radius: 8px;
            margin: 0 auto;
            max-width: 800px;
        }
    </style>
</head>
<body class="min-h-dvh flex flex-col items-center justify-center antialiased">
    <div class="w-full font-sans text-gray-900">
        <div class="main-content">
            {{ $slot }}
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
