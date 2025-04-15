<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manuais de Impressoras') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             {{-- Mensagens Flash --}}
             <x-alert-messages />

             {{-- TODO: Adicionar Barra de Busca/Filtros por Modelo --}}

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($manuais->isNotEmpty())
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($manuais as $manual)
                                <li class="py-4 flex flex-col sm:flex-row justify-between sm:items-center">
                                    <div>
                                        <span class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $manual->nome }}</span>
                                        <p class="text-sm text-gray-500 dark:text-gray-400" title="{{ $manual->arquivo_nome_original }}">
                                            Arquivo: {{ Str::limit($manual->arquivo_nome_original, 50) }}
                                        </p>
                                         {{-- Mostrar Modelo/Marca se carregado --}}
                                         @if($manual->modelo)
                                             <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                 Modelo: <a href="{{ route('modelos.show', $manual->modelo) }}" class="hover:underline">{{ $manual->modelo->nome }}</a>
                                                 @if($manual->modelo->marca)
                                                 (<a href="{{ route('marcas.show', $manual->modelo->marca) }}" class="hover:underline">{{ $manual->modelo->marca->nome }}</a>)
                                                 @endif
                                             </p>
                                         @endif
                                    </div>
                                    <div class="mt-2 sm:mt-0 sm:ml-4 flex-shrink-0 flex space-x-2">
                                         {{-- Botão Visualizar --}}
                                         <a href="{{ route('manuais.view', $manual) }}" target="_blank" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-800">
                                            Visualizar
                                        </a>
                                         @auth
                                            {{-- Botão Download --}}
                                            <a href="{{ route('manuais.download', $manual) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
                                                Download
                                            </a>
                                         @else
                                             {{-- Texto para não logado (pode ser um botão desabilitado) --}}
                                             <span class="inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-600 text-xs font-medium rounded-md text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-700 cursor-not-allowed" title="Faça login para baixar">
                                                Download
                                             </span>
                                             {{-- Ou apenas texto: --}}
                                             {{-- <span class="text-sm text-gray-400 dark:text-gray-500">(Login p/ Download)</span> --}}
                                         @endauth
                                     </div>
                                 </li>
                            @endforeach
                        </ul>

                        <div class="mt-6">
                            {{ $manuais->links() }} {{-- Links de paginação --}}
                        </div>
                    @else
                        <p class="text-center text-gray-500 dark:text-gray-400">Nenhum manual público encontrado.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 