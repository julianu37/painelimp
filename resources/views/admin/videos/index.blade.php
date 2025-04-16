<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gerenciar Vídeos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end items-center mb-4">
                 <a href="{{ route('admin.videos.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Adicionar Vídeo
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Título / URL</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tipo</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Associado a</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Criado em</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Ações</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($videos as $video)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $video->titulo ?? ($video->tipo === 'link' ? $video->url_ou_path : 'Arquivo de Vídeo') }}
                                            @if ($video->tipo === 'link')
                                                <a href="{{ $video->url_ou_path }}" target="_blank" class="text-blue-500 hover:underline ml-1">(link externo)</a>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ Str::ucfirst($video->tipo) }}</td>
                                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            @if ($video->videoable)
                                                @php
                                                    $tipo = class_basename($video->videoable_type);
                                                    $rota = '#';
                                                    if ($tipo === 'Manual') {
                                                        $rota = route('admin.manuais.show', $video->videoable_id);
                                                    } elseif ($tipo === 'Solucao') {
                                                        $rota = route('admin.solucoes.show', $video->videoable_id);
                                                    }
                                                @endphp
                                                <a href="{{ $rota }}" class="underline hover:text-indigo-500">{{ $tipo }} #{{ $video->videoable_id }}</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $video->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.videos.edit', $video) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Editar</a>
                                            <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja excluir este vídeo? Esta ação não pode ser desfeita.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">Nenhum vídeo encontrado.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $videos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> 