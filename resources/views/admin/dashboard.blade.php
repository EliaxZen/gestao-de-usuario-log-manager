<x-app-layout>
    <x-slot name="header">
        <div class="rounded-md">
            <h2 class="font-semibold text-3xl text-white leading-tight">
                {{ __('Dashboard do Administrador') }}
            </h2>
        </div>
    </x-slot>

    <!-- Conteúdo Principal -->
    <div class="flex flex-col lg:flex-row items-stretch min-h-screen">
        <x-navbar class="bg-[#1D3557] w-full lg:w-1/5 py-4 lg:py-0" />

        <div class="flex-grow p-6 lg:py-12 w-full bg-gray-100">
            <div class="flex flex-col bg-white shadow-xl rounded-lg p-8 w-full">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Bem-vindo ao painel do administrador!</h2>

                <div class="mb-6">
                    <a href="{{ route('users.create') }}"
                        class="inline-flex items-center px-5 py-3 bg-green-600 text-white font-semibold rounded-lg shadow hover:bg-green-500 transition-all duration-300 transform hover:scale-105">
                        Criar Novo Usuário
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="white">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </a>
                </div>

                <!-- Tabela Responsiva -->
                <div class="mb-4">
                    <!-- Custom search bar -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex space-x-2">
                            <label for="customLength" class="text-gray-600">Mostrar</label>
                            <select id="customLength"
                                class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-[#457B9D]">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span class="text-gray-600">registros por página</span>
                        </div>
                        <div class="relative w-1/3">
                            <input type="text" id="customSearch"
                                class="px-4 py-2 border border-gray-300 rounded-md w-full focus:outline-none focus:ring focus:ring-[#457B9D]"
                                placeholder="Pesquisar...">
                        </div>
                    </div>

                    <table id="usersTable" class="min-w-full bg-white rounded-lg shadow-lg overflow-hidden">
                        <thead class="bg-[#1D3557] text-white text-sm leading-normal text-center">
                            <tr>
                                <th scope="col" class="px-4 py-3">ID</th>
                                <th scope="col" class="px-4 py-3">Nome</th>
                                <th scope="col" class="px-4 py-3">Email</th>
                                <th scope="col" class="px-4 py-3">Telefone</th>
                                <th scope="col" class="px-4 py-3">Tipo</th>
                                <th scope="col" class="px-4 py-3">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light text-center">
                            @foreach ($users as $user)
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150">
                                    <td class="px-4 py-3 border-b">{{ $user->id }}</td>
                                    <td class="px-4 py-3 border-b">{{ $user->name }}</td>
                                    <td class="px-4 py-3 border-b">{{ $user->email }}</td>
                                    <td class="px-4 py-3 border-b">{{ $user->telefone }}</td>
                                    <td class="px-4 py-3 border-b">{{ $user->tipo }}</td>
                                    <td class="px-4 py-3 border-b text-center flex space-x-2 justify-center">
                                        <a href="{{ route('users.edit', $user) }}"
                                            class="edit-button flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 transition duration-200">
                                            Editar
                                        </a>
                                        <form action="{{ route('users.send-reset-password', $user) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="reset-password-button flex items-center px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-500 transition duration-200">
                                                Redefinir Senha
                                            </button>
                                        </form>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="delete-button flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-500 transition duration-200">Deletar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Adicionando scripts do DataTables e extensões -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#usersTable').DataTable({
                language: {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado",
                    "info": "Mostrando _START_ até _END_ de _TOTAL_ registros",
                    "infoEmpty": "Nenhum registro disponível",
                    "infoFiltered": "(filtrado de _MAX_ registros totais)",
                    "paginate": {
                        "next": "<button class='bg-blue-500 text-white px-5 py-2 rounded-md hover:bg-blue-700'>Próximo</button>",
                        "previous": "<button class='bg-blue-500 text-white px-5 py-2 rounded-md hover:bg-blue-700'>Anterior</button>"
                    },
                },
                paging: true,
                responsive: true,
                lengthChange: false,
                pageLength: 5,
                dom: 'rtip',
            });

            // Custom search
            $('#customSearch').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Custom length change
            $('#customLength').on('change', function() {
                table.page.len(this.value).draw();
            });

            // Confirmar edição
            $(document).on('click', '.edit-button', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');

                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Você será redirecionado para a página de edição!",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, continuar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });

            // Confirmar deleção
            $(document).on('click', '.delete-button', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');

                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Você não poderá reverter isso!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, deletar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>
