<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Marcas de Equipamentos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($marcas->isNotEmpty())
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($marcas as $marca)
                                <li class="py-4 flex justify-between items-center">
                                    <a href="{{ route('marcas.show', $marca) }}" class="text-lg font-medium text-blue-600 dark:text-blue-400 hover:underline">
                                        {{ $marca->nome }}
                                    </a>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">({{ $marca->modelos_count }} {{ Str::plural('modelo', $marca->modelos_count) }})</span>
                                </li>
                            @endforeach
                        </ul>

                        {{-- Links de Paginação --}}
                        <div class="mt-6">
                            {{ $marcas->links() }}
                        </div>
                    @else
                        <p class="text-center text-gray-500 dark:text-gray-400">Nenhuma marca encontrada.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
