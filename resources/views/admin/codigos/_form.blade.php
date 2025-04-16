{{-- Código --}}
<div>
    <x-input-label for="codigo" :value="__('Código do Erro')" />
    <x-text-input id="codigo" class="block mt-1 w-full" type="text" name="codigo" :value="old('codigo', $codigoErro->codigo ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('codigo')" class="mt-2" />
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Ex: E101, W055.</p>
</div>

{{-- Descrição --}}
<div class="mt-4">
    <x-input-label for="descricao" :value="__('Descrição do Erro')" />
    <textarea id="descricao" name="descricao" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('descricao', $codigoErro->descricao ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Descreva o que este código de erro significa.</p>
</div>

{{-- Modelos Associados (Checkboxes com Busca) --}}
<div class="mt-4"
     x-data="{
         search: '', // Termo de busca
         modelosAgrupados: {{ json_encode($modelosAgrupados) }}, // Dados dos modelos passados pelo PHP
         selectedModelosIds: {{ json_encode(old('modelos', $selectedModelosIds ?? [])) }}, // IDs selecionados (se houver erro de validação ou edição)

         // Filtra os modelos com base na busca (case-insensitive)
         get filteredModelos() {
             if (this.search === '') {
                 return this.modelosAgrupados;
             }
             const searchTerm = this.search.toLowerCase();
             const filtered = {};
             for (const marca in this.modelosAgrupados) {
                 const modelosDaMarcaFiltrados = Object.entries(this.modelosAgrupados[marca])
                     .filter(([id, nome]) => nome.toLowerCase().includes(searchTerm));

                 if (modelosDaMarcaFiltrados.length > 0) {
                     filtered[marca] = Object.fromEntries(modelosDaMarcaFiltrados);
                 }
             }
             return filtered;
         }
     }">

    {{-- Label --}}
    <x-input-label for="modelo-search" :value="__('Modelos Afetados')" />

    {{-- Campo de Busca --}}
    <x-text-input id="modelo-search" x-model="search" type="text" placeholder="Buscar modelo..." class="block w-full mt-1 text-sm py-1"/>

    {{-- Lista de Checkboxes --}}
    <div class="block mt-2 w-full h-48 overflow-y-auto border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm p-2 space-y-2">
        {{-- Iterar sobre as marcas --}}
        <template x-for="(modelosDaMarca, marcaNome) in filteredModelos" :key="marcaNome">
            <div class="mb-2">
                <strong class="block text-sm font-medium text-gray-700 dark:text-gray-300 border-b border-gray-200 dark:border-gray-600 pb-1 mb-1" x-text="marcaNome"></strong>
                {{-- Iterar sobre os modelos da marca --}}
                <template x-for="(modeloNome, modeloId) in modelosDaMarca" :key="modeloId">
                    <label class="flex items-center space-x-2 text-sm">
                        <input type="checkbox"
                               name="modelos[]"
                               :value="modeloId"
                               :checked="selectedModelosIds.map(String).includes(String(modeloId))"
                               class="rounded dark:bg-gray-800 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                        <span x-text="modeloNome"></span>
                    </label>
                </template>
            </div>
        </template>
        {{-- Mensagem se a busca não encontrar nada --}}
        <template x-if="Object.keys(filteredModelos).length === 0 && search !== ''">
             <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum modelo encontrado para "<span x-text="search"></span>".</p>
        </template>
    </div>

    <x-input-error :messages="$errors->get('modelos')" class="mt-2" />
    <x-input-error :messages="$errors->get('modelos.*')" class="mt-2" /> {{-- Erros para itens específicos do array --}}
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Selecione um ou mais modelos onde este erro ocorre. Use a busca para filtrar a lista.</p>
</div>

{{-- Publico (Checkbox) --}}
<div class="block mt-4">
    <label for="publico" class="inline-flex items-center">
        <input id="publico" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="publico" value="1" {{ old('publico', isset($codigoErro) && $codigoErro->publico) ? 'checked' : '' }}>
        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Tornar público?') }}</span>
    </label>
     <x-input-error :messages="$errors->get('publico')" class="mt-2" />
     <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Se marcado, este código de erro (e suas soluções públicas) poderá ser visível para usuários não autenticados.</p>
</div> 