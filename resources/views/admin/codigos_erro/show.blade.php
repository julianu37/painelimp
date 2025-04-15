            {{-- Detalhes do CodigoErro --}}
            {{-- ... código existente ... --}}
            </div>

            {{-- Imagens Associadas --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Imagens Associadas</h3>
                        {{-- <a href="{{ route('admin.imagens.create', ['attachable_type' => App\Models\CodigoErro::class, 'attachable_id' => $codigoErro->id]) }}" class="text-sm text-blue-600 hover:underline">Adicionar Imagem</a> --}}
                         <span class="text-xs text-gray-500">(Funcionalidade Adicionar Pendente)</span>
                    </div>
                    @if ($codigoErro->imagens->isNotEmpty())
                       <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            @foreach ($codigoErro->imagens as $imagem)
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
                         {{-- <a href="{{ route('admin.videos.create', ['attachable_type' => App\Models\CodigoErro::class, 'attachable_id' => $codigoErro->id]) }}" class="text-sm text-blue-600 hover:underline">Adicionar Vídeo</a> --}}
                          <span class="text-xs text-gray-500">(Funcionalidade Adicionar Pendente)</span>
                    </div>
                    @if ($codigoErro->videos->isNotEmpty())
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                             @foreach ($codigoErro->videos as $video)
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
                    <form action="{{ route('admin.comentarios.store', ['comentavel_type' => 'codigo_erro', 'comentavel_id' => $codigoErro->id]) }}" method="POST" enctype="multipart/form-data" class="mb-6 p-4 border rounded-md dark:border-gray-700">
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
                        @forelse ($codigoErro->comentarios->sortByDesc('created_at') as $comentario) {{-- Carregar comentarios com user e midias no Controller --}}
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
                                {{-- TODO: Adicionar botão/link para excluir comentário (se o usuário for admin ou o autor) --}}
                            </div>
                        @empty
                            <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum comentário adicionado ainda.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            {{-- FIM DA SEÇÃO DE COMENTÁRIOS --}}

             {{-- Botão Voltar --}} 