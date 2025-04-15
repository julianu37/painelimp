<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-wrap sm:flex-nowrap justify-between items-center gap-2">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Gerenciar Modelos') }}
            </h2>
             {{-- Filtro por Marca (movido para o header) --}}
            <div class="flex items-center space-x-2">
                <label for="marca_id_filter" class="text-sm font-medium text-gray-700 dark:text-gray-300 whitespace-nowrap">Filtrar Marca:</label>
                <form method="GET" action="{{ route('admin.modelos.index') }}" class="flex items-center space-x-1">
                    <select id="marca_id_filter" name="marca_id" onchange="this.form.submit()" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm text-sm py-1.5">
                        <option value="">-- Todas --</option>
                        @foreach ($marcas as $id => $nomeMarca)
                            <option value="{{ $id }}" {{ request('marca_id') == $id ? 'selected' : '' }}>{{ $nomeMarca }}</option>
                        @endforeach
                    </select>
                    @if(request('marca_id'))
                        <a href="{{ route('admin.modelos.index') }}" class="text-xs text-red-500 hover:underline p-1" title="Limpar Filtro">&times;</a>
                    @endif
                </form>
            </div>
            {{-- Botão Adicionar --}}
            <a href="{{ route('admin.modelos.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 whitespace-nowrap">
                 <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                Novo Modelo
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-messages />

            {{-- Tabela de Modelos --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Marca</th>
                                <th scope="col" class="px-6 py-3">Modelo</th>
                                {{-- Exemplo de contagem: <th scope="col" class="px-6 py-3 text-center">Códigos</th> --}}
                                <th scope="col" class="px-6 py-3">Criado em</th>
                                <th scope="col" class="px-6 py-3 text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($modelos as $modelo)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">
                                        {{ $modelo->marca->nome ?? 'N/A' }}
                                    </td>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $modelo->nome }}
                                    </th>
                                    {{-- Exemplo: <td class="px-6 py-4 text-center">{{ $modelo->codigos_erro_count ?? 0 }}</td> --}}
                                    <td class="px-6 py-4">
                                        {{ $modelo->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                        {{-- Botão Editar --}}
                                        <a href="{{ route('admin.modelos.edit', $modelo) }}" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-900/50 dark:text-indigo-300 dark:hover:bg-indigo-800/50 dark:focus:ring-offset-gray-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                            Editar
                                        </a>
                                        {{-- Botão Excluir --}}
                                        <form action="{{ route('admin.modelos.destroy', $modelo) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja excluir este modelo?');">
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
                                            <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                            Nenhum modelo encontrado.
                                            @if(request('marca_id'))
                                                (Para a marca selecionada)
                                            @endif
                                            <a href="{{ route('admin.modelos.create', request()->only('marca_id')) }}" class="mt-2 text-sm text-indigo-600 dark:text-indigo-400 hover:underline">Adicionar o primeiro modelo</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Paginação --}}
                @if ($modelos->hasPages())
                    <div class="p-4 bg-gray-50 dark:bg-gray-700/50 border-t dark:border-gray-700">
                         {{ $modelos->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout> 