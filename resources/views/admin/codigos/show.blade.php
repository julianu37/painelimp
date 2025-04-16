<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detalhes do Código de Erro:') }} {{ $codigoErro->codigo }}
            </h2>
             <a href="{{ route('admin.codigos.edit', $codigoErro) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                Editar Código
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
             {{-- Detalhes do Código de Erro --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-2">Informações do Código</h3>
                    <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                        <div class="py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Código</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{ $codigoErro->codigo }}</dd>
                        </div>
                        <div class="py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Descrição</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2 whitespace-pre-wrap">{{ $codigoErro->descricao }}</dd>
                        </div>
                        <div class="py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Modelos Afetados</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                @forelse($codigoErro->modelos as $modelo)
                                    <span class="inline-block bg-gray-200 dark:bg-gray-700 rounded-full px-2 py-0.5 text-xs font-semibold text-gray-700 dark:text-gray-300 mr-1 mb-1">
                                        {{ $modelo->marca->nome ?? '' }} {{ $modelo->nome }}
                                    </span>
                                @empty
                                    Todos / Genérico
                                @endforelse
                            </dd>
                        </div>
                        <div class="py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Público</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{ $codigoErro->publico ? 'Sim' : 'Não' }}</dd>
                        </div>
                        <div class="py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Criado em</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{ $codigoErro->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div class="py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Atualizado em</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{ $codigoErro->updated_at->format('d/m/Y H:i') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            {{-- Soluções Associadas --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Soluções Associadas</h3>
                         <a href="{{ route('admin.solucoes.create', ['codigo_erro_id' => $codigoErro->id]) }}" class="text-sm text-blue-600 hover:underline">Adicionar Solução</a>
                    </div>
                    @if ($codigoErro->solucoes->isNotEmpty())
                       <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                           @foreach ($codigoErro->solucoes as $solucao)
                               <li class="py-3 flex justify-between items-center">
                                   <a href="{{ route('admin.solucoes.show', $solucao) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 truncate" title="{{ $solucao->titulo }}">
                                        {{ $solucao->titulo }}
                                   </a>
                                   <span class="text-xs text-gray-500 dark:text-gray-400">Criada em {{ $solucao->created_at->format('d/m/y') }}</span>
                               </li>
                           @endforeach
                       </ul>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhuma solução associada a este código de erro.</p>
                    @endif
                </div>
            </div>

            {{-- Botão Voltar --}}
            <div class="mt-6">
                 <a href="{{ route('admin.codigos.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    &laquo; Voltar para Lista
                </a>
            </div>

        </div>
    </div>
</x-admin-layout> 