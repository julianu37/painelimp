{{-- Códigos de Erro Associados (Checkboxes com Busca) --}}
<div class="mb-4 relative"
     x-data="{
         search: '',
         // Mapeia a coleção para um formato {id: codigo} para Alpine
         // Usa a variável $codigosErro passada pelo controller (edit ou create)
         codigosErro: {{ json_encode(($codigosErro ?? collect())->pluck('codigo', 'id')) }},
         // Usa os IDs passados pelo controller (edit ou create)
         // Garante que $selectedCodigosErroIds seja um array
         selectedCodigosErroIds: {{ json_encode(old('codigos_erro', $selectedCodigosErroIds ?? [])) }},

         get filteredCodigosErro() {
             if (this.search === '') {
                 return this.codigosErro;
             }
             const searchTerm = this.search.toLowerCase();
             const filtered = {};
             for (const id in this.codigosErro) {
                 if (this.codigosErro[id] && this.codigosErro[id].toLowerCase().includes(searchTerm)) {
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
<div class="mt-4">
    <x-input-label for="titulo" :value="__('Título da Solução')" />
    <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo" :value="old('titulo', $solucao->titulo ?? '')" required />
    <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
</div>

{{-- Descrição Passo-a-passo --}}
<div class="mt-4">
    <x-input-label for="descricao" :value="__('Descrição Detalhada (Passo-a-passo)')" />
    <textarea id="descricao" name="descricao" rows="6" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('descricao', $solucao->descricao ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Use quebras de linha para separar os passos.</p>
</div>

{{-- TODO: Adicionar seção para upload/gerenciamento de imagens e vídeos associados? --}}
{{-- Isso pode ser feito aqui ou em uma etapa separada após criar a solução. --}} 