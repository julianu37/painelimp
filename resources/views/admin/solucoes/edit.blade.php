<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Solução') }}: {{ $solucao->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.solucoes.update', $solucao) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                         {{-- Código de Erro (Exibição apenas, não editável aqui) --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Código de Erro Associado</label>
                            <p class="mt-1 text-gray-600 dark:text-gray-400">{{ $solucao->codigoErro->codigo ?? 'N/A' }}</p>
                        </div>

                        {{-- Título --}}
                        <div class="mb-4">
                            <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título <span class="text-red-500">*</span></label>
                            <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $solucao->titulo) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" required>
                            @error('titulo')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Descrição --}}
                        <div class="mb-4">
                            <label for="descricao" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descrição Detalhada</label>
                            <textarea name="descricao" id="descricao" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">{{ old('descricao', $solucao->descricao) }}</textarea>
                             @error('descricao')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Mídias Existentes e Upload de Novas Mídias --}}
                        <div class="border-t dark:border-gray-700 pt-4 mt-6">
                            <h3 class="text-md font-medium mb-4">Gerenciar Mídias</h3>

                            {{-- Imagens Existentes --}}
                            <div class="mb-6">
                                <h4 class="text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Imagens Atuais:</h4>
                                @if ($solucao->imagens->isNotEmpty())
                                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                                        @foreach ($solucao->imagens as $imagem)
                                            <div class="relative group border p-2 rounded-md dark:border-gray-700">
                                                <img src="{{ $imagem->url }}" alt="{{ $imagem->titulo ?? 'Imagem anexa' }}" class="w-full h-24 object-cover rounded-md shadow-sm mb-2">
                                                <p class="text-xs text-center truncate mb-2" title="{{ $imagem->titulo ?? $imagem->nome_original }}">{{ $imagem->titulo ?? $imagem->nome_original }}</p>
                                                {{-- Checkbox para Remover Imagem --}}
                                                <div class="text-center">
                                                     <label for="remover_imagem_{{ $imagem->id }}" class="flex items-center justify-center text-xs text-red-600 dark:text-red-400 hover:text-red-800 cursor-pointer">
                                                        <input type="checkbox" name="remover_imagens[]" id="remover_imagem_{{ $imagem->id }}" value="{{ $imagem->id }}" class="mr-1 h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                                        Remover
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Nenhuma imagem associada.</p>
                                @endif
                            </div>

                            {{-- Upload Novas Imagens --}}
                            <div class="mb-4">
                                <label for="imagens" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Adicionar Novas Imagens (JPG, PNG, GIF, WEBP - Máx 10MB cada)</label>
                                <input type="file" name="imagens[]" id="imagens" multiple accept="image/jpeg,image/png,image/gif,image/webp" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-gray-700 dark:file:text-gray-300 dark:hover:file:bg-gray-600">
                                @error('imagens.*')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                             {{-- Vídeos Existentes --}}
                            <div class="mb-6">
                                <h4 class="text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Vídeos Atuais:</h4>
                                @if ($solucao->videos->isNotEmpty())
                                    <ul class="list-none space-y-2 text-xs">
                                        @foreach ($solucao->videos as $video)
                                            <li class="flex justify-between items-center border-b pb-2 dark:border-gray-700">
                                                 <span class="flex-1 mr-2">
                                                    @if($video->tipo === 'link')
                                                        <a href="{{ $video->url_ou_path }}" target="_blank" class="text-blue-600 hover:underline dark:text-blue-400 truncate block" title="{{ $video->url_ou_path }}">{{ $video->titulo ?? $video->url_ou_path }}</a> (Link YouTube)
                                                    @else
                                                        <a href="{{ $video->url_ou_path }}" target="_blank" class="text-blue-600 hover:underline dark:text-blue-400 truncate block" title="{{ $video->nome_original }}">{{ $video->titulo ?? $video->nome_original }}</a> (Upload)
                                                    @endif
                                                </span>
                                                {{-- Checkbox para Remover Vídeo --}}
                                                <label for="remover_video_{{ $video->id }}" class="flex items-center text-xs text-red-600 dark:text-red-400 hover:text-red-800 cursor-pointer ml-2 whitespace-nowrap">
                                                    <input type="checkbox" name="remover_videos[]" id="remover_video_{{ $video->id }}" value="{{ $video->id }}" class="mr-1 h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                                    Remover
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Nenhum vídeo associado.</p>
                                @endif
                            </div>

                            {{-- Upload Novos Vídeos --}}
                            <div class="mb-4">
                                <label for="videos" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Adicionar Novos Vídeos (MP4, MOV, AVI, WMV - Máx 50MB cada)</label>
                                <input type="file" name="videos[]" id="videos" multiple accept="video/mp4,video/quicktime,video/x-msvideo,video/x-ms-wmv" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-gray-700 dark:file:text-gray-300 dark:hover:file:bg-gray-600">
                                @error('videos.*')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                             {{-- Link YouTube (Permite apenas um por enquanto, sobrescreve se novo for enviado?) --}}
                             {{-- TODO: Melhorar lógica para múltiplos links ou atualizar existente --}}
                             <div class="mb-4">
                                <label for="youtube_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Link do YouTube (Substitui link existente, se houver):</label>
                                @php
                                    // Encontra o primeiro vídeo do tipo link, se existir
                                    $youtubeVideo = $solucao->videos->firstWhere('tipo', 'link');
                                @endphp
                                <input type="url" name="youtube_link" id="youtube_link" placeholder="https://www.youtube.com/watch?v=..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" value="{{ old('youtube_link', $youtubeVideo->url_ou_path ?? '') }}">
                                @error('youtube_link')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                                 {{-- TODO: Adicionar botão/checkbox para remover link existente sem adicionar novo --}}
                            </div>
                        </div>

                        {{-- Botões de Ação --}}
                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('admin.solucoes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancelar
                            </a>
                             <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Atualizar Solução
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> 