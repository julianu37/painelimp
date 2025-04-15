<x-app-layout>
    {{-- Slot opcional para cabeçalho, se necessário --}}
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Página Inicial') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-4">Bem-vindo ao Sistema de Ajuda</h1>
                    <p class="mb-4">
                        Encontre soluções para códigos de erro, manuais e outras informações sobre impressoras.
                    </p>

                    {{-- Seção de Busca Funcional --}}
                    <div class="mb-6">
                        <form action="{{ route('busca.index') }}" method="GET">
                            <label for="search-home" class="sr-only">Buscar</label>
                            <input type="search" name="q" id="search-home"
                                   class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                   placeholder="Digite um código de erro, modelo ou termo..." required>
                             <button type="submit" class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                Buscar
                            </button>
                        </form>
                    </div>

                    {{-- Links Rápidos --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('codigos.index') }}" class="block p-4 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                            <h3 class="font-semibold">Códigos de Erro</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Pesquise por códigos e encontre soluções.</p>
                        </a>
                        <a href="{{ route('manuais.index') }}" class="block p-4 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                            <h3 class="font-semibold">Manuais</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Faça o download de manuais de impressoras.</p>
                        </a>
                         {{-- Adicionar link para Vídeos se necessário --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
