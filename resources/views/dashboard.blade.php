<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Navbar Lateral -->
        <x-navbar/>

        <!-- Conteúdo Principal -->
        <div class="flex-1 py-12 px-6  bg-gray-100">
            <div class="max-w-7xl">
                <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                    <div class="p-8 border-b border-gray-200">
                        <!-- Saudações personalizadas com base no tipo de usuário -->
                        @if (Auth::user()->tipo === 'administrador')
                            <h3 class="text-xl font-bold text-[#1D3557] mt-6">
                                Você está logado como <span class="text-[#457B9D]">Administrador</span>, {{ Auth::user()->name }}!
                            </h3>
                        @elseif (Auth::user()->tipo === 'vendedor')
                            <h3 class="text-xl font-bold text-[#1D3559] mt-6">
                                Você está logado como <span class="text-[#457B9D]">Vendedor</span>, {{ Auth::user()->name }}!
                            </h3>
                        @elseif (Auth::user()->tipo === 'transportadora')
                            <h3 class="text-xl font-bold text-[#1D3557] mt-6">
                                Você está logado como <span class="text-[#457B9D]">Transportadora</span>, {{ Auth::user()->name }}!
                            </h3>
                        @else
                            <h3 class="text-xl font-bold text-[#1D3557] mt-6">
                                Bem-vindo(a), <span class="text-[#457B9D]">{{ Auth::user()->name }}</span>!
                            </h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
