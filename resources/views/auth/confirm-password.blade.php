<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <!-- Logo estilizada com a paleta de cores -->
                <x-application-logo class="w-20 h-20 fill-current text-[#457B9D]" />
            </a>
        </x-slot>

        <!-- Texto Explicativo -->
        <div class="mb-4 text-sm text-gray-600 leading-relaxed">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <!-- Erros de Validação -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <!-- Formulário de Confirmação -->
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Campo de Senha -->
            <div>
                <x-label for="password" :value="__('Password')" class="text-[#1D3557] font-semibold" />
                <x-input id="password" class="block mt-1 w-full border-gray-300 focus:border-[#457B9D] focus:ring focus:ring-[#457B9D] focus:ring-opacity-50 rounded-lg shadow-sm" type="password" name="password" required autocomplete="current-password" />
            </div>

            <!-- Botão de Confirmação -->
            <div class="flex justify-end mt-6">
                <x-button class="bg-[#457B9D] hover:bg-[#1D3557] text-white px-6 py-2 rounded-lg shadow-md transition duration-300">
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
