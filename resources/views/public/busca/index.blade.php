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

            {{-- Seção de Manuais --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Manuais Encontrados ({{ $manuais->count() }})</h3>
                     @if ($manuais->isNotEmpty())
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($manuais as $manual)
                                <li class="py-3">
                                    {{-- Link para download se logado, ou apenas mostra o nome --}}
                                    @auth
                                    <a href="{{ route('manuais.download', $manual) }}" class="hover:underline">
                                        {{-- Corrigido para exibir nome --}}
                                        {{ $manual->nome }} {{-- Adicionar modelo/marca se útil --}}
                                    </a>
                                    @else
                                    {{-- Corrigido para exibir nome --}}
                                    <span>{{ $manual->nome }}</span>
                                    @endauth
                                     <p class="text-xs text-gray-500" title="{{ $manual->arquivo_nome_original }}">({{ Str::limit($manual->arquivo_nome_original, 40) }})</p> {{-- Mostra nome original do arquivo --}}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum manual encontrado.</p>
                    @endif
                </div>
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
