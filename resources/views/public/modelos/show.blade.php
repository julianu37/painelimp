<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           <a href="{{ route('marcas.show', $modelo->marca) }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $modelo->marca->nome }}</a> / {{ $modelo->nome }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

             {{-- Detalhes do Modelo (se houver) --}}
             {{-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"> ... </div> --}}

            {{-- Códigos de Erro Associados --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Códigos de Erro Comuns</h3>
                    @if($modelo->codigosErro->isNotEmpty())
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($modelo->codigosErro as $codigo)
                                <li class="py-3">
                                    <a href="{{ route('codigos.show', $codigo) }}" class="hover:underline">
                                        <span class="font-semibold">{{ $codigo->codigo }}</span> - {{ Str::limit($codigo->descricao, 150) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum código de erro comum encontrado para este modelo.</p>
                    @endif
                </div>
            </div>

             {{-- Manuais Associados --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Manuais</h3>
                    @if($modelo->manuais->isNotEmpty())
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($modelo->manuais as $manual)
                                <li class="py-3 flex justify-between items-center">
                                     <span>{{ $manual->nome }} <span class="text-xs text-gray-500" title="{{ $manual->arquivo_nome_original }}">({{ Str::limit($manual->arquivo_nome_original, 30) }})</span></span>
                                     @auth
                                        <a href="{{ route('manuais.download', $manual) }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">Download</a>
                                     @else
                                        <span class="text-sm text-gray-400">(Login para Download)</span>
                                     @endauth
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum manual encontrado para este modelo.</p>
                    @endif
                </div>
            </div>

             {{-- Botão Voltar para a Marca --}}
            <div class="mt-6">
                 <a href="{{ route('marcas.show', $modelo->marca) }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    &laquo; Voltar para {{ $modelo->marca->nome }}
                </a>
                 <span class="mx-2 text-gray-400">|</span>
                 <a href="{{ route('modelos.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                     Ver Todos Modelos
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
