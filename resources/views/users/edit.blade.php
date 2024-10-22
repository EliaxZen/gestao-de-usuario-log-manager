<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Editar Usuário') }}
        </h2>
    </x-slot>

    <x-navbar class="bg-[#1D3557] w-full lg:w-1/5 py-4 lg:py-0" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="editUserForm" action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nome -->
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Nome</label>
                            <input type="text"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('name') border-red-500 @enderror"
                                id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('email') border-red-500 @enderror"
                                id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Telefone -->
                        <div class="mb-4">
                            <label for="telefone" class="block text-gray-700">Telefone</label>
                            <input type="text"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('telefone') border-red-500 @enderror"
                                id="telefone" name="telefone" value="{{ old('telefone', $user->telefone) }}" required>
                            @error('telefone')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tipo -->
                        <div class="mb-4">
                            <label for="tipo" class="block text-gray-700">Tipo</label>
                            <select
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('tipo') border-red-500 @enderror"
                                id="tipo" name="tipo" required>
                                <option value="administrador"
                                    {{ old('tipo', $user->tipo) === 'administrador' ? 'selected' : '' }}>Administrador
                                </option>
                                <option value="vendedor"
                                    {{ old('tipo', $user->tipo) === 'vendedor' ? 'selected' : '' }}>Vendedor</option>
                                <option value="transportadora"
                                    {{ old('tipo', $user->tipo) === 'transportadora' ? 'selected' : '' }}>
                                    Transportadora</option>
                            </select>
                            @error('tipo')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Botão de Salvar -->
                        <button type="button" id="saveButton" class="px-4 py-2 bg-blue-600 text-white rounded-md">
                            Salvar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Importando o jQuery e o Plugin de Máscara -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <!-- Importando SweetAlert -->
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

        // SweetAlert
        document.getElementById('saveButton').addEventListener('click', function(e) {
            e.preventDefault(); // Impede o envio imediato do formulário

            // Exibe o SweetAlert antes de enviar o formulário
            Swal.fire({
                title: 'Edição realizada com sucesso!',
                text: 'Clique em OK para confirmar.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('editUserForm').submit();
                }
            });
        });
    </script>
</x-app-layout>
