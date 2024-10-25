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
                        class="inline-flex items-center px-5 py-3 bg-green-600 text-white font-semibold rounded-lg shadow hover:bg-green-500 transition-all duration-300 transform hover:scale-105">
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
                                <th scope="col" class="px-4 py-3">Endereço</th>
                                <th scope="col" class="px-4 py-3">Número</th>
                                <th scope="col" class="px-4 py-3">Bairro</th>
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
                                    <td class="px-4 py-3 border-b">{{ $order->endereco }}</td>
                                    <td class="px-4 py-3 border-b">{{ $order->numero }}</td>
                                    <td class="px-4 py-3 border-b">{{ $order->bairro }}</td>
                                    <td class="px-4 py-3 border-b">{{ $order->cidade }}</td>
                                    <td class="px-4 py-3 border-b">{{ $order->estado }}</td>
                                    <td class="px-4 py-3 border-b text-center flex space-x-2 justify-center">
                                        <a href="{{ route('orders.edit', $order) }}"
                                            class="edit-button flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 transition duration-200">
                                            Editar
                                        </a>
                                        <button
                                            class="details-button flex items-center px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-400 transition duration-200"
                                            data-order-id="{{ $order->id }}">
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

    <!-- Modal -->
    <div id="detailsModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-11/12 md:w-1/2">
            <h2 class="text-2xl font-bold mb-4">Detalhes do Pedido</h2>
            <div id="modalContent"></div>
            <button id="closeModal" class="mt-4 px-4 py-2 bg-red-600 text-white rounded-md">Fechar</button>
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

            $(document).on('click', '.details-button', function() {
                const orderId = $(this).data('order-id');

                // Fazendo a requisição AJAX para obter os detalhes do pedido
                $.ajax({
                    url: `/orders/${orderId}/details`,
                    method: 'GET',
                    success: function(order) {
                        // Monta a string com os detalhes do pedido e dos produtos
                        let orderDetails = `<strong>ID:</strong> ${order.id}<br>
                                            <strong>Nome Recebedor:</strong> ${order.nome_recebedor}<br>
                                            <strong>CEP:</strong> ${order.cep}<br>
                                            <strong>Cidade:</strong> ${order.cidade}<br>
                                            <strong>Estado:</strong> ${order.estado}<br>
                                            <strong>Produtos:</strong><br>`;
                        
                        order.products.forEach(function(product) {
                            orderDetails += `- ${product.nome_produto} (Quantidade: ${product.quantidade_produto}, Preço: ${product.preco_produto})<br>`;
                        });

                        // Preenche o conteúdo do modal
                        $('#modalContent').html(orderDetails);
                        $('#detailsModal').removeClass('hidden');
                    },
                    error: function() {
                        alert('Erro ao buscar os detalhes do pedido.');
                    }
                });
            });

            // Fecha o modal
            $('#closeModal').on('click', function() {
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
