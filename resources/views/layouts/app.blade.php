<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Importação dos estilos -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
</head>
<body class="bg-gray-100 font-sans">

    <div class="min-h-screen flex flex-col pl-64">

        <!-- Cabeçalho -->
        <header class="bg-[#1D3557] shadow w-full">
            <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="p-6 text-3xl font-bold text-[#F1FAEE]">
                    {{ $header ?? 'Bem-vindo(a) ao Sistema, '.Auth::user()->name }}
                </h1>
            </div>
        </header>

        <!-- Conteúdo principal -->
        <main class="flex-1 bg-white w-full">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-gray-200 text-center py-4 w-full">
            <p class="text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.
            </p>
        </footer>
    </div>

    <!-- Importação do JavaScript -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
