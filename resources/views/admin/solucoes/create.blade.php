<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Adicionar Nova Solução') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.solucoes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Códigos de Erro Associados (Checkboxes com Busca) --}}
                        <div class="mb-4 relative"
                             x-data="{
                                 search: '',
                                 // Mapeia a coleção para um formato {id: codigo} para Alpine
                                 codigosErro: {{ json_encode($codigosErro->pluck('codigo', 'id')) }},
                                 // Usa os IDs passados pelo controller (ou old())
                                 selectedCodigosErroIds: {{ json_encode(old('codigos_erro', $selectedCodigosErroIds ?? [])) }},

                                 get filteredCodigosErro() {
                                     if (this.search === '') {
                                         return this.codigosErro;
                                     }
                                     const searchTerm = this.search.toLowerCase();
                                     const filtered = {};
                                     for (const id in this.codigosErro) {
                                         if (this.codigosErro[id].toLowerCase().includes(searchTerm)) {
                                             filtered[id] = this.codigosErro[id];
                                         }
                                     }
                                     return filtered;
                                 }
                             }">

                            {{-- Label e Campo de Busca --}}
                            <label for="codigo-erro-search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Códigos de Erro Associados <span class="text-red-500">*</span></label>
                            <input type="text" id="codigo-erro-search" x-model="search" placeholder="Buscar código..."
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 text-sm py-1"/>

                            {{-- Lista de Checkboxes --}}
                            <div class="mt-2 block w-full h-48 overflow-y-auto border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm p-2 space-y-1">
                                <template x-for="(codigo, id) in filteredCodigosErro" :key="id">
                                    <label class="flex items-center space-x-2 text-sm">
                                        <input type="checkbox"
                                               name="codigos_erro[]" {{-- Nome do array para o backend --}}
                                               :value="id"
                                               {{-- Verifica se o ID está no array de selecionados (converte para string para segurança) --}}
                                               :checked="selectedCodigosErroIds.map(String).includes(String(id))"
                                               class="rounded dark:bg-gray-800 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                                        <span x-text="codigo"></span>
                                    </label>
                                </template>
                                {{-- Mensagem se a busca não encontrar nada --}}
                                <template x-if="Object.keys(filteredCodigosErro).length === 0 && search !== ''">
                                     <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum código encontrado para "<span x-text="search"></span>".</p>
                                </template>
                            </div>

                            {{-- Exibe erros de validação para o array e seus itens --}}
                             @error('codigos_erro')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                             @error('codigos_erro.*')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                             <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Selecione um ou mais códigos de erro aos quais esta solução se aplica.</p>
                        </div>

                        {{-- Título --}}
                        <div class="mb-4">
                            <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título <span class="text-red-500">*</span></label>
                            <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" required>
                            @error('titulo')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Descrição --}}
                        <div class="mb-4">
                            <label for="descricao" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descrição Detalhada</label>
                            <textarea name="descricao" id="descricao" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">{{ old('descricao') }}</textarea>
                             @error('descricao')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Upload de Mídias --}}
                        <div class="border-t dark:border-gray-700 pt-4 mt-6">
                             <h3 class="text-md font-medium mb-4">Adicionar Mídias (Opcional)</h3>

                             {{-- Imagens --}}
                             <div class="mb-4">
                                <label for="imagens" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Upload de Imagens (JPG, PNG, GIF, WEBP - Máx 10MB cada)</label>
                                <input type="file" name="imagens[]" id="imagens" multiple accept="image/jpeg,image/png,image/gif,image/webp" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-gray-700 dark:file:text-gray-300 dark:hover:file:bg-gray-600">
                                @error('imagens.*')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Vídeos (Upload) --}}
                            <div class="mb-4">
                                <label for="videos" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Upload de Vídeos (MP4, MOV, AVI, WMV - Máx 50MB cada)</label>
                                <input type="file" name="videos[]" id="videos" multiple accept="video/mp4,video/quicktime,video/x-msvideo,video/x-ms-wmv" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-gray-700 dark:file:text-gray-300 dark:hover:file:bg-gray-600">
                                @error('videos.*')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                             {{-- Link YouTube --}}
                             <div class="mb-4">
                                <label for="youtube_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ou Link do YouTube:</label>
                                <input type="url" name="youtube_link" id="youtube_link" placeholder="https://www.youtube.com/watch?v=..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" value="{{ old('youtube_link') }}">
                                @error('youtube_link')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Botões de Ação --}}
                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('admin.solucoes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancelar
                            </a>
                             <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Salvar Solução
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> 