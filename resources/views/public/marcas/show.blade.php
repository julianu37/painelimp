<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Marca:') }} {{ $marca->nome }}
        </h2>
    </x-slot>

    {{-- Breadcrumbs --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol role="list" class="flex items-center space-x-4 text-sm list-none">
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
                        <span class="ml-4 text-sm font-medium text-gray-700 dark:text-gray-200">{{ $marca->nome }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Detalhes da Marca (se houver, ex: descrição, logo) --}}
            {{-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"> --}}
            {{--     <div class="p-6 text-gray-900 dark:text-gray-100"> --}}
            {{--         <h3 class="text-lg font-medium mb-2">Sobre a Marca</h3> --}}
            {{--         <p>{{ $marca->descricao ?? 'Sem descrição.' }}</p> --}}
            {{--     </div> --}}
            {{-- </div> --}}

            {{-- Modelos Associados --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Modelos da {{ $marca->nome }}</h3>

                    {{-- Adiciona campo de filtro --}}
                    <div class="mb-4">
                        <label for="filtro-modelo-marca" class="sr-only">Filtrar modelos</label>
                        <input type="search"
                               id="filtro-modelo-marca"
                               placeholder="Filtrar modelos desta marca..."
                               class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                    </div>

                    {{-- Adiciona ID ao container UL e data-nome aos LI --}}
                    @if($marca->modelos->isNotEmpty())
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700" id="lista-modelos-marca">
                            @foreach ($marca->modelos as $modelo)
                                <li class="py-3 item-modelo-marca" data-modelo-nome="{{ strtolower($modelo->nome) }}">
                                    <a href="{{ route('modelos.show', $modelo) }}" class="hover:underline">
                                        {{ $modelo->nome }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        {{-- Mensagem a ser exibida se o filtro não encontrar nada --}}
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-4" id="mensagem-filtro-vazio" style="display: none;">Nenhum modelo encontrado com este filtro.</p>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum modelo encontrado para esta marca.</p>
                    @endif
                </div>
            </div>

             {{-- Botão Voltar --}}
            <div class="mt-6">
                 <a href="{{ route('marcas.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    &laquo; Voltar para Lista de Marcas
                </a>
            </div>

        </div>
    </div>

{{-- Script para filtro em tempo real --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filtroInput = document.getElementById('filtro-modelo-marca');
        const listaModelos = document.getElementById('lista-modelos-marca');
        const mensagemFiltroVazio = document.getElementById('mensagem-filtro-vazio');

        // Certifica-se que a lista existe antes de adicionar o listener
        if (listaModelos && filtroInput) {
            const itensModelo = listaModelos.querySelectorAll('.item-modelo-marca');

            filtroInput.addEventListener('input', function() {
                const termoFiltro = filtroInput.value.toLowerCase().trim();
                let algumVisivel = false;

                itensModelo.forEach(function(item) {
                    const nomeModelo = item.dataset.modeloNome || '';

                    if (nomeModelo.includes(termoFiltro)) {
                        item.style.display = ''; // Mostra o item li
                        algumVisivel = true;
                    } else {
                        item.style.display = 'none'; // Esconde o item li
                    }
                });

                // Mostra/esconde a mensagem de filtro vazio
                if (mensagemFiltroVazio) {
                    mensagemFiltroVazio.style.display = algumVisivel ? 'none' : 'block';
                }
            });
        }
    });
</script>
</x-app-layout>
