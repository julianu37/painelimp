<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Código de Erro:') }} {{ $codigoErro->codigo }}
            </h2>
            {{-- Botão Voltar no Cabeçalho --}}
            <a href="{{ url()->previous() ?? route('codigos.index') }}"
               class="inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                Voltar
            </a>
        </div>
    </x-slot>

    {{-- Breadcrumbs --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol role="list" class="flex items-center space-x-4 text-sm">
                {{-- Home --}}
                <li>
                    <div>
                        <a href="{{ route('home') }}" class="text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-300">
                            <svg class="flex-shrink-0 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" /></svg>
                            <span class="sr-only">Home</span>
                        </a>
                    </div>
                </li>
                {{-- Marcas --}}
                <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-4 w-4 text-gray-300 dark:text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" /></svg>
                        <a href="{{ route('marcas.index') }}" class="ml-4 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">Marcas</a>
                    </div>
                </li>
                {{-- Marca Específica --}}
                @if ($modelo->marca)
                <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-4 w-4 text-gray-300 dark:text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" /></svg>
                        <a href="{{ route('marcas.show', $modelo->marca) }}" class="ml-4 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">{{ $modelo->marca->nome }}</a>
                    </div>
                </li>
                @endif
                {{-- Modelo Específico --}}
                <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-4 w-4 text-gray-300 dark:text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" /></svg>
                        <a href="{{ route('modelos.show', $modelo) }}" class="ml-4 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">{{ $modelo->nome }}</a>
                    </div>
                </li>
                 {{-- Códigos do Modelo --}}
                <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-4 w-4 text-gray-300 dark:text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" /></svg>
                        <a href="{{ route('modelos.show.codigos', $modelo) }}" class="ml-4 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">Códigos</a>
                    </div>
                </li>
                {{-- Código Atual --}}
                <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-4 w-4 text-gray-300 dark:text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" /></svg>
                        <span class="ml-4 text-sm font-medium text-gray-700 dark:text-gray-200">{{ $codigoErro->codigo }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            {{-- Detalhes do Código --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-1 text-indigo-700 dark:text-indigo-400">{{ $codigoErro->titulo ?: $codigoErro->codigo }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Código: {{ $codigoErro->codigo }}</p>
                    <h4 class="text-lg font-semibold mb-2">Descrição do Problema</h4>
                    <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ $codigoErro->descricao }}</p>
                </div>
            </div>

            {{-- Imagens Associadas ao Código --}}
            @if ($codigoErro->imagens->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                        <h3 class="text-xl font-semibold mb-4">Imagens Relacionadas ao Código</h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            @foreach ($codigoErro->imagens as $imagem)
                                <div class="group text-center">
                                    <a href="{{ Storage::url($imagem->path) }}" target="_blank" data-lightbox="codigo-{{ $codigoErro->id }}" data-title="{{ $imagem->titulo }}">
                                        <img src="{{ Storage::url($imagem->path) }}" alt="{{ $imagem->titulo }}" class="w-full h-32 object-cover rounded-md border border-gray-200 dark:border-gray-700 shadow-md hover:opacity-80 transition duration-150">
                                    </a>
                                     <p class="text-xs text-gray-600 dark:text-gray-400 mt-1 truncate" title="{{ $imagem->titulo }}">{{ $imagem->titulo }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            {{-- Vídeos Associados ao Código --}}
            @if ($codigoErro->videos->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                        <h3 class="text-xl font-semibold mb-4">Vídeos Relacionados ao Código</h3>
                        <ul class="space-y-3">
                            @foreach ($codigoErro->videos as $video)
                                <li class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-md">
                                    <span class="font-medium text-sm truncate pr-4" title="{{ $video->titulo ?? 'Vídeo sem título' }}">{{ $video->titulo ?? 'Vídeo sem título' }}</span>
                                    @if ($video->tipo === 'link')
                                        <a href="{{ $video->url_ou_path }}" target="_blank" class="inline-flex items-center text-sm text-indigo-600 dark:text-indigo-400 hover:underline font-semibold whitespace-nowrap">
                                            Assistir <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        </a>
                                    @elseif ($video->tipo === 'youtube')
                                        {{-- Poderia adicionar um modal para abrir o vídeo ou link direto --}}
                                        <a href="{{ $video->url_ou_path }}" target="_blank" class="inline-flex items-center text-sm text-red-600 dark:text-red-400 hover:underline font-semibold whitespace-nowrap">
                                            Ver no YouTube <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        </a>
                                    @else
                                        <a href="{{ Storage::url($video->url_ou_path) }}" target="_blank" class="inline-flex items-center text-sm text-indigo-600 dark:text-indigo-400 hover:underline font-semibold whitespace-nowrap">
                                            Ver Vídeo <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Comentários --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold mb-6">Comentários Técnicos</h3>

                    {{-- Formulário para Novo Comentário --}}
                    @auth
                        <form action="{{ route('comentarios.store', ['comentavel_type' => 'codigo_erro', 'comentavel_id' => $codigoErro->id]) }}" method="POST" enctype="multipart/form-data" class="mb-8 p-5 border rounded-lg dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 shadow-sm">
                            @csrf
                            <div class="mb-4">
                                <label for="conteudo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deixe seu comentário ou sugestão:</label>
                                <textarea id="conteudo" name="conteudo" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('conteudo') }}</textarea>
                                <x-input-error :messages="$errors->get('conteudo')" class="mt-2" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <label for="midias" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Anexar Arquivos <span class="text-xs">(Imagens, PDF, Vídeo Curto)</span></label>
                                    <input type="file" name="midias[]" id="midias" multiple class="block w-full text-sm text-gray-500 dark:text-gray-300
                                        border border-gray-300 dark:border-gray-700 rounded-md shadow-sm cursor-pointer
                                        focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500
                                        file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:text-sm file:font-semibold
                                        file:bg-indigo-50 dark:file:bg-indigo-900/50 file:text-indigo-700 dark:file:text-indigo-300
                                        hover:file:bg-indigo-100 dark:hover:file:bg-indigo-800/50">
                                    <x-input-error :messages="$errors->get('midias')" class="mt-2" />
                                    <x-input-error :messages="$errors->get('midias.*')" class="mt-2" />
                                </div>
                                <div>
                                    <label for="youtube_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Link do YouTube</label>
                                    <x-text-input id="youtube_link" type="url" name="youtube_link" class="mt-1 block w-full" placeholder="https://www.youtube.com/watch?v=..." :value="old('youtube_link')"></x-text-input>
                                    <x-input-error :messages="$errors->get('youtube_link')" class="mt-2" />
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <x-primary-button>
                                    {{ __('Enviar Comentário') }}
                                </x-primary-button>
                            </div>
                        </form>
                    @else
                        <div class="text-center border rounded-lg p-6 bg-gray-50 dark:bg-gray-700/50 dark:border-gray-700 mb-8">
                             <p class="text-sm text-gray-700 dark:text-gray-300">
                                Para comentar ou adicionar anexos, por favor
                                <a href="{{ route('login') }}" class="font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">faça login</a> ou
                                <a href="{{ route('register') }}" class="font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">registre-se</a>.
                            </p>
                        </div>
                    @endauth

                    {{-- Lista de Comentários Existentes --}}
                    <h4 class="text-lg font-semibold mb-4">Histórico de Comentários</h4>
                    @if ($codigoErro->comentarios->isNotEmpty())
                        <div class="space-y-6">
                            @foreach ($codigoErro->comentarios as $comentario)
                                {{-- Card do Comentário Individual --}}
                                <div class="p-4 bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <span class="font-semibold text-sm text-gray-800 dark:text-gray-200">{{ $comentario->user->name ?? 'Usuário Anônimo' }}</span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">{{ $comentario->created_at->diffForHumans() }}</span>
                                        </div>
                                        {{-- @if (Auth::check() && Auth::user()->isAdmin()) --}}
                                        @if (Auth::user()?->isAdmin())
                                            <form action="{{ route('comentarios.destroy', $comentario) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este comentário?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-400 hover:text-red-500 dark:hover:text-red-400 text-xs" title="Excluir Comentário">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    <p class="text-gray-700 dark:text-gray-300 mb-4 whitespace-pre-wrap text-sm">{{ $comentario->conteudo }}</p>

                                    {{-- Exibição das Mídias --}}
                                    @if ($comentario->midias->isNotEmpty())
                                        <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
                                            <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Anexos:</p>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                                @foreach ($comentario->midias as $midia)
                                                    <div class="bg-gray-50 dark:bg-gray-700/50 p-2 rounded border dark:border-gray-600">
                                                        @if ($midia->is_imagem)
                                                            <a href="{{ $midia->url }}" target="_blank" data-lightbox="comentario-{{ $comentario->id }}" data-title="{{ $midia->nome_original ?? 'Ver imagem' }}" class="block hover:opacity-80 transition">
                                                                <img src="{{ $midia->url }}" alt="{{ $midia->nome_original ?? 'Imagem anexa' }}" class="max-h-32 w-full rounded shadow-sm mb-1 object-contain border dark:border-gray-600">
                                                            </a>
                                                        @elseif ($midia->is_video_mp4)
                                                            <video controls class="max-h-40 w-full rounded shadow-sm mb-1 border dark:border-gray-600 bg-black">
                                                                <source src="{{ $midia->url }}" type="video/mp4">
                                                                Seu navegador não suporta o vídeo MP4.
                                                            </video>
                                                        @elseif ($midia->is_video_youtube)
                                                            <div class="aspect-w-16 aspect-h-9 mb-1">
                                                                <iframe src="{{ $midia->url }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen class="rounded shadow-sm border dark:border-gray-600"></iframe>
                                                            </div>
                                                        @elseif ($midia->is_pdf)
                                                            <a href="{{ $midia->url }}" target="_blank" class="inline-flex items-center text-sm text-blue-600 hover:underline dark:text-blue-400 bg-white dark:bg-gray-800 px-2 py-1 rounded border dark:border-gray-600">
                                                                <svg class="w-4 h-4 mr-1.5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 0a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6.5A1.5 1.5 0 0 0 16.5 5h-5A1.5 1.5 0 0 1 10 .5V0H4zm8 6v4h4V6h-4zm-2 8H6v-2h4v2zm4 0h-2v-2h2v2zm0-3H6V9h8v2z"/></svg>
                                                                Ver PDF
                                                            </a>
                                                        @endif
                                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 truncate" title="{{ $midia->nome_original }}">{{ $midia->nome_original }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Ações do Comentário: Like/Unlike e talvez Excluir (se permitido publicamente) --}}
                                    <div class="mt-3 border-t pt-2 dark:border-gray-600 flex justify-between items-center">
                                        {{-- Like/Unlike/Edit --}}
                                        <div class="flex items-center space-x-4">
                                            {{-- Like/Unlike --}}
                                            <div class="flex items-center space-x-2">
                                                @auth {{-- Apenas para usuários logados --}}
                                                    @if ($comentario->isLikedByAuthUser())
                                                        {{-- Formulário UNLIKE --}}
                                                        <form action="{{ route('comments.unlike', $comentario) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="flex items-center text-xs text-red-600 dark:text-red-500 hover:text-red-800 dark:hover:text-red-400" title="Remover Curtida">
                                                                {{-- Ícone Coração Preenchido (Heroicons solid) --}}
                                                                <svg class="w-4 h-4 mr-1 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                                                </svg>
                                                                Descurtir
                                                            </button>
                                                        </form>
                                                    @else
                                                        {{-- Formulário LIKE --}}
                                                        <form action="{{ route('comments.like', $comentario) }}" method="POST" class="inline">
                                                            @csrf
                                                            <button type="submit" class="flex items-center text-xs text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-500" title="Curtir Comentário">
                                                                {{-- Ícone Coração Contorno (Heroicons outline) --}}
                                                                <svg class="w-4 h-4 mr-1 fill-none stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                                                </svg>
                                                                Curtir
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endauth
                                                {{-- Contagem de Likes --}}
                                                <span class="text-xs text-gray-500 dark:text-gray-400 ml-1">
                                                    ({{ $comentario->likers_count ?? 0 }} curtida{{ ($comentario->likers_count ?? 0) != 1 ? 's' : '' }})
                                                </span>
                                            </div>
                                            {{-- Separador Visual (opcional) --}}
                                            <span class="text-gray-300 dark:text-gray-600">|</span>

                                            {{-- Botão Editar --}}
                                            @can ('update', $comentario)
                                                <a href="{{ route('comentarios.edit', $comentario) }}" class="flex items-center text-xs text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300" title="Editar Comentário">
                                                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" /><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" /></svg>
                                                    Editar
                                                </a>
                                            @endcan
                                        </div>

                                        {{-- Botão Excluir (Verificar Permissão com Policy) --}}
                                        {{-- Mantendo comentado na pública, mas usando @can se fosse habilitar --}}
                                        {{-- @can ('delete', $comentario)
                                            <form action="{{ route('comentarios.destroy', $comentario) }}" method="POST" onsubmit="return confirm('Tem certeza?');" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-xs text-red-600 hover:text-red-800">Excluir</button>
                                            </form>
                                        @endcan --}}
                                         {{-- Apenas Admin pode excluir na pública, como estava antes --}}
                                        @if (Auth::user()?->isAdmin())
                                            <form action="{{ route('comentarios.destroy', $comentario) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este comentário?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-400 hover:text-red-500 dark:hover:text-red-400 text-xs" title="Excluir Comentário (Admin)">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6 border-t dark:border-gray-700">
                            <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                              </svg>
                            <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-gray-100">Sem comentários</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Ainda não há comentários ou sugestões para este código.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
    {{-- Incluir JS/CSS do Lightbox2 se for usar --}}
    @push('scripts')
        {{-- Certifique-se de que o jQuery esteja carregado ANTES do Lightbox --}}
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            // Opções do Lightbox (opcional)
            lightbox.option({
              'resizeDuration': 200,
              'wrapAround': true,
              'fadeDuration': 300
            })
        </script>
    @endpush
    @push('styles')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9noQE0ZAEps4hfPNEAXMlguw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            /* Ajustes para o tema escuro do lightbox, se necessário */
            .lb-dataContainer {
                background-color: rgba(31, 41, 55, 0.9); /* bg-gray-800 com alpha */
            }
            .lb-data .lb-details {
                color: #d1d5db; /* text-gray-300 */
            }
            .lb-data .lb-caption {
                 color: #e5e7eb; /* text-gray-200 */
            }
            .lb-data .lb-close {
                filter: invert(1) grayscale(100%) brightness(200%);
            }
            .lb-nav a.lb-prev, .lb-nav a.lb-next {
                 opacity: 0.6;
                 transition: opacity 0.2s ease-in-out;
            }
            .lb-nav a.lb-prev:hover, .lb-nav a.lb-next:hover {
                opacity: 1;
            }
        </style>
    @endpush
</x-app-layout> 