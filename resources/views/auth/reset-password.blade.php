<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <!-- Logo estilizada com a paleta de cores -->
                <x-application-logo class="w-20 h-20 fill-current text-[#457B9D]" />
            </a>
        </x-slot>

        <!-- Erros de Validação -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Token de Redefinição de Senha -->
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Endereço de Email -->
            <div>
                <x-label for="email" :value="__('Email')" class="text-[#1D3557] font-semibold" />
                <x-input id="email" class="block mt-1 w-full border-gray-300 focus:border-[#457B9D] focus:ring focus:ring-[#457B9D] focus:ring-opacity-50 rounded-lg shadow-sm" type="email" name="email" :value="old('email', $email)" required autofocus />
            </div>

            <!-- Nova Senha -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" class="text-[#1D3557] font-semibold" />
                <x-input id="password" class="block mt-1 w-full border-gray-300 focus:border-[#457B9D] focus:ring focus:ring-[#457B9D] focus:ring-opacity-50 rounded-lg shadow-sm" type="password" name="password" required />
            </div>

            <!-- Confirmação de Senha -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" class="text-[#1D3557] font-semibold" />
                <x-input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-[#457B9D] focus:ring focus:ring-[#457B9D] focus:ring-opacity-50 rounded-lg shadow-sm" type="password" name="password_confirmation" required />
            </div>

            <!-- Botão de Redefinição -->
            <div class="flex items-center justify-end mt-6">
                <x-button class="bg-[#457B9D] hover:bg-[#1D3557] text-white px-6 py-2 rounded-lg shadow-md transition duration-300">
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
