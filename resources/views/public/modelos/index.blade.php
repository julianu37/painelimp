<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modelos de Equipamentos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Barra de Busca Específica para Modelos --}}
            <div class="mb-6 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                <form action="{{ route('modelos.index') }}" method="GET" class="flex items-center space-x-3">
                    <input type="search"
                           name="busca_modelo"
                           placeholder="Buscar por nome do modelo..."
                           value="{{ request('busca_modelo') }}"
                           class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-cyan-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-700 focus:bg-cyan-700 active:bg-cyan-800 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Buscar
                    </button>
                    @if(request('busca_modelo'))
                        <a href="{{ route('modelos.index') }}" class="text-sm text-gray-500 hover:text-gray-700 whitespace-nowrap">Limpar busca</a>
                    @endif
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($modelos->isNotEmpty())
                        {{-- Agrupa por marca para exibição --}}
                        @php
                            $modelosAgrupados = $modelos->groupBy('marca.nome');
                        @endphp

                        @foreach ($modelosAgrupados as $nomeMarca => $modelosDaMarca)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-3 border-b pb-2 dark:border-gray-700">{{ $nomeMarca ?: 'Marca Desconhecida' }}</h3>
                                <ul class="space-y-2">
                                    @foreach ($modelosDaMarca as $modelo)
                                        <li>
                                            <a href="{{ route('modelos.show', $modelo) }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                                {{ $modelo->nome }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach

                        {{-- Links de Paginação --}}
                        <div class="mt-6">
                            {{ $modelos->links() }}
                        </div>
                    @else
                        <p class="text-center text-gray-500 dark:text-gray-400">Nenhum modelo encontrado.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
