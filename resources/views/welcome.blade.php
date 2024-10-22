<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Projeto Gestão de Usuário</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="min-h-screen text-white flex items-center justify-center bg-[#F0F4F8]">
    <div class="w-full max-w-md p-8 bg-white shadow-lg rounded-lg text-center text-[#1D3557]">
        <div class="mb-6">
            <a href="/" class="flex alin-center justify-center">
                <x-application-logo class="w-20 h-20 fill-current text-[#457B9D]" />
            </a>
        </div>
        <h1 class="text-4xl font-extrabold tracking-tight mb-4 text-[#1D3557]">
            Gestão de Usuário
        </h1>
        <p class="text-md font-light mb-8 text-[#457B9D]">
            Gerencie seus usuários de forma simples e eficiente.
        </p>
        <div class="space-y-4">
            <a href="{{ route('login') }}" class="block px-6 py-3 bg-[#457B9D] hover:bg-[#1D3557] text-white font-semibold rounded-lg shadow-md transition duration-300">
                Login
            </a>
        </div>
    </div>
</body>
</html>
