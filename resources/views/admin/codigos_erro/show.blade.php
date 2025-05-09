            {{-- Detalhes do CodigoErro --}}
            {{-- ... código existente ... --}}
            </div>

            {{-- Imagens Associadas --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Imagens Associadas</h3>
                        {{-- <a href="{{ route('admin.imagens.create', ['attachable_type' => App\Models\CodigoErro::class, 'attachable_id' => $codigo->id]) }}" class="text-sm text-blue-600 hover:underline">Adicionar Imagem</a> --}}
                         <span class="text-xs text-gray-500">(Funcionalidade Adicionar Pendente)</span>
                    </div>
                    @if ($codigo->imagens->isNotEmpty())
                       <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            @foreach ($codigo->imagens as $imagem)
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
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhuma imagem associada a este código de erro.</p>
                    @endif
                </div>
            </div>

            {{-- Vídeos Associados --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                     <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Vídeos Associados</h3>
                         {{-- <a href="{{ route('admin.videos.create', ['attachable_type' => App\Models\CodigoErro::class, 'attachable_id' => $codigo->id]) }}" class="text-sm text-blue-600 hover:underline">Adicionar Vídeo</a> --}}
                          <span class="text-xs text-gray-500">(Funcionalidade Adicionar Pendente)</span>
                    </div>
                    @if ($codigo->videos->isNotEmpty())
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                             @foreach ($codigo->videos as $video)
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
                         <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum vídeo associado a este código de erro.</p>
                    @endif
                </div>
            </div>

            {{-- SEÇÃO DE COMENTÁRIOS --}}
            <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Comentários Técnicos</h3>

                    {{-- Formulário para Novo Comentário --}}
                    <form action="{{ route('comentarios.store', ['comentavel_type' => 'codigo_erro', 'comentavel_id' => $codigo->id]) }}" method="POST" enctype="multipart/form-data" class="mb-6 p-4 border rounded-md dark:border-gray-700">
                        @csrf
                        <div class="mb-4">
                            <label for="conteudo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Adicionar Comentário:</label>
                            <textarea name="conteudo" id="conteudo" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" required>{{ old('conteudo') }}</textarea>
                             @error('conteudo')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="midias" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Anexar Arquivos (JPG, PNG, GIF, PDF, MP4 - Máx 10MB cada):</label>
                                <input type="file" name="midias[]" id="midias" multiple class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-gray-700 dark:file:text-gray-300 dark:hover:file:bg-gray-600">
                                @error('midias.*')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                                @error('midias')
                                     <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="youtube_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ou Link do YouTube:</label>
                                <input type="url" name="youtube_link" id="youtube_link" placeholder="https://www.youtube.com/watch?v=..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" value="{{ old('youtube_link') }}">
                                @error('youtube_link')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Salvar Comentário
                            </button>
                        </div>
                    </form>

                    {{-- Lista de Comentários Existentes --}}
                    <div class="space-y-6">
                        @forelse ($codigo->comentarios->sortByDesc('created_at') as $comentario) {{-- Carregar comentarios com user e midias no Controller --}}
                            <div class="p-4 border rounded-md dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-semibold text-sm text-gray-800 dark:text-gray-200">{{ $comentario->user->name ?? 'Usuário desconhecido' }}</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400" title="{{ $comentario->created_at->format('d/m/Y H:i:s') }}">{{ $comentario->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300 mb-3 whitespace-pre-wrap">{{ $comentario->conteudo }}</p>

                                {{-- Exibição das Mídias --}}
                                @if ($comentario->midias->isNotEmpty())
                                    <div class="mt-3 border-t pt-3 dark:border-gray-600">
                                        <p class="text-xs font-medium text-gray-600 dark:text-gray-400 mb-2">Anexos:</p>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                            @foreach ($comentario->midias as $midia)
                                                <div>
                                                    @if ($midia->is_imagem)
                                                        <a href="{{ $midia->url }}" target="_blank" title="{{ $midia->nome_original ?? 'Ver imagem' }}">
                                                            <img src="{{ $midia->url }}" alt="{{ $midia->nome_original ?? 'Imagem anexa' }}" class="max-h-40 w-auto rounded-md shadow-sm mb-1 object-contain border dark:border-gray-700">
                                                        </a>
                                                    @elseif ($midia->is_video_mp4)
                                                        <video controls class="max-h-40 w-auto rounded-md shadow-sm mb-1 border dark:border-gray-700 bg-black">
                                                            <source src="{{ $midia->url }}" type="video/mp4">
                                                            Seu navegador não suporta o vídeo MP4.
                                                        </video>
                                                    @elseif ($midia->is_video_youtube)
                                                        <div class="aspect-w-16 aspect-h-9 mb-1">
                                                             <iframe src="{{ $midia->url }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen class="rounded-md shadow-sm border dark:border-gray-700"></iframe>
                                                        </div>
                                                    @elseif ($midia->is_pdf)
                                                        <a href="{{ $midia->url }}" target="_blank" class="inline-flex items-center text-sm text-blue-600 hover:underline dark:text-blue-400">
                                                            {{-- Ícone de PDF (exemplo com SVG inline) --}}
                                                            <svg class="w-4 h-4 mr-1 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 0a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6.5A1.5 1.5 0 0 0 16.5 5h-5A1.5 1.5 0 0 1 10 .5V0H4zm8 6v4h4V6h-4zm-2 8H6v-2h4v2zm4 0h-2v-2h2v2zm0-3H6V9h8v2z"/></svg>
                                                            {{ $midia->nome_original ?? 'Abrir PDF' }}
                                                        </a>
                                                    @endif
                                                     <p class="text-xs text-gray-500 truncate" title="{{ $midia->nome_original }}">{{ $midia->nome_original }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                {{-- Ações do Comentário: Like/Unlike e Excluir --}}
                                <div class="mt-3 border-t pt-2 dark:border-gray-600 flex justify-between items-center">
                                    {{-- Like/Unlike --}}
                                    <div class="flex items-center space-x-4">
                                        @auth {{-- Apenas para usuários logados --}}
                                            @if ($comentario->isLikedByAuthUser())
                                                {{-- Formulário UNLIKE --}}
                                                <form action="{{ route('comments.unlike', $comentario) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="flex items-center text-xs text-red-600 dark:text-red-500 hover:text-red-800 dark:hover:text-red-400" title="Remover Curtida">
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
                                <div>
                                    @can ('delete', $comentario)
                                        <form action="{{ route('comentarios.destroy', $comentario) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este comentário?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="flex items-center text-xs text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300" title="Excluir Comentário">
                                                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                                                Excluir
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum comentário adicionado ainda.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            {{-- FIM DA SEÇÃO DE COMENTÁRIOS --}}

             {{-- Botão Voltar --}} 

            {{-- SEÇÃO DE SOLUÇÕES --}}
            <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Soluções Associadas</h3>
                    @if ($codigo->solucoes->isNotEmpty())
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            {{-- Carregar as mídias aqui para evitar N+1 query --}}
                            @foreach ($codigo->solucoes->load('imagens', 'videos') as $solucao)
                                <li class="py-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $solucao->titulo }}</p>
                                            @if($solucao->descricao)
                                            <p class="text-sm text-gray-600 dark:text-gray-400 whitespace-pre-wrap mt-1">{{ $solucao->descricao }}</p>
                                            @endif
                                        </div>
                                        <div class="ml-4 flex-shrink-0 space-x-2">
                                            <a href="{{ route('admin.solucoes.edit', $solucao) }}" class="text-sm text-indigo-600 hover:underline">Editar</a>
                                            <form action="{{ route('admin.solucoes.destroy', $solucao) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja excluir esta solução e todas as suas mídias?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm text-red-600 hover:underline">Excluir</button>
                                            </form>
                                        </div>
                                    </div>

                                    {{-- Exibição das Mídias da Solução --}}
                                    @if ($solucao->imagens->isNotEmpty() || $solucao->videos->isNotEmpty())
                                        <div class="mt-3 border-t pt-3 dark:border-gray-600">
                                            <p class="text-xs font-medium text-gray-600 dark:text-gray-400 mb-2">Mídias da Solução:</p>

                                             {{-- Imagens --}}
                                            @if ($solucao->imagens->isNotEmpty())
                                                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-2 mb-3">
                                                    @foreach ($solucao->imagens as $imagem)
                                                        <a href="{{ $imagem->url }}" target="_blank" title="{{ $imagem->titulo ?? $imagem->nome_original }}" class="block relative">
                                                            <img src="{{ $imagem->url }}" alt="{{ $imagem->titulo ?? 'Imagem anexa' }}" class="w-full h-16 object-cover rounded shadow-sm border dark:border-gray-700">
                                                            <p class="text-[10px] text-center mt-0.5 truncate text-gray-500 dark:text-gray-400" title="{{ $imagem->titulo ?? $imagem->nome_original }}">{{ $imagem->titulo ?? $imagem->nome_original }}</p>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif

                                            {{-- Vídeos --}}
                                            @if ($solucao->videos->isNotEmpty())
                                                <div class="space-y-2">
                                                    @foreach ($solucao->videos as $video)
                                                        <div>
                                                            @if ($video->tipo === 'link')
                                                                <a href="{{ $video->url_ou_path }}" target="_blank" class="inline-flex items-center text-xs text-blue-600 hover:underline dark:text-blue-400">
                                                                     <svg class="w-3 h-3 mr-1 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                                                                    {{ $video->titulo ?? $video->url_ou_path }}
                                                                </a> (Link YouTube)
                                                            @else
                                                                <a href="{{ $video->url_ou_path }}" target="_blank" class="inline-flex items-center text-xs text-blue-600 hover:underline dark:text-blue-400">
                                                                    <svg class="w-3 h-3 mr-1 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                                                                    {{ $video->titulo ?? $video->nome_original }}
                                                                </a> (Upload)
                                                                 {{-- Player para vídeos locais pode ser adicionado aqui se desejado --}}
                                                                {{-- <video controls width="200" class="mt-1"><source src="{{ $video->url_ou_path }}" type="video/mp4"></video> --}}
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhuma solução associada a este código de erro.</p>
                    @endif
                </div>
            </div>
            {{-- FIM DA SEÇÃO DE SOLUÇÕES --}} 