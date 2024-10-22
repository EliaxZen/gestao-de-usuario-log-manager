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

        <!-- Formulário de Registro -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nome -->
            <div>
                <x-label for="name" :value="__('Nome')" class="text-[#1D3557] font-semibold" />
                <x-input id="name" class="block mt-1 w-full border-gray-300 focus:border-[#457B9D] focus:ring focus:ring-[#457B9D] focus:ring-opacity-50 rounded-lg shadow-sm" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Endereço de Email -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" class="text-[#1D3557] font-semibold" />
                <x-input id="email" class="block mt-1 w-full border-gray-300 focus:border-[#457B9D] focus:ring focus:ring-[#457B9D] focus:ring-opacity-50 rounded-lg shadow-sm" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Telefone -->
            <div class="mt-4">
                <x-label for="telefone" :value="__('Telefone')" class="text-[#1D3557] font-semibold" />
                <x-input id="telefone" class="block mt-1 w-full border-gray-300 focus:border-[#457B9D] focus:ring focus:ring-[#457B9D] focus:ring-opacity-50 rounded-lg shadow-sm" type="text" name="telefone" :value="old('telefone')" required />
            </div>

            <!-- Sexo -->
            <div class="mt-4">
                <x-label for="sexo" :value="__('Sexo')" class="text-[#1D3557] font-semibold" />
                <select id="sexo" name="sexo" class="block mt-1 w-full border-gray-300 focus:border-[#457B9D] focus:ring focus:ring-[#457B9D] focus:ring-opacity-50 rounded-lg shadow-sm" required>
                    <option value="" disabled selected>Selecione o sexo</option>
                    <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Feminino" {{ old('sexo') == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                </select>
            </div>

            <!-- Tipo de Usuário -->
            <div class="mt-4">
                <x-label for="tipo" :value="__('Tipo de Usuário')" class="text-[#1D3557] font-semibold" />
                <select id="tipo" name="tipo" class="block mt-1 w-full border-gray-300 focus:border-[#457B9D] focus:ring focus:ring-[#457B9D] focus:ring-opacity-50 rounded-lg shadow-sm" required>
                    <option value="" disabled selected>Selecione o tipo de usuário</option>
                    <option value="administrador" {{ old('tipo') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                    <option value="vendedor" {{ old('tipo') == 'vendedor' ? 'selected' : '' }}>Vendedor</option>
                    <option value="transportadora" {{ old('tipo') == 'transportadora' ? 'selected' : '' }}>Transportadora</option>
                </select>
            </div>

            <!-- Senha -->
            <div class="mt-4">
                <x-label for="password" :value="__('Senha')" class="text-[#1D3557] font-semibold" />
                <x-input id="password" class="block mt-1 w-full border-gray-300 focus:border-[#457B9D] focus:ring focus:ring-[#457B9D] focus:ring-opacity-50 rounded-lg shadow-sm" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirmação de Senha -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirmar Senha')" class="text-[#1D3557] font-semibold" />
                <x-input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-[#457B9D] focus:ring focus:ring-[#457B9D] focus:ring-opacity-50 rounded-lg shadow-sm" type="password" name="password_confirmation" required />
            </div>

            <!-- Links e Botões -->
            <div class="flex items-center justify-between mt-6">
                <a class="underline text-sm text-gray-600 hover:text-[#1D3557]" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4 bg-[#457B9D] hover:bg-[#1D3557] text-white px-6 py-2 rounded-lg shadow-md transition duration-300">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
