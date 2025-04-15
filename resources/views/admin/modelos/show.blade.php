<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detalhes do Modelo:') }} {{ $modelo->marca->nome }} {{ $modelo->nome }}
            </h2>
             <a href="{{ route('admin.modelos.edit', $modelo) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                Editar Modelo
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
             <x-alert-messages />

             {{-- Detalhes --}}
             <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-2">Informações</h3>
                    <p>Marca: {{ $modelo->marca->nome }}</p>
                    <p>Modelo: {{ $modelo->nome }}</p>
                    <p>Criado em: {{ $modelo->created_at->format('d/m/Y H:i') }}</p>
                 </div>
             </div>

             {{-- Manuais Associados --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Manuais Associados</h3>
                         {{-- Ativa o link para adicionar manual JÁ associado a este modelo --}}
                         <a href="{{ route('admin.manuais.create', ['modelo_id' => $modelo->id]) }}" class="text-sm text-blue-600 hover:underline">Adicionar Manual</a>
                    </div>
                    @if ($modelo->manuais->isNotEmpty())
                       <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                           @foreach ($modelo->manuais as $manual)
                               <li class="py-2 flex justify-between items-center">
                                   <a href="{{ route('admin.manuais.edit', $manual) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 truncate" title="{{ $manual->nome }}">
                                        {{ $manual->nome }}
                                   </a>
                               </li>
                           @endforeach
                       </ul>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum manual associado a este modelo.</p>
                    @endif
                </div>
            </div>

             {{-- Códigos de Erro Associados --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Códigos de Erro Associados</h3>
                         {{-- Não há link direto para adicionar código, pois a associação é feita no form do código --}}
                    </div>
                    @if ($modelo->codigosErro->isNotEmpty())
                       <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                           @foreach ($modelo->codigosErro as $codigoErro)
                               <li class="py-2 flex justify-between items-center">
                                   <a href="{{ route('admin.codigos.show', $codigoErro) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 truncate" title="{{ $codigoErro->descricao }}">
                                        {{ $codigoErro->codigo }}
                                   </a>
                               </li>
                           @endforeach
                       </ul>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum código de erro associado a este modelo.</p>
                    @endif
                </div>
            </div>

            {{-- Imagens Associadas --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Imagens Associadas</h3>
                        {{-- <a href="{{ route('admin.imagens.create', ['attachable_type' => App\Models\Modelo::class, 'attachable_id' => $modelo->id]) }}" class="text-sm text-blue-600 hover:underline">Adicionar Imagem</a> --}}
                         <span class="text-xs text-gray-500">(Funcionalidade Adicionar Pendente)</span>
                    </div>
                    @if ($modelo->imagens->isNotEmpty())
                       <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            @foreach ($modelo->imagens as $imagem)
                                <div class="relative group">
                                    <img src="{{ Storage::url($imagem->path) }}" alt="{{ $imagem->titulo }}" class="w-full h-32 object-cover rounded-md shadow-md">
                                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity duration-300 rounded-md">
                                        <a href="{{ route('admin.imagens.edit', $imagem) }}" class="text-white text-xs bg-indigo-600 px-2 py-1 rounded mr-1">Editar</a>
                                        <form action="{{ route('admin.imagens.destroy', $imagem) }}" method="POST" class="inline-block" onsubmit="return confirm('Excluir imagem?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-white text-xs bg-red-600 px-2 py-1 rounded">X</button>
                                        </form>
                                    </div>
                                     <p class="text-xs text-center mt-1 truncate" title="{{ $imagem->titulo }}">{{ $imagem->titulo }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhuma imagem associada a este modelo.</p>
                    @endif
                </div>
            </div>

            {{-- Vídeos Associados --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                     <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Vídeos Associados</h3>
                         {{-- <a href="{{ route('admin.videos.create', ['attachable_type' => App\Models\Modelo::class, 'attachable_id' => $modelo->id]) }}" class="text-sm text-blue-600 hover:underline">Adicionar Vídeo</a> --}}
                          <span class="text-xs text-gray-500">(Funcionalidade Adicionar Pendente)</span>
                    </div>
                    @if ($modelo->videos->isNotEmpty())
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                             @foreach ($modelo->videos as $video)
                                <li class="py-3 flex justify-between items-center">
                                   <span>
                                        {{ $video->titulo ?? ($video->tipo === 'link' ? $video->url_ou_path : 'Arquivo de Vídeo') }}
                                        <span class="text-xs text-gray-500">({{ Str::ucfirst($video->tipo) }})</span>
                                        @if ($video->tipo === 'link')
                                            <a href="{{ $video->url_ou_path }}" target="_blank" class="text-blue-500 hover:underline ml-1 text-xs">(abrir)</a>
                                        @endif
                                    </span>
                                    <div>
                                        <a href="{{ route('admin.videos.edit', $video) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Editar</a>
                                         <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="inline-block" onsubmit="return confirm('Excluir vídeo?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 text-xs">Excluir</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                         <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum vídeo associado a este modelo.</p>
                    @endif
                </div>
            </div>

             {{-- Botão Voltar --}}
            <div class="mt-6">
                 <a href="{{ route('admin.modelos.index', ['marca_id' => $modelo->marca_id]) }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    &laquo; Voltar para Lista de Modelos ({{ $modelo->marca->nome }})
                </a>
            </div>

        </div>
    </div>
</x-admin-layout> 