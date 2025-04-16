<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Painel do Técnico') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Boas Vindas e Busca Rápida --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-2">Bem-vindo(a), {{ Auth::user()->name }}!</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Utilize a busca abaixo ou navegue pelas seções recentes.</p>
                    {{-- Formulário de Busca Rápida --}}
                    <form action="{{ route('busca.index') }}" method="GET" class="flex">
                        <input type="text" name="q" placeholder="Buscar por código, manual, marca ou modelo..." class="flex-grow rounded-l-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:focus:border-indigo-600 dark:focus:ring-indigo-500/50" required>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-r-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                            Buscar
                        </button>
                    </form>
                </div>
            </div>

            {{-- Grade de Itens Recentes --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                {{-- Últimos Códigos de Erro --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border dark:border-gray-700">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 px-4 py-3 border-b dark:border-gray-700">Últimos Códigos</h3>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700 max-h-80 overflow-y-auto">
                        @forelse ($ultimosCodigos as $codigo)
                            <li class="px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <a href="{{ route('codigos.show', $codigo) }}" class="block text-sm text-indigo-600 dark:text-indigo-400 hover:underline truncate" title="{{ $codigo->descricao }}">
                                    <span class="font-medium">{{ $codigo->codigo }}</span> - {{ Str::limit($codigo->descricao, 40) }}
                                </a>
                                <span class="text-xs text-gray-400 dark:text-gray-500 block">{{ $codigo->created_at->diffForHumans(null, true) }}</span>
                            </li>
                        @empty
                            <li class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">Nenhum código encontrado.</li>
                        @endforelse
                    </ul>
                </div>

                 {{-- Últimos Manuais --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border dark:border-gray-700">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 px-4 py-3 border-b dark:border-gray-700">Últimos Manuais</h3>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700 max-h-80 overflow-y-auto">
                        @forelse ($ultimosManuais as $manual)
                            <li class="px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <a href="{{ route('manuais.view', $manual) }}" target="_blank" class="block text-sm text-indigo-600 dark:text-indigo-400 hover:underline truncate" title="{{ $manual->arquivo_nome_original }}">
                                   {{ $manual->nome }}
                                </a>
                                @if($manual->modelo)
                                <span class="text-xs text-gray-400 dark:text-gray-500 block truncate">{{ $manual->modelo->nome }} @if($manual->modelo->marca) ({{ $manual->modelo->marca->nome }}) @endif</span>
                                @endif
                                <span class="text-xs text-gray-400 dark:text-gray-500 block">{{ $manual->created_at->diffForHumans(null, true) }}</span>
                            </li>
                        @empty
                             <li class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">Nenhum manual encontrado.</li>
                        @endforelse
                    </ul>
                </div>

                {{-- Últimos Comentários --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border dark:border-gray-700">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 px-4 py-3 border-b dark:border-gray-700">Últimos Comentários</h3>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700 max-h-80 overflow-y-auto">
                        @forelse ($ultimosComentarios as $comentario)
                            <li class="px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <p class="text-sm text-gray-700 dark:text-gray-300 mb-0.5 truncate">{{ Str::limit($comentario->conteudo, 60) }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Por: <span class="font-medium">{{ $comentario->user->name ?? 'N/A' }}</span>
                                    @if ($comentario->comentavel && $comentario->comentavel instanceof \App\Models\CodigoErro) {{-- Verifica se é um CodigoErro --}}
                                        em <a href="{{ route('codigos.show', $comentario->comentavel) }}" class="text-indigo-500 hover:underline">{{ $comentario->comentavel->codigo ?? 'Item removido' }}</a>
                                    @elseif ($comentario->comentavel)
                                         em {{ class_basename($comentario->comentavel) }} {{-- Ou outra identificação --}}
                                    @endif
                                </p>
                                <span class="text-xs text-gray-400 dark:text-gray-500 block">{{ $comentario->created_at->diffForHumans(null, true) }}</span>
                            </li>
                        @empty
                             <li class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">Nenhum comentário recente.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            {{-- Acesso Rápido --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Acesso Rápido</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                         <a href="{{ route('codigos.index') }}" class="block p-4 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-150">
                            <svg class="w-8 h-8 mx-auto mb-2 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.008v.008H12v-.008Z" /></svg>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Ver Códigos</span>
                        </a>
                         <a href="{{ route('manuais.index') }}" class="block p-4 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-150">
                             <svg class="w-8 h-8 mx-auto mb-2 text-cyan-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18c-2.305 0-4.408.867-6 2.292m0-14.25v14.25" /></svg>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Ver Manuais</span>
                        </a>
                        <a href="{{ route('marcas.index') }}" class="block p-4 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-150">
                             <svg class="w-8 h-8 mx-auto mb-2 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h6.75M9 11.25h6.75M9 15.75h6.75M9 20.25h6.75" /></svg>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Ver Marcas</span>
                        </a>
                        <a href="{{ route('modelos.index') }}" class="block p-4 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-150">
                             <svg class="w-8 h-8 mx-auto mb-2 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75V18.75M15.75 18.75h3.75M15 12.75H9M15 16.75H9M18.75 18a2.25 2.25 0 0 1-2.25 2.25H7.5a2.25 2.25 0 0 1-2.25-2.25V6.108c0-1.135.845-2.098 1.976-2.192a48.424 48.424 0 0 1 1.123-.08M18.75 18.75V18.75M6.25 18.75h3.75M3 12.75h.008v.008H3v-.008Zm0 4h.008v.008H3v-.008Z" /></svg>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Ver Modelos</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
