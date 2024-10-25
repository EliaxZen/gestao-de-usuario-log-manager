<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Criar Novo Pedido') }}
        </h2>
    </x-slot>

    <x-navbar class="bg-[#1D3557] w-full lg:w-1/5 py-4 lg:py-0" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="createOrderForm" action="{{ route('orders.store') }}" method="POST">
                        @csrf

                        <!-- Nome Recebedor -->
                        <div class="mb-4">
                            <label for="nome_recebedor" class="block text-gray-700">Nome Recebedor:</label>
                            <input type="text" id="nome_recebedor" name="nome_recebedor"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('nome_recebedor') border-red-500 @enderror"
                                value="{{ old('nome_recebedor') }}" required>
                            @error('nome_recebedor')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Cep -->
                        <div class="mb-4">
                            <label for="cep" class="block text-gray-700">Cep:</label>
                            <input type="text" id="cep" name="cep"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('cep') border-red-500 @enderror"
                                value="{{ old('cep') }}" required>
                            @error('cep')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Endereço -->
                        <div class="mb-4">
                            <label for="endereco" class="block text-gray-700">Endereço:</label>
                            <input type="text" id="endereco" name="endereco"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('endereco') border-red-500 @enderror"
                                value="{{ old('endereco') }}" required>
                            @error('endereco')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Número -->
                        <div class="mb-4">
                            <label for="numero" class="block text-gray-700">Número:</label>
                            <input type="number" id="numero" name="numero"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('numero') border-red-500 @enderror"
                                value="{{ old('numero') }}" required>
                            @error('numero')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Bairro -->
                        <div class="mb-4">
                            <label for="bairro" class="block text-gray-700">Bairro:</label>
                            <input type="text" id="bairro" name="bairro"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('bairro') border-red-500 @enderror"
                                value="{{ old('bairro') }}" required>
                            @error('bairro')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Cidade -->
                        <div class="mb-4">
                            <label for="cidade" class="block text-gray-700">Cidade:</label>
                            <input type="text" id="cidade" name="cidade"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('cidade') border-red-500 @enderror"
                                value="{{ old('cidade') }}" required>
                            @error('cidade')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Estado -->
                        <div class="mb-4">
                            <label for="estado" class="block text-gray-700">Estado:</label>
                            <input type="text" id="estado" name="estado"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('estado') border-red-500 @enderror"
                                value="{{ old('estado') }}" required>
                            @error('estado')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Complemento -->
                        <div class="mb-4">
                            <label for="complemento" class="block text-gray-700">Complemento:</label>
                            <input type="text" id="complemento" name="complemento"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ old('complemento') }}">
                        </div>

                        <!-- Produtos -->
                        <h3 class="text-lg font-semibold mt-6 mb-4">Adicionar Produtos</h3>

                        <!-- Lista de produtos dinâmica -->
                        <div id="product-list" class="space-y-4"></div>

                        <!-- Produto template fora do formulário -->
                        <template id="product-template">
                            <div class="flex space-x-4 product-item">
                                <div class="flex-grow">
                                    <label class="block text-gray-700">Nome Produto:</label>
                                    <input type="text" name="products[0][nome_produto]" 
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700">Preço:</label>
                                    <input type="number" name="products[0][preco_produto]" step="0.01"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700">Quantidade:</label>
                                    <input type="number" name="products[0][quantidade_produto]"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                </div>
                                <button type="button" 
                                    class="remove-product-btn px-2 py-1 bg-red-600 text-white rounded-md mt-7">Remover</button>
                            </div>
                        </template>

                        <!-- Botão para adicionar produto -->
                        <div>
                            <button type="button" id="add-product-btn"
                                class="px-4 py-2 bg-green-600 text-white rounded-md mt-4">Adicionar Produto</button>
                        </div>

                        <!-- Botão Criar Pedido -->
                        <div class="mt-6">
                            <button type="submit" id="createOrderButton"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md">Criar Pedido</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para adicionar/remover produtos -->
    <script>
        let productIndex = 0;

        document.getElementById('add-product-btn').addEventListener('click', function() {
            const productTemplate = document.getElementById('product-template').content.cloneNode(true);
            
            // Atualiza o índice de cada produto no template
            productTemplate.querySelectorAll('input').forEach((input) => {
                input.name = input.name.replace('[0]', `[${productIndex}]`);
            });

            // Adiciona o template ao formulário
            const productList = document.getElementById('product-list');
            productList.appendChild(productTemplate);

            // Remove produto individualmente
            productList.lastElementChild.querySelector('.remove-product-btn').addEventListener('click', function() {
                this.closest('.product-item').remove();
            });

            // Incrementa o índice
            productIndex++;
        });
    </script>
</x-app-layout>
