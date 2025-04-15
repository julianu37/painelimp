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

{{-- Modelos Associados (Select Múltiplo) --}}
<div class="mt-4">
    <x-input-label for="modelos" :value="__('Modelos Afetados (Opcional)')" />
    <select id="modelos" name="modelos[]" multiple
            class="block mt-1 w-full h-48 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
        {{-- Usaremos optgroup para agrupar por marca --}}
        @foreach ($modelosAgrupados as $marcaNome => $modelosDaMarca)
            <optgroup label="{{ $marcaNome }}">
                @foreach ($modelosDaMarca as $modeloId => $modeloNome)
                    <option value="{{ $modeloId }}"
                        {{-- Verifica se o ID está no array de IDs antigos ou nos IDs associados atualmente --}}
                        {{ in_array($modeloId, old('modelos', $codigoErro->modelos->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>
                        {{ $modeloNome }}
                    </option>
                @endforeach
            </optgroup>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('modelos')" class="mt-2" />
    <x-input-error :messages="$errors->get('modelos.*')" class="mt-2" /> {{-- Erros para itens específicos do array --}}
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Selecione um ou mais modelos onde este erro ocorre (Ctrl/Cmd + Clique para selecionar múltiplos). Se for um erro genérico, não selecione nenhum.</p>
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