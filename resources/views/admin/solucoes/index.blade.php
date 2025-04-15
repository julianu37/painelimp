<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gerenciar Soluções') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-messages />

            <div class="flex justify-between items-center mb-4">
                {{-- TODO: Adicionar filtro por Código de Erro --}}
                <div>
                    {{-- <label for="filter_codigo" class="text-sm text-gray-600 dark:text-gray-400">Filtrar por Código:</label>
                    <select id="filter_codigo" name="filter_codigo" onchange="window.location.href='{{ route('admin.solucoes.index') }}?codigo_erro_id='+this.value"
                            class="ml-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm text-sm">
                        <option value="">Todos</option>
                        @foreach ($codigosErro as $id => $codigo)
                            <option value="{{ $id }}" {{ request('codigo_erro_id') == $id ? 'selected' : '' }}>{{ $codigo }}</option>
                        @endforeach
                    </select> --}}
                </div>
                <a href="{{ route('admin.solucoes.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Adicionar Solução
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Título</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Código Associado</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Criada em</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Ações</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($solucoes as $solucao)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-900 dark:text-white">{{ $solucao->titulo }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            <a href="{{ route('admin.codigos.show', $solucao->codigoErro) }}" class="underline hover:text-indigo-500">
                                                {{ $solucao->codigoErro->codigo ?? 'N/A' }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $solucao->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.solucoes.show', $solucao) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 mr-3">Ver</a>
                                            <a href="{{ route('admin.solucoes.edit', $solucao) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Editar</a>
                                            <form action="{{ route('admin.solucoes.destroy', $solucao) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja excluir esta solução? Imagens e vídeos associados NÃO serão excluídos automaticamente.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">Nenhuma solução encontrada.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $solucoes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> 