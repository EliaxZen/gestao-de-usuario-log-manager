<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Criar Novo Usuário') }}
        </h2>
    </x-slot>

    <x-navbar class="bg-[#1D3557] w-full lg:w-1/5 py-4 lg:py-0" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="createUserForm" action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <!-- Nome -->
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Nome:</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email:</label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Telefone -->
                        <div class="mb-4">
                            <label for="telefone" class="block text-gray-700">Telefone:</label>
                            <input type="text" id="telefone" name="telefone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('telefone') border-red-500 @enderror" value="{{ old('telefone') }}" required>
                            @error('telefone')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Senha -->
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700">Senha:</label>
                            <input type="password" id="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('password') border-red-500 @enderror" required>
                            @error('password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirmação de Senha -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-gray-700">Confirmação da Senha:</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <!-- Tipo -->
                        <div class="mb-4">
                            <label for="tipo" class="block text-gray-700">Tipo:</label>
                            <select id="tipo" name="tipo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('tipo') border-red-500 @enderror" required>
                                <option value="administrador" {{ old('tipo') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                                <option value="vendedor" {{ old('tipo') == 'vendedor' ? 'selected' : '' }}>Vendedor</option>
                                <option value="transportadora" {{ old('tipo') == 'transportadora' ? 'selected' : '' }}>Transportadora</option>
                            </select>
                            @error('tipo')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Botão Criar -->
                        <div>
                            <button type="submit" id="createButton" class="px-4 py-2 bg-blue-600 text-white rounded-md">Criar Usuário</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Importando o jQuery e o Plugin de Máscara -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <!-- Importando o SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Aplicando a máscara de telefone
        $(document).ready(function() {
            var phoneMaskBehavior = function(val) {
                val = val.replace(/\D/g, '');
                return val.length === 11 ? '(00) 00000-0000' : '(00) 0000-00000';
            };

            var phoneOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(phoneMaskBehavior.apply({}, arguments), options);
                },
                placeholder: '(00) 0000-0000'
            };

            $('#telefone').mask(phoneMaskBehavior, phoneOptions);
        });

        // SweetAlert para confirmação do envio
        document.getElementById('createButton').addEventListener('click', function (e) {
            e.preventDefault(); // Impede o envio imediato do formulário

            // Exibe o SweetAlert antes de enviar o formulário
            Swal.fire({
                title: 'Usuário criado com sucesso!',
                text: 'Clique em OK para confirmar.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Se o usuário clicar em "OK", envia o formulário
                    document.getElementById('createUserForm').submit();
                }
            });
        });
    </script>

</x-app-layout>
