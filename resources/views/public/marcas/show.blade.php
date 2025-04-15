<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Marca:') }} {{ $marca->nome }}
        </h2>
    </x-slot>

    <div class="py-12">
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
                    @if($marca->modelos->isNotEmpty())
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($marca->modelos as $modelo)
                                <li class="py-3">
                                    <a href="{{ route('modelos.show', $modelo) }}" class="hover:underline">
                                        {{ $modelo->nome }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
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
</x-app-layout>
