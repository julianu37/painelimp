<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Código de Erro:') }} {{ $codigoErro->codigo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
             <x-alert-messages /> {{-- Para mensagens de erro/sucesso (ex: postar comentário) --}}

            {{-- Detalhes do Código --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-2">Descrição do Erro</h3>
                    <p class="whitespace-pre-wrap">{{ $codigoErro->descricao }}</p>
                </div>
            </div>

            {{-- Imagens Associadas ao Código --}}
            @if ($codigoErro->imagens->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-medium mb-4">Imagens Relacionadas ao Código</h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            @foreach ($codigoErro->imagens as $imagem)
                                <div class="group">
                                    <a href="{{ Storage::url($imagem->path) }}" target="_blank" data-lightbox="codigo-{{ $codigoErro->id }}" data-title="{{ $imagem->titulo }}">
                                        <img src="{{ Storage::url($imagem->path) }}" alt="{{ $imagem->titulo }}" class="w-full h-32 object-cover rounded-md shadow-md hover:opacity-75 transition duration-150">
                                    </a>
                                     <p class="text-xs text-center mt-1 truncate" title="{{ $imagem->titulo }}">{{ $imagem->titulo }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            {{-- Vídeos Associados ao Código --}}
            @if ($codigoErro->videos->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-medium mb-4">Vídeos Relacionados ao Código</h3>
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($codigoErro->videos as $video)
                                <li class="py-3">
                                   <span class="font-medium">{{ $video->titulo ?? 'Vídeo sem título' }}</span>
                                   @if ($video->tipo === 'link')
                                        <a href="{{ $video->url_ou_path }}" target="_blank" class="ml-2 text-sm text-blue-600 hover:underline">(Assistir Link Externo)</a>
                                   @else
                                       {{-- Player de vídeo embutido ou link para download/página do vídeo --}}
                                       {{-- Simplificado por enquanto: link para o arquivo --}}
                                        <a href="{{ Storage::url($video->url_ou_path) }}" target="_blank" class="ml-2 text-sm text-blue-600 hover:underline">(Ver Vídeo)</a>
                                   @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Soluções --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Possíveis Soluções</h3>
                    @if ($codigoErro->solucoes->isNotEmpty())
                        <div class="space-y-8">
                            @foreach ($codigoErro->solucoes as $solucao)
                                <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                                    <h4 class="text-md font-semibold mb-2">{{ $solucao->titulo }}</h4>
                                    <p class="text-sm whitespace-pre-wrap mb-4">{{ $solucao->descricao }}</p>

                                    {{-- Imagens da Solução --}}
                                    @if ($solucao->imagens->isNotEmpty())
                                        <h5 class="text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Imagens da Solução:</h5>
                                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 mb-4">
                                            @foreach ($solucao->imagens as $imagem)
                                                 <div class="group">
                                                    <a href="{{ Storage::url($imagem->path) }}" target="_blank" data-lightbox="solucao-{{ $solucao->id }}" data-title="{{ $imagem->titulo }}">
                                                        <img src="{{ Storage::url($imagem->path) }}" alt="{{ $imagem->titulo }}" class="w-full h-24 object-cover rounded-md shadow-sm hover:opacity-75 transition duration-150">
                                                    </a>
                                                     <p class="text-xs text-center mt-1 truncate" title="{{ $imagem->titulo }}">{{ $imagem->titulo }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    {{-- Vídeos da Solução --}}
                                    @if ($solucao->videos->isNotEmpty())
                                        <h5 class="text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Vídeos da Solução:</h5>
                                        <ul class="list-disc list-inside space-y-1 text-sm mb-4">
                                            @foreach ($solucao->videos as $video)
                                                <li>
                                                    <span class="font-medium">{{ $video->titulo ?? 'Vídeo sem título' }}</span>
                                                    @if ($video->tipo === 'link')
                                                        <a href="{{ $video->url_ou_path }}" target="_blank" class="ml-1 text-blue-600 hover:underline">(Assistir Link Externo)</a>
                                                    @else
                                                         <a href="{{ Storage::url($video->url_ou_path) }}" target="_blank" class="ml-1 text-blue-600 hover:underline">(Ver Vídeo)</a>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhuma solução cadastrada para este código de erro.</p>
                    @endif
                </div>
            </div>

             {{-- Comentários --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Comentários Técnicos</h3>

                    {{-- Formulário para Novo Comentário (Apenas Logado) --}}
                    @auth
                        {{-- FORMULÁRIO ATUALIZADO com upload e youtube --}}
                        <form action="{{ route('comentarios.store', ['comentavel_type' => 'codigo_erro', 'comentavel_id' => $codigoErro->id]) }}" method="POST" enctype="multipart/form-data" class="mb-6 p-4 border rounded-md dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
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
                                    {{-- Exibe erros gerais de midias e específicos de cada arquivo --}}
                                    @error('midias') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                                    @error('midias.*') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
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
                                <x-primary-button>
                                    {{ __('Enviar Comentário') }}
                                </x-primary-button>
                            </div>
                        </form>
                    @else
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            <a href="{{ route('login') }}" class="underline text-indigo-600 dark:text-indigo-400">Faça login</a> ou <a href="{{ route('register') }}" class="underline text-indigo-600 dark:text-indigo-400">registre-se</a> para deixar um comentário.
                        </p>
                    @endauth

                    {{-- Lista de Comentários Existentes (ATUALIZADA com mídias) --}}
                    <h4 class="text-md font-medium mb-4 border-t dark:border-gray-700 pt-4">Histórico de Comentários</h4>
                    @if ($codigoErro->comentarios->isNotEmpty())
                        <div class="space-y-6">
                            @foreach ($codigoErro->comentarios as $comentario)
                                <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
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
                                     {{-- TODO: Adicionar botão de excluir apenas se Auth::user()->isAdmin() --}}
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum comentário técnico adicionado ainda.</p>
                    @endif
                </div>
            </div>

            {{-- Botão Voltar --}}
            <div class="mt-6">
                 <a href="{{ route('codigos.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    &laquo; Voltar para Lista de Códigos
                </a>
            </div>

        </div>
    </div>
    {{-- Incluir JS do Lightbox2 se quiser usar --}}
    {{-- @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    @endpush
    @push('styles')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    @endpush --}}
</x-app-layout> 