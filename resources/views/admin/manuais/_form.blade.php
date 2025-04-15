{{-- Nome --}}
<div>
    <x-input-label for="nome" :value="__('Nome do Manual')" />
    <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome', $manual->nome ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
</div>

{{-- Modelo Associado (Select com optgroup) --}}
<div class="mt-4">
    <x-input-label for="modelo_id" :value="__('Modelo da Impressora (Opcional)')" />
    <select id="modelo_id" name="modelo_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
        <option value="">-- Manual Genérico / N/A --</option>
        @foreach ($modelosAgrupados as $marcaNome => $modelos)
            <optgroup label="{{ $marcaNome }}">
                @foreach ($modelos as $modeloId => $modeloNome)
                    <option value="{{ $modeloId }}"
                        {{ old('modelo_id', $manual->modelo_id ?? $selectedModeloId ?? '') == $modeloId ? 'selected' : '' }}>
                        {{ $modeloNome }}
                    </option>
                @endforeach
            </optgroup>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('modelo_id')" class="mt-2" />
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Associe este manual a um modelo específico, se aplicável.</p>
</div>

{{-- Descrição --}}
<div class="mt-4">
    <x-input-label for="descricao" :value="__('Descrição (Opcional)')" />
    <textarea id="descricao" name="descricao" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('descricao', $manual->descricao ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
</div>

{{-- Equipamentos Relacionados --}}
<div class="mt-4">
    <x-input-label for="equipamentos" :value="__('Equipamento(s) Relacionado(s) (Opcional)')" />
    <x-text-input id="equipamentos" class="block mt-1 w-full" type="text" name="equipamentos" :value="old('equipamentos', $manual->equipamentos ?? '')" />
    <x-input-error :messages="$errors->get('equipamentos')" class="mt-2" />
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Separe múltiplos equipamentos por vírgula.</p>
</div>

{{-- Arquivo PDF --}}
<div class="mt-4">
    <x-input-label for="arquivo" :value="__('Arquivo PDF')" />
    {{-- Input file estilizado como os outros --}}
    <input id="arquivo" name="arquivo" type="file" class="block w-full text-sm text-gray-500 dark:text-gray-300
        border border-gray-300 dark:border-gray-700 rounded-md shadow-sm cursor-pointer
        focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500
        file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:text-sm file:font-semibold
        file:bg-indigo-50 dark:file:bg-indigo-900/50 file:text-indigo-700 dark:file:text-indigo-300
        hover:file:bg-indigo-100 dark:hover:file:bg-indigo-800/50"
           accept=".pdf" {{ isset($manual) ? '' : 'required' }}>
     <x-input-error :messages="$errors->get('arquivo')" class="mt-2" />
     <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Apenas arquivos PDF. Máx 20MB.</p> {{-- TODO: Validar tamanho no backend --}}
</div>

{{-- Arquivo Atual (apenas na edição) --}}
@isset($manual)
    <div class="mt-4">
        <p class="block font-medium text-sm text-gray-700 dark:text-gray-300">Arquivo Atual:</p>
        <a href="{{ Storage::url($manual->arquivo_path) }}" target="_blank" class="text-indigo-600 hover:underline text-sm">
            {{ $manual->arquivo_nome_original ?? basename($manual->arquivo_path) }}
        </a>
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Deixe o campo "Arquivo PDF" vazio se não quiser alterar o arquivo atual.</p>
    </div>
@endisset

{{-- Publico (Checkbox) --}}
<div class="block mt-4">
    <label for="publico" class="inline-flex items-center">
        <input id="publico" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="publico" value="1" {{ old('publico', isset($manual) && $manual->publico) ? 'checked' : '' }}>
        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Tornar público?') }}</span>
    </label>
     <x-input-error :messages="$errors->get('publico')" class="mt-2" />
     <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Se marcado, este manual poderá ser baixado por usuários autenticados.</p>
</div> 