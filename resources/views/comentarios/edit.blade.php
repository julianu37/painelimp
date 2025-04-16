<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Comentário') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Mensagens Flash (caso haja redirecionamento com erro) --}}
                    {{-- Embora o layout principal já tenha, pode ser útil ter aqui também se esta página não usar o layout principal --}}
                    {{-- <x-alert-messages /> --}}

                    {{-- Formulário de Edição --}}
                    <form method="POST" action="{{ route('comentarios.update', $comentario) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Campo Conteúdo --}}
                        <div class="mb-6 border-b pb-6 dark:border-gray-700">
                            <label for="conteudo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Conteúdo do Comentário:</label>
                            <textarea id="conteudo" name="conteudo" rows="5" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('conteudo', $comentario->conteudo) }}</textarea>
                            @error('conteudo') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Mídias Existentes --}}
                        <div class="mb-6 border-b pb-6 dark:border-gray-700">
                            <h3 class="text-md font-medium mb-4 text-gray-800 dark:text-gray-200">Gerenciar Anexos Atuais</h3>
                            @if ($comentario->midias->isNotEmpty())
                                <div class="space-y-4">
                                    @foreach ($comentario->midias as $midia)
                                        <div class="flex items-center justify-between border dark:border-gray-700 p-2 rounded-md bg-gray-50 dark:bg-gray-900/50">
                                            <div class="flex-1 min-w-0 mr-4">
                                                {{-- Preview ou Ícone da Mídia --}}
                                                @if ($midia->is_imagem)
                                                    <img src="{{ $midia->url }}" alt="Preview" class="h-10 w-10 object-cover rounded inline-block mr-2 border dark:border-gray-600">
                                                @elseif ($midia->is_pdf)
                                                    <svg class="w-6 h-6 inline-block mr-2 fill-current text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 0a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6.5A1.5 1.5 0 0 0 16.5 5h-5A1.5 1.5 0 0 1 10 .5V0H4zm8 6v4h4V6h-4zm-2 8H6v-2h4v2zm4 0h-2v-2h2v2zm0-3H6V9h8v2z"/></svg>
                                                @elseif ($midia->is_video_mp4)
                                                     <svg class="w-6 h-6 inline-block mr-2 fill-current text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zm14 1.574l-4 2v-4l4 2zM4 8v4h8V8H4z"/></svg>
                                                @elseif ($midia->is_video_youtube)
                                                    <svg class="w-6 h-6 inline-block mr-2 fill-current text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-4-4a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-2.293 2.293a1 1 0 101.414 1.414l4-4a1 1 0 000-1.414z" clip-rule="evenodd" /></svg>
                                                @endif
                                                {{-- Nome ou Link --}}
                                                <span class="text-sm text-gray-700 dark:text-gray-300 truncate">{{ $midia->nome_original ?? 'Link YouTube' }}</span>
                                                @if($midia->is_video_youtube)
                                                    <a href="https://www.youtube.com/watch?v={{ $midia->caminho }}" target="_blank" class="text-xs text-blue-500 hover:underline">(Ver)</a>
                                                @elseif(!$midia->is_imagem) {{-- Link para PDF/Vídeo --}}
                                                     <a href="{{ $midia->url }}" target="_blank" class="text-xs text-blue-500 hover:underline">(Ver)</a>
                                                @endif
                                            </div>
                                            {{-- Checkbox para Remover --}}
                                            <label for="remover_midia_{{ $midia->id }}" class="flex items-center text-xs text-red-600 dark:text-red-400 hover:text-red-800 cursor-pointer whitespace-nowrap">
                                                <input type="checkbox" name="remover_midias[]" id="remover_midia_{{ $midia->id }}" value="{{ $midia->id }}" class="mr-1 h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                                Remover
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('remover_midias.*') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                            @else
                                <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum anexo encontrado.</p>
                            @endif
                        </div>

                        {{-- Adicionar Novas Mídias --}}
                        <div class="mb-6">
                             <h3 class="text-md font-medium mb-4 text-gray-800 dark:text-gray-200">Adicionar Novos Anexos</h3>
                             <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="midias" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Upload de Arquivos <span class="text-xs">(Imagens, PDF, Vídeo Curto)</span></label>
                                    <input type="file" name="midias[]" id="midias" multiple class="block w-full text-sm text-gray-500 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm cursor-pointer focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 dark:file:bg-indigo-900/50 file:text-indigo-700 dark:file:text-indigo-300 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-800/50">
                                    @error('midias') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                                    @error('midias.*') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label for="youtube_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Link do YouTube (Substitui link existente)</label>
                                    <input id="youtube_link" type="url" name="youtube_link" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="https://www.youtube.com/watch?v=...">
                                    @error('youtube_link') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Botões de Ação --}}
                        <div class="flex items-center justify-end mt-6 space-x-3 border-t pt-6 dark:border-gray-700">
                            <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancelar
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 