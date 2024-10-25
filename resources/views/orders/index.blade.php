<x-app-layout>
    <x-slot name="header">
        <div class="rounded-md">
            <h2 class="font-semibold text-3xl text-white leading-tight">
                {{ __('Datatables Pedidos') }}
            </h2>
        </div>
    </x-slot>

    <!-- Conteúdo Principal -->
    <div class="flex flex-col lg:flex-row items-stretch min-h-screen">
        <x-navbar class="bg-[#1D3557] w-full lg:w-1/5 py-4 lg:py-0" />

        <div class="flex-grow p-6 lg:py-12 w-full bg-gray-100">
            <div class="flex flex-col bg-white shadow-xl rounded-lg p-8 w-full">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Dashboard Pedidos</h2>
                <div class="mb-6">
                    <a href="{{ route('orders.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-bold rounded-md hover:bg-green-500 transition duration-200">
                        Criar Novo Pedido
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="white">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </a>
                </div>

                <!-- Tabela Responsiva -->
                <div class="mb-4">
                    <!-- Barra de pesquisa personalizada -->
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
                                <th scope="col" class="px-4 py-3">Nome Recebedor</th>
                                <th scope="col" class="px-4 py-3">CEP</th>
                                <th scope="col" class="px-4 py-3">Cidade</th>
                                <th scope="col" class="px-4 py-3">Estado</th>
                                <th scope="col" class="px-4 py-3">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light text-center">
                            @foreach ($orders as $order)
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150">
                                    <td class="px-4 py-3 border-b">{{ $order->id }}</td>
                                    <td class="px-4 py-3 border-b">{{ $order->nome_recebedor }}</td>
                                    <td class="px-4 py-3 border-b">{{ $order->cep }}</td>
                                    <td class="px-4 py-3 border-b">{{ $order->cidade }}</td>
                                    <td class="px-4 py-3 border-b">{{ $order->estado }}</td>
                                    <td class="px-4 py-3 border-b text-center flex space-x-2 justify-center">
                                        <a href="{{ route('orders.edit', $order) }}"
                                            class="edit-button flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 transition duration-200">
                                            Editar
                                        </a>
                                        <button type="button" data-id="{{ $order->id }}"
                                            data-nome="{{ $order->nome_recebedor }}" data-cep="{{ $order->cep }}"
                                            data-endereco="{{ $order->endereco }}" data-numero="{{ $order->numero }}"
                                            data-bairro="{{ $order->bairro }}" data-cidade="{{ $order->cidade }}"
                                            data-estado="{{ $order->estado }}"
                                            data-complemento="{{ $order->complemento }}"
                                            data-produtos="{{ json_encode($order->produtos) }}"
                                            class="details-button flex items-center px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-500 transition duration-200">
                                            Detalhes
                                        </button>
                                        <form action="{{ route('orders.destroy', $order) }}" method="POST"
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

    <!-- Modal Detalhes -->
    <div id="detailsModal" class="flex fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-11/12 lg:w-1/2 rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 flex justify-between items-center bg-blue-600 text-white">
                <h3 class="text-lg font-semibold">Detalhes do Pedido</h3>
                <button id="closeModal" class="text-white text-xl">&times;</button>
            </div>
            <div class="px-6 py-4 max-h-96 overflow-y-auto">
                <!-- Informações do Pedido -->
                <div class="mb-4">
                    <h4 class="font-semibold text-lg">Informações do Pedido</h4>
                    <p><strong>ID:</strong> <span id="modalOrderId"></span></p>
                    <p><strong>Nome Recebedor:</strong> <span id="modalNomeRecebedor"></span></p>
                    <p><strong>CEP:</strong> <span id="modalCep"></span></p>
                    <p><strong>Endereço:</strong> <span id="modalEndereco"></span>, <strong>Número:</strong> <span
                            id="modalNumero"></span></p>
                    <p><strong>Bairro:</strong> <span id="modalBairro"></span></p>
                    <p><strong>Cidade:</strong> <span id="modalCidade"></span></p>
                    <p><strong>Estado:</strong> <span id="modalEstado"></span></p>
                    <p><strong>Complemento:</strong> <span id="modalComplemento"></span></p>
                </div>
                <!-- Produtos -->
                <div class="mb-4">
                    <h4 class="font-semibold text-lg">Produtos</h4>
                    <div id="modalProdutos" class="space-y-2">
                        <!-- Produtos serão inseridos dinamicamente -->
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-100 text-right">
                <button id="closeModalFooter" class="px-4 py-2 bg-blue-600 text-white rounded-md">Fechar</button>
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

            // Pesquisa personalizada
            $('#customSearch').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Alteração de página personalizada
            $('#customLength').on('change', function() {
                table.page.len(this.value).draw();
            });

            // Abrir o Modal Detalhes
            $(document).on('click', '.details-button', function() {
                const orderData = $(this).data();
                $('#modalOrderId').text(orderData.id);
                $('#modalNomeRecebedor').text(orderData.nome);
                $('#modalCep').text(orderData.cep);
                $('#modalEndereco').text(orderData.endereco);
                $('#modalNumero').text(orderData.numero);
                $('#modalBairro').text(orderData.bairro);
                $('#modalCidade').text(orderData.cidade);
                $('#modalEstado').text(orderData.estado);
                $('#modalComplemento').text(orderData.complemento);

                $('#modalProdutos').empty();
                try {
                    let produtosArray = orderData.produtos ? JSON.parse(orderData.produtos) : [];
                    if (produtosArray.length === 0) {
                        $('#modalProdutos').append('<p>Nenhum produto associado a este pedido.</p>');
                    } else {
                        produtosArray.forEach(produto => {
                            $('#modalProdutos').append(
                                `<p><strong>Produto:</strong> ${produto.nome_produto}, 
                                  <strong>Preço:</strong> ${produto.preco_produto}, 
                                  <strong>Quantidade:</strong> ${produto.quantidade_produto}</p>`
                            );
                        });
                    }
                } catch (e) {
                    console.error("Erro ao processar produtos: ", e);
                }

                $('#detailsModal').removeClass('hidden');
            });

            // Fechar o modal
            $('#closeModal, #closeModalFooter').on('click', function() {
                $('#detailsModal').addClass('hidden');
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
