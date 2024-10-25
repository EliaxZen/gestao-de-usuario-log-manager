<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Editar Pedido') }}
        </h2>
    </x-slot>

    <x-navbar class="bg-[#1D3557] w-full lg:w-1/5 py-4 lg:py-0" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="editOrderForm" action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nome Recebedor -->
                        <div class="mb-4">
                            <label for="nome_recebedor" class="block text-gray-700">Nome Recebedor:</label>
                            <input type="text" id="nome_recebedor" name="nome_recebedor" maxlength="100"
                                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('nome_recebedor') border-red-500 @enderror"
                                value="{{ old('nome_recebedor', $order->nome_recebedor) }}" required>
                            @error('nome_recebedor')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Cep -->
                        <div class="mb-4">
                            <label for="cep" class="block text-gray-700">Cep:</label>
                            <input type="text" id="cep" name="cep" maxlength="9"
                                oninput="this.value = this.value.replace(/\D/g, '').replace(/(\d{5})(\d{3})/, '$1-$2').slice(0, 9)"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('cep') border-red-500 @enderror"
                                value="{{ old('cep', $order->cep) }}" required>
                            @error('cep')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Endereço -->
                        <div class="mb-4">
                            <label for="endereco" class="block text-gray-700">Endereço:</label>
                            <input type="text" id="endereco" name="endereco" maxlength="150"
                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s\.,-]/g, '')"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('endereco') border-red-500 @enderror"
                                value="{{ old('endereco', $order->endereco) }}" required>
                            @error('endereco')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Número -->
                        <div class="mb-4">
                            <label for="numero" class="block text-gray-700">Número:</label>
                            <input type="number" id="numero" name="numero" min="1" max="9999"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('numero') border-red-500 @enderror"
                                value="{{ old('numero', $order->numero) }}" required>
                            @error('numero')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Bairro -->
                        <div class="mb-4">
                            <label for="bairro" class="block text-gray-700">Bairro:</label>
                            <input type="text" id="bairro" name="bairro" maxlength="100"
                                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('bairro') border-red-500 @enderror"
                                value="{{ old('bairro', $order->bairro) }}" required>
                            @error('bairro')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Cidade -->
                        <div class="mb-4">
                            <label for="cidade" class="block text-gray-700">Cidade:</label>
                            <input type="text" id="cidade" name="cidade" maxlength="100"
                                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('cidade') border-red-500 @enderror"
                                value="{{ old('cidade', $order->cidade) }}" required>
                            @error('cidade')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Estado -->
                        <div class="mb-4">
                            <label for="estado" class="block text-gray-700">Estado:</label>
                            <input type="text" id="estado" name="estado" maxlength="2"
                                oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '').toUpperCase()"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('estado') border-red-500 @enderror"
                                value="{{ old('estado', $order->estado) }}" required>
                            @error('estado')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Complemento -->
                        <div class="mb-4">
                            <label for="complemento" class="block text-gray-700">Complemento:</label>
                            <input type="text" id="complemento" name="complemento" maxlength="50"
                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s\.,-]/g, '')"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ old('complemento', $order->complemento) }}">
                        </div>

                        <!-- Produtos -->
                        <h3 class="text-lg font-semibold mt-6 mb-4">Editar Produtos</h3>

                        <div id="product-list">
                            <!-- Produtos Existentes -->
                            @foreach ($order->products as $product)
                                <div class="mb-4 product-item">
                                    <input type="hidden" name="products[{{ $product->id }}][id]" value="{{ $product->id }}">
                                    <div class="flex space-x-4">
                                        <div class="flex-grow">
                                            <label class="block text-gray-700">Nome Produto:</label>
                                            <input type="text" name="products[{{ $product->id }}][nome_produto]" maxlength="100"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s]/g, '')"
                                                value="{{ old('products.' . $product->id . '.nome_produto', $product->nome_produto) }}"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700">Preço:</label>
                                            <input type="number" name="products[{{ $product->id }}][preco_produto]" step="0.01" min="0" max="99999.99"
                                                oninput="if(this.value.includes('.')) this.value = parseFloat(this.value).toFixed(2);"
                                                value="{{ old('products.' . $product->id . '.preco_produto', $product->preco_produto) }}"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700">Quantidade:</label>
                                            <input type="number" name="products[{{ $product->id }}][quantidade_produto]" min="1" max="999"
                                                value="{{ old('products.' . $product->id . '.quantidade_produto', $product->quantidade_produto) }}"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                        </div>
                                        <button type="button" class="remove-product-btn px-2 py-1 bg-red-600 text-white rounded-md mt-7">Remover</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Template para novos produtos -->
                        <template id="product-template">
                            <div class="mb-4 flex space-x-4 product-item">
                                <div class="flex-grow">
                                    <label class="block text-gray-700">Nome Produto:</label>
                                    <input type="text" name="products[][nome_produto]" maxlength="100"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s]/g, '')"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700">Preço:</label>
                                    <input type="number" name="products[][preco_produto]" step="0.01" min="0" max="99999.99"
                                        oninput="if(this.value.includes('.')) this.value = parseFloat(this.value).toFixed(2);"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700">Quantidade:</label>
                                    <input type="number" name="products[][quantidade_produto]" min="1" max="999"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                </div>
                                <button type="button" class="remove-product-btn px-2 py-1 bg-red-600 text-white rounded-md mt-7">Remover</button>
                            </div>
                        </template>

                        <!-- Botão adicionar novo produto -->
                        <div>
                            <button type="button" id="add-product-btn" class="px-4 py-2 bg-green-600 text-white rounded-md mt-4">Adicionar Produto</button>
                        </div>

                        <!-- Botão para salvar alterações -->
                        <div class="mt-6">
                            <button type="submit" id="saveOrderButton" class="px-4 py-2 bg-blue-600 text-white rounded-md">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para adicionar/remover produtos dinamicamente -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addProductButton = document.getElementById('add-product-btn');
            const productTemplate = document.getElementById('product-template').content;
            const productList = document.getElementById('product-list');
            let productIndex = productList.children.length;

            addProductButton.addEventListener('click', function() {
                const newProduct = document.importNode(productTemplate, true);
                newProduct.querySelector('[name="products[][nome_produto]"]').setAttribute('name', `products[${productIndex}][nome_produto]`);
                newProduct.querySelector('[name="products[][preco_produto]"]').setAttribute('name', `products[${productIndex}][preco_produto]`);
                newProduct.querySelector('[name="products[][quantidade_produto]"]').setAttribute('name', `products[${productIndex}][quantidade_produto]`);
                productList.appendChild(newProduct);
                productIndex++;
            });

            productList.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-product-btn')) {
                    event.target.closest('.product-item').remove();
                }
            });
        });
    </script>
</x-app-layout>
