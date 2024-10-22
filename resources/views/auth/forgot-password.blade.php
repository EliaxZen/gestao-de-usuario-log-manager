<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <!-- Logo estilizada com a paleta de cores -->
                <x-application-logo class="w-20 h-20 fill-current text-[#457B9D]" />
            </a>
        </x-slot>

        <!-- Texto explicativo -->
        <div class="mb-4 text-sm text-gray-600 leading-relaxed">
            {{ __('Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e enviaremos por e-mail um link de redefinição de senha que permitirá que você escolha uma nova.
            ') }}
        </div>

        <!-- Status da Sessão -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Erros de Validação -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <!-- Formulário de Recuperação -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Campo de Email -->
            <div>
                <x-label for="email" :value="__('Email')" class="text-[#1D3557] font-semibold" />
                <x-input id="email"
                    class="block mt-1 w-full border-gray-300 focus:border-[#457B9D] focus:ring focus:ring-[#457B9D] focus:ring-opacity-50 rounded-lg shadow-sm"
                    type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Botão para Enviar Link -->
            <div class="flex items-center justify-end mt-6">
                <x-button
                    class="bg-[#457B9D] hover:bg-[#1D3557] text-white px-6 py-2 rounded-lg shadow-md transition duration-300">
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
