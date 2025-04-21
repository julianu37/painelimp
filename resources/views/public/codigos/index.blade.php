<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Códigos de Erro Comuns') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Barra de Busca Específica para Códigos --}}
            <div class="mb-6 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                <form action="{{ route('codigos.index') }}" method="GET" class="flex items-center space-x-3">
                    <input type="search"
                           name="busca_codigo"
                           placeholder="Buscar por código ou descrição..."
                           value="{{ request('busca_codigo') }}"
                           class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-cyan-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-700 focus:bg-cyan-700 active:bg-cyan-800 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Buscar
                    </button>
                    {{-- Link opcional para limpar busca --}}
                    @if(request('busca_codigo'))
                        <a href="{{ route('codigos.index') }}" class="text-sm text-gray-500 hover:text-gray-700 whitespace-nowrap">Limpar busca</a>
                    @endif
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($codigos->isNotEmpty())
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($codigos as $codigo)
                                <li class="py-4">
                                    {{-- Verifica se há modelo associado --}}
                                    @if ($codigo->modelos->isNotEmpty())
                                        @php $primeiroModelo = $codigo->modelos->first(); @endphp
                                        <a href="{{ route('modelos.codigos.show', [$primeiroModelo, $codigo]) }}" class="block hover:bg-gray-50 dark:hover:bg-gray-700 p-3 rounded-md transition">
                                            <h3 class="text-lg font-semibold text-indigo-600 dark:text-indigo-400">{{ $codigo->codigo }}</h3>
                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($codigo->descricao, 150) }}</p>
                                            {{-- Opcional: Mostrar nome do primeiro modelo --}}
                                            <span class="text-xs text-gray-400 dark:text-gray-500 mt-1 block">Modelo: {{ $primeiroModelo->nome }} @if($codigo->modelos->count() > 1)(e outros)@endif</span>
                                        </a>
                                    @else
                                        {{-- Exibe sem link se não houver modelo --}}
                                        <div class="p-3">
                                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">{{ $codigo->codigo }}</h3>
                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($codigo->descricao, 150) }}</p>
                                            <span class="text-xs text-red-500 dark:text-red-400 mt-1 block">Nenhum modelo associado</span>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        <div class="mt-6">
                            {{ $codigos->links() }} {{-- Links de paginação --}}
                        </div>
                    @else
                        <p class="text-center text-gray-500 dark:text-gray-400">Nenhum código de erro público encontrado.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 