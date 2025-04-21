<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
             {{ __('Manuais para:') }} {{ $modelo->nome }} (@if($modelo->marca)<a href="{{ route('marcas.show', $modelo->marca) }}" class="text-cyan-600 hover:underline">{{ $modelo->marca->nome }}</a>@endif)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Botão Voltar --}}
             <div class="mb-4">
                 <a href="{{ route('modelos.show', $modelo) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    &larr; Voltar para {{ $modelo->nome }}
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($manuais->isNotEmpty())
                        <ul class="divide-y divide-gray-200">
                            @foreach ($manuais as $manual)
                                <li class="py-4 flex flex-col sm:flex-row justify-between sm:items-center">
                                    <div>
                                        <span class="text-lg font-medium text-gray-900">{{ $manual->nome }}</span>
                                        <p class="text-sm text-gray-500" title="{{ $manual->arquivo_nome_original }}">
                                            Arquivo: {{ Str::limit($manual->arquivo_nome_original, 50) }}
                                        </p>
                                    </div>
                                    <div class="mt-2 sm:mt-0 sm:ml-4 flex-shrink-0 flex space-x-2">
                                         {{-- Botão Visualizar --}}
                                         <a href="{{ route('manuais.view', $manual) }}" target="_blank" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            Visualizar
                                        </a>
                                         @auth
                                            {{-- Botão Download --}}
                                            <a href="{{ route('manuais.download', $manual) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Download
                                            </a>
                                         @else
                                             {{-- Botão desabilitado --}}
                                             <span class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-400 bg-gray-100 cursor-not-allowed" title="Faça login para baixar">
                                                Download
                                             </span>
                                         @endauth
                                     </div>
                                 </li>
                            @endforeach
                        </ul>

                        <div class="mt-6">
                            {{ $manuais->links('pagination::tailwind') }} {{-- Links de paginação --}}
                        </div>
                    @else
                        <p class="text-center text-gray-500">Nenhum manual encontrado para este modelo.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 