<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Gerenciar Marcas') }}
            </h2>
            <a href="{{ route('admin.marcas.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                Nova Marca
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nome</th>
                                <th scope="col" class="px-6 py-3 text-center">Modelos</th>
                                <th scope="col" class="px-6 py-3">Criada em</th>
                                <th scope="col" class="px-6 py-3 text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($marcas as $marca)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $marca->nome }}
                                    </th>
                                    <td class="px-6 py-4 text-center">
                                        {{-- Certifique-se que a contagem é carregada no Controller: Marca::withCount('modelos') --}}
                                        {{ $marca->modelos_count ?? 0 }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $marca->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                        {{-- Botão Editar --}}
                                        <a href="{{ route('admin.marcas.edit', $marca) }}" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-900/50 dark:text-indigo-300 dark:hover:bg-indigo-800/50 dark:focus:ring-offset-gray-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                            Editar
                                        </a>
                                        {{-- Botão Excluir --}}
                                        <form action="{{ route('admin.marcas.destroy', $marca) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza? Todos os modelos associados serão excluídos!');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:bg-red-900/50 dark:text-red-300 dark:hover:bg-red-800/50 dark:focus:ring-offset-gray-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                                Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white dark:bg-gray-800">
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-5 5a2 2 0 01-2.828 0l-7-7A2 2 0 013 8V5c0-1.1.9-2 2-2h2z"></path></svg>
                                            Nenhuma marca encontrada.
                                            <a href="{{ route('admin.marcas.create') }}" class="mt-2 text-sm text-indigo-600 dark:text-indigo-400 hover:underline">Criar a primeira marca</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Paginação --}}
                @if ($marcas->hasPages())
                    <div class="p-4 bg-gray-50 dark:bg-gray-700/50 border-t dark:border-gray-700">
                        {{ $marcas->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout> 