<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Resultados da Busca por:') }} "{{ request('q') }}"
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Seção de Códigos de Erro --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Códigos de Erro Encontrados ({{ $codigosErro->count() }})</h3>
                    @if ($codigosErro->isNotEmpty())
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($codigosErro as $codigo)
                                <li class="py-3">
                                    <a href="{{ route('codigos.show', $codigo) }}" class="hover:underline">
                                        <span class="font-semibold">{{ $codigo->codigo }}</span> - {{ Str::limit($codigo->descricao, 150) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum código de erro encontrado.</p>
                    @endif
                </div>
            </div>

             {{-- SEÇÃO DE MODELOS ENCONTRADOS --}}
            <div class="mb-8 p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Modelos Encontrados ({{ $modelos->count() }})</h2>
                @if ($modelos->isNotEmpty())
                    <ul class="list-disc list-inside space-y-2 text-gray-700 dark:text-gray-300">
                        @foreach ($modelos as $modelo)
                            <li>
                                <a href="{{ route('modelos.show', $modelo) }}" class="text-indigo-600 hover:underline dark:text-indigo-400">
                                    {{ $modelo->nome }} ({{ $modelo->marca->nome ?? 'Marca desconhecida' }})
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 dark:text-gray-400">Nenhum modelo encontrado.</p>
                @endif
            </div>

            {{-- Seção de Manuais --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Manuais Encontrados ({{ $manuais->count() }})</h3>
                     @if ($manuais->isNotEmpty())
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($manuais as $manual)
                                <li class="py-3 flex flex-col sm:flex-row justify-between sm:items-center">
                                    <div>
                                        <span class="text-base font-medium text-gray-900 dark:text-gray-100">{{ $manual->nome }}</span>
                                        <p class="text-xs text-gray-500 dark:text-gray-400" title="{{ $manual->arquivo_nome_original }}">({{ Str::limit($manual->arquivo_nome_original, 40) }})</p>
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
                                             {{-- Botão Desabilitado --}}
                                             <span class="inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-600 text-xs font-medium rounded-md text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-700 cursor-not-allowed" title="Faça login para baixar">
                                                Download
                                            </span>
                                         @endauth
                                     </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum manual encontrado.</p>
                    @endif
                </div>
            </div>

            {{-- SEÇÃO DE MARCAS ENCONTRADAS --}}
            <div class="mb-8 p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Marcas Encontradas ({{ $marcas->count() }})</h2>
                @if ($marcas->isNotEmpty())
                    <ul class="list-disc list-inside space-y-2 text-gray-700 dark:text-gray-300">
                        @foreach ($marcas as $marca)
                            <li>
                                <a href="{{ route('marcas.show', $marca) }}" class="text-indigo-600 hover:underline dark:text-indigo-400">
                                    {{ $marca->nome }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 dark:text-gray-400">Nenhuma marca encontrada.</p>
                @endif
            </div>

            {{-- Link Voltar (opcional) --}}
            <div class="mt-6">
                 <a href="{{ url()->previous() }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    &laquo; Voltar
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
