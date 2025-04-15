<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modelos de Equipamentos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($modelos->isNotEmpty())
                        {{-- Agrupa por marca para exibição --}}
                        @php
                            $modelosAgrupados = $modelos->groupBy('marca.nome');
                        @endphp

                        @foreach ($modelosAgrupados as $nomeMarca => $modelosDaMarca)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-3 border-b pb-2 dark:border-gray-700">{{ $nomeMarca ?: 'Marca Desconhecida' }}</h3>
                                <ul class="space-y-2">
                                    @foreach ($modelosDaMarca as $modelo)
                                        <li>
                                            <a href="{{ route('modelos.show', $modelo) }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                                {{ $modelo->nome }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach

                        {{-- Links de Paginação --}}
                        <div class="mt-6">
                            {{ $modelos->links() }}
                        </div>
                    @else
                        <p class="text-center text-gray-500 dark:text-gray-400">Nenhum modelo encontrado.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
