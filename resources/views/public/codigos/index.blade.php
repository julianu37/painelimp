<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Códigos de Erro Comuns') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- TODO: Adicionar Barra de Busca/Filtros --}}

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($codigos->isNotEmpty())
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($codigos as $codigo)
                                <li class="py-4">
                                    <a href="{{ route('codigos.show', $codigo) }}" class="block hover:bg-gray-50 dark:hover:bg-gray-700 p-3 rounded-md transition">
                                        <h3 class="text-lg font-semibold text-indigo-600 dark:text-indigo-400">{{ $codigo->codigo }}</h3>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($codigo->descricao, 150) }}</p>
                                    </a>
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