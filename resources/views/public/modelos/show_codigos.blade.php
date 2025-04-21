<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
            {{ __('Códigos de Erro para:') }} {{ $modelo->nome }} (@if($modelo->marca)<a href="{{ route('marcas.show', $modelo->marca) }}" class="text-cyan-600 hover:underline">{{ $modelo->marca->nome }}</a>@endif)
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

            {{-- Formulário de Busca --}}
            <div class="mb-4">
                <form action="{{ route('modelos.show.codigos', $modelo) }}" method="GET" class="flex items-center space-x-2">
                    <input type="text"
                           name="busca_codigo"
                           value="{{ $buscaCodigo ?? '' }}"
                           placeholder="Buscar por código ou descrição..."
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500 sm:text-sm">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-cyan-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-700 focus:bg-cyan-700 active:bg-cyan-800 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Buscar
                    </button>
                    {{-- Botão Limpar (opcional) --}}
                    @if(request()->has('busca_codigo') && request('busca_codigo') != '')
                        <a href="{{ route('modelos.show.codigos', $modelo) }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                           Limpar
                        </a>
                    @endif
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($codigosErro->isNotEmpty())
                        <ul class="divide-y divide-gray-200">
                            @foreach ($codigosErro as $codigo)
                                <li class="py-4">
                                    <a href="{{ route('modelos.codigos.show', [$modelo, $codigo]) }}" class="block hover:bg-gray-50 p-3 rounded-md transition">
                                        <h3 class="text-lg font-semibold text-cyan-600">{{ $codigo->codigo }}</h3>
                                        <p class="mt-1 text-sm text-gray-600">{{ Str::limit($codigo->descricao, 150) }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="mt-6">
                            {{ $codigosErro->links('pagination::tailwind') }} {{-- Links de paginação --}}
                        </div>
                    @else
                        <p class="text-center text-gray-500">Nenhum código de erro público encontrado para este modelo.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 