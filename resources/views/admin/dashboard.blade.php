<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Administrativo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Grade de Estatísticas --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                {{-- Card Técnicos --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-5 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Técnicos</dt>
                            <dd class="text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalTecnicos }}</dd>
                        </div>
                    </div>
                     <div class="mt-4 text-sm">
                        <a href="{{ route('admin.tecnicos.index') }}" class="font-medium text-blue-600 dark:text-blue-400 hover:underline">Gerenciar Técnicos &rarr;</a>
                    </div>
                </div>

                 {{-- Card Marcas --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-5 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                             <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Marcas</dt>
                            <dd class="text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalMarcas }}</dd>
                        </div>
                    </div>
                    <div class="mt-4 text-sm">
                        <a href="{{ route('admin.marcas.index') }}" class="font-medium text-green-600 dark:text-green-400 hover:underline">Gerenciar Marcas &rarr;</a>
                    </div>
                </div>

                {{-- Card Modelos --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-5 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10em-1 .5-2 2.5c.5 1.5 1.5 2.5 3 3l-3.5 3.5a1 1 0 01-1.414 0l-3.5-3.5a1 1 0 010-1.414l3.5-3.5a1 1 0 011.414 0l3.5 3.5c1.5-1 2.5-2 3-3 .5-1 .5-2-1-3.5zM15 5a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Modelos</dt>
                            <dd class="text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalModelos }}</dd>
                        </div>
                    </div>
                    <div class="mt-4 text-sm">
                        <a href="{{ route('admin.modelos.index') }}" class="font-medium text-yellow-600 dark:text-yellow-400 hover:underline">Gerenciar Modelos &rarr;</a>
                    </div>
                </div>

                 {{-- Card Códigos de Erro --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-5 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                             <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Códigos de Erro</dt>
                            <dd class="text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalCodigos }}</dd>
                        </div>
                    </div>
                     <div class="mt-4 text-sm">
                        <a href="{{ route('admin.codigos.index') }}" class="font-medium text-red-600 dark:text-red-400 hover:underline">Gerenciar Códigos &rarr;</a>
                    </div>
                </div>

                {{-- Card Manuais --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-5 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-cyan-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Manuais</dt>
                            <dd class="text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalManuais }}</dd>
                        </div>
                    </div>
                    <div class="mt-4 text-sm">
                        <a href="{{ route('admin.manuais.index') }}" class="font-medium text-cyan-600 dark:text-cyan-400 hover:underline">Gerenciar Manuais &rarr;</a>
                    </div>
                </div>

                {{-- Card Comentários --}}
                 <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-5 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-pink-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Comentários</dt>
                            <dd class="text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalComentarios }}</dd>
                        </div>
                    </div>
                    {{-- <div class="mt-4 text-sm">
                        <a href="#" class="font-medium text-pink-600 dark:text-pink-400 hover:underline">Gerenciar Comentários &rarr;</a>
                    </div> --}}
                 </div>

                 {{-- Card Adicionar Rápido (Exemplo) --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-5 border border-gray-200 dark:border-gray-700 flex flex-col justify-center items-center">
                     <a href="{{ route('admin.codigos.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 w-full mb-3 text-center">
                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Novo Código
                    </a>
                </div>
            </div>

            {{-- Seção de Itens Recentes --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Últimos Códigos de Erro --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 px-6 py-4 border-b dark:border-gray-700">Últimos Códigos Adicionados</h3>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($ultimosCodigos as $codigo)
                            <li class="px-6 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <div class="flex justify-between items-center">
                                    @if ($codigo->modelos->isNotEmpty())
                                        @php $primeiroModelo = $codigo->modelos->first(); @endphp
                                        <a href="{{ route('modelos.codigos.show', [$primeiroModelo, $codigo]) }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline truncate pr-4" title="{{ $codigo->descricao }}">
                                            {{ $codigo->codigo }} - {{ Str::limit($codigo->descricao, 60) }}
                                        </a>
                                    @else
                                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate pr-4" title="{{ $codigo->descricao }} (Sem modelo associado)">
                                            {{ $codigo->codigo }} - {{ Str::limit($codigo->descricao, 60) }}
                                        </span>
                                    @endif
                                    <span class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">{{ $codigo->created_at->diffForHumans(null, true) }}</span>
                                </div>
                            </li>
                        @empty
                            <li class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">Nenhum código de erro encontrado.</li>
                        @endforelse
                    </ul>
                     <div class="px-6 py-3 border-t dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50 text-right">
                        <a href="{{ route('admin.codigos.index') }}" class="text-xs font-medium text-indigo-600 dark:text-indigo-400 hover:underline">Ver Todos &rarr;</a>
                    </div>
                </div>

                {{-- Últimos Comentários --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 px-6 py-4 border-b dark:border-gray-700">Últimos Comentários</h3>
                     <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($ultimosComentarios as $comentario)
                             <li class="px-6 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <div class="flex justify-between items-start">
                                    <div class="text-sm flex-1 pr-4">
                                        <p class="text-gray-700 dark:text-gray-300 mb-1">{{ Str::limit($comentario->conteudo, 100) }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            Por: <span class="font-medium">{{ $comentario->user->name ?? 'N/A' }}</span>
                                            @if ($comentario->comentavel instanceof \App\Models\CodigoErro)
                                                @if ($comentario->comentavel->modelos->isNotEmpty())
                                                    @php $primeiroModeloComentario = $comentario->comentavel->modelos->first(); @endphp
                                                    em <a href="{{ route('modelos.codigos.show', [$primeiroModeloComentario, $comentario->comentavel]) }}" class="text-indigo-500 hover:underline">{{ $comentario->comentavel->codigo ?? 'Item removido' }}</a>
                                                @else
                                                    em {{ $comentario->comentavel->codigo ?? 'Item removido' }} (Sem modelo)
                                                @endif
                                            @elseif ($comentario->comentavel)
                                                em {{ class_basename($comentario->comentavel) }}
                                            @endif
                                        </p>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">{{ $comentario->created_at->diffForHumans(null, true) }}</span>
                                </div>
                            </li>
                        @empty
                             <li class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">Nenhum comentário recente.</li>
                        @endforelse
                    </ul>
                    {{-- Link para gerenciar comentários pode ser adicionado se houver uma rota --}}
                    {{-- <div class="px-6 py-3 border-t dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50 text-right">
                        <a href="#" class="text-xs font-medium text-indigo-600 dark:text-indigo-400 hover:underline">Gerenciar Comentários &rarr;</a>
                    </div> --}}
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>