<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100">
        <x-auth-card class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
            <!-- Logo da aplicação -->
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-[#457B9D]" />
                </a>
            </x-slot>

            <!-- Mensagem de status da sessão -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Exibição de erros de validação -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <!-- Formulário de Login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Campo para Email -->
                <div>
                    <x-label for="email" :value="__('Email')" class="text-[#1D3557] font-semibold" />
                    <x-input id="email" class="block mt-1 w-full border-gray-300 focus:border-[#457B9D] focus:ring focus:ring-[#457B9D] focus:ring-opacity-50 rounded-lg shadow-sm" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <!-- Campo para Senha -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Senha')" class="text-[#1D3557] font-semibold" />
                    <x-input id="password" class="block mt-1 w-full border-gray-300 focus:border-[#457B9D] focus:ring focus:ring-[#457B9D] focus:ring-opacity-50 rounded-lg shadow-sm"
                             type="password"
                             name="password"
                             required autocomplete="current-password" />
                </div>

                <!-- Lembrar de mim -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#457B9D] shadow-sm focus:border-[#457B9D] focus:ring focus:ring-[#457B9D] focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Lembrar-me') }}</span>
                    </label>
                </div>

                <!-- Ações -->
                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-[#457B9D] hover:text-[#1D3557] transition duration-300" href="{{ route('password.request') }}">
                            {{ __('Esqueceu a senha?') }}
                        </a>
                    @endif

                    <x-button class="ml-3 bg-[#457B9D] hover:bg-[#1D3557] text-white px-6 py-2 rounded-lg shadow-md transition duration-300">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>
    </div>
</x-guest-layout>
