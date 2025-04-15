<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Painel Administrativo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Bem-vindo(a) ao Painel Administrativo!") }}

                    {{-- TODO: Adicionar cards com contadores e links rápidos --}}
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                         <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow">
                             <h3 class="font-semibold mb-2">Gerenciamento</h3>
                             <ul class="text-sm space-y-1">
                                 <li><a href="{{ route('admin.marcas.index') }}" class="text-indigo-600 hover:underline">Marcas</a></li>
                                 <li><a href="{{ route('admin.modelos.index') }}" class="text-indigo-600 hover:underline">Modelos</a></li>
                                 <li><a href="{{ route('admin.codigos.index') }}" class="text-indigo-600 hover:underline">Códigos de Erro</a></li>
                                 <li><a href="{{ route('admin.solucoes.index') }}" class="text-indigo-600 hover:underline">Soluções</a></li>
                                 <li><a href="{{ route('admin.manuais.index') }}" class="text-indigo-600 hover:underline">Manuais</a></li>
                                 <li><a href="{{ route('admin.tecnicos.index') }}" class="text-indigo-600 hover:underline">Técnicos</a></li>
                                 {{-- <li><a href="{{ route('admin.imagens.index') }}" class="text-indigo-600 hover:underline">Imagens</a></li> --}}
                                 {{-- <li><a href="{{ route('admin.videos.index') }}" class="text-indigo-600 hover:underline">Vídeos</a></li> --}}
                             </ul>
                         </div>
                         {{-- Adicionar mais cards informativos aqui --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> 