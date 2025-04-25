<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           <a href="{{ route('marcas.show', $modelo->marca) }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $modelo->marca->nome }}</a> / {{ $modelo->nome }}
        </h2>
    </x-slot>

    {{-- Breadcrumbs --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol role="list" class="flex items-center space-x-4 text-sm">
                <li>
                    <div>
                        <a href="{{ route('home') }}" class="text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-300">
                            <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Home</span>
                        </a>
                    </div>
                </li>
                 <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-300 dark:text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                        </svg>
                        <a href="{{ route('marcas.index') }}" class="ml-4 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">Marcas</a>
                    </div>
                </li>
                 <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-300 dark:text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                        </svg>
                        <a href="{{ route('marcas.show', $modelo->marca) }}" class="ml-4 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">{{ $modelo->marca->nome }}</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-300 dark:text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                        </svg>
                        <span class="ml-4 text-sm font-medium text-gray-700 dark:text-gray-200">{{ $modelo->nome }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- MOVIDO P/ CIMA: Formulário de Busca nos Manuais do Modelo --}}
            <div class="mb-8 pb-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Buscar em Manuais de {{ $modelo->nome }}</h3>
                {{-- Voltando ao estilo anterior: flex com input e botão --}}
                <form action="{{ route('modelos.show', $modelo) }}" method="GET" class="flex items-center space-x-3 mb-6 max-w-xl">
                    <input type="search"
                           name="q_modelo"
                           placeholder="Digite código ou termo para buscar nos manuais..."
                           value="{{ $queryBuscaManual ?? '' }}"
                           {{-- Restaurando classes anteriores --}}
                           class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:focus:border-indigo-600 dark:focus:ring-indigo-500/50">
                    <button type="submit"
                            {{-- Restaurando classes do botão de texto --}}
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Buscar
                    </button>
                    {{-- Restaurando link Limpar dentro do form --}}
                    @if($queryBuscaManual)
                        <a href="{{ route('modelos.show', $modelo) }}" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 whitespace-nowrap">Limpar</a>
                    @endif
                </form>
                {{-- Removido: Link limpar separado --}}
                {{-- @if($queryBuscaManual)
                    <div class="max-w-xl text-right">
                        <a href="{{ route('modelos.show', $modelo) }}" class="text-xs text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 whitespace-nowrap">Limpar busca</a>
                    </div>
                @endif --}}

                {{-- Resultados da Busca (removendo mt-4 adicionado) --}}
                @if(isset($queryBuscaManual) && !empty($queryBuscaManual))
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg max-w-xl"> {{-- Mantendo max-w-xl para consistência --}}
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h4 class="text-lg font-medium mb-4">Resultados da busca por "{{ $queryBuscaManual }}" ({{ $resultadosBuscaManualModelo->count() }})</h4>
                            @if ($resultadosBuscaManualModelo->isNotEmpty())
                                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($resultadosBuscaManualModelo as $ref)
                                        @if ($ref->manual) {{-- Segurança extra --}}
                                            <li class="py-3">
                                                <div class="flex justify-between items-center">
                                                    <div>
                                                        <span class="font-semibold text-indigo-600 dark:text-indigo-400">{{ $ref->codigo_encontrado }}</span>
                                                        encontrado em
                                                        <a href="{{ route('manuais.view', ['manual' => $ref->manual->slug, 'page' => $ref->numero_pagina]) }}"
                                                           target="_blank"
                                                           class="font-semibold underline hover:text-indigo-500">
                                                            {{ $ref->manual->nome }}
                                                        </a>
                                                        (página {{ $ref->numero_pagina }})
                                                    </div>
                                                    <a href="{{ route('manuais.view', ['manual' => $ref->manual->slug, 'page' => $ref->numero_pagina]) }}"
                                                        target="_blank"
                                                        class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                        Abrir PDF &rarr;
                                                    </a>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-sm text-gray-500 dark:text-gray-400 italic">Nenhuma ocorrência encontrada nos PDFs indexados para este modelo.</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            {{-- Grid para os cards (agora só Manuais) --}}
            {{-- Adicionei mt-8 para separar da busca --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">

                {{-- Card Manuais --}}
                {{-- Verificando o botão Ver Manuais --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-medium mb-2">Manuais</h3>
                        @if($modelo->manuais_count > 0)
                            <p class="text-sm text-gray-600 mb-4">
                                {{ $modelo->manuais_count }} {{ Str::plural('manual', $modelo->manuais_count) }} disponível{{ Str::plural('s', $modelo->manuais_count) }} para este modelo.
                            </p>
                            {{-- Botão Ver Manuais --}}
                            <a href="{{ route('modelos.show.manuais', $modelo) }}" class="inline-flex items-center px-4 py-2 bg-cyan-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-700 focus:bg-cyan-700 active:bg-cyan-800 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Ver Manuais &rarr;
                            </a>
                        @else
                            <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum manual encontrado para este modelo.</p>
                        @endif
                    </div>
                </div>

                {{-- Espaço vazio ou outro card informativo --}}
                <div></div>

            </div> {{-- Fim do grid --}}

            {{-- Botão Voltar --}}
            <div class="mt-8">
                <a href="{{ route('marcas.show', $modelo->marca) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    &larr; Voltar para {{ $modelo->marca->nome }}
                </a>
                <span class="mx-2 text-gray-400">|</span>
                <a href="{{ route('modelos.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    Ver Todos Modelos
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
