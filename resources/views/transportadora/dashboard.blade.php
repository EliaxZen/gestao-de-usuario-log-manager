<x-app-layout>
    <x-slot name="header">
        {{ $header }}
    </x-slot>

    <x-navbar class="bg-[#1D3557] w-full lg:w-1/5 py-4 lg:py-0" /> 

    <div class="py-12">
        <div class="max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold">Bem-vindo, Transportadora!</h2>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
