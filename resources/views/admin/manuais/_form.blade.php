{{-- Nome --}}
<div class="mt-4">
    <x-input-label for="nome" :value="__('Nome do Manual')" />
    <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome', $manual->nome ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
</div>

{{-- Modelo(s) da Impressora --}}
<div class="mt-4">
    <x-input-label for="modelos" :value="__('Modelo(s) da Impressora')" />

    {{-- Campo de Busca --}}
    <input type="search" id="modelo-search" placeholder="Buscar modelos..."
           class="block w-full mb-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm text-sm">

    {{-- Lista de Checkboxes --}}
    <div id="modelo-checkbox-list" class="max-h-60 overflow-y-auto border border-gray-300 dark:border-gray-700 rounded-md p-2 space-y-1">
        @forelse($modelos as $modelo)
            <div class="modelo-item" data-nome="{{ strtolower(($modelo->marca->nome ?? '') . ' ' . $modelo->nome) }}">
                <label for="modelo-{{ $modelo->id }}" class="flex items-center">
                    <input type="checkbox" id="modelo-{{ $modelo->id }}" name="modelos[]" value="{{ $modelo->id }}"
                           class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                           @if(in_array($modelo->id, old('modelos', $selectedModelosIds ?? []))) checked @endif
                    >
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $modelo->marca->nome ?? 'Sem Marca' }} - {{ $modelo->nome }}</span>
                </label>
            </div>
        @empty
             <p class="text-sm text-gray-500 dark:text-gray-400 italic">Nenhum modelo cadastrado.</p>
        @endforelse
    </div>
    <x-input-error :messages="$errors->get('modelos')" class="mt-2" />
    <x-input-error :messages="$errors->get('modelos.*')" class="mt-2" />
</div>

{{-- Descrição --}}
<div class="mt-4">
    <x-input-label for="descricao" :value="__('Descrição (Opcional)')" />
    <textarea id="descricao" name="descricao" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('descricao', $manual->descricao ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
</div>

{{-- Tipo de Manual --}}
<div class="mt-4">
    <x-input-label for="tipo" :value="__('Tipo de Manual')" />
    <select id="tipo" name="tipo"
            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
            onchange="toggleManualFields(this.value)" {{-- Chama a função JS na mudança --}}
            required>
        <option value="pdf" {{ old('tipo', $manual->tipo ?? 'pdf') == 'pdf' ? 'selected' : '' }}>PDF</option>
        <option value="html" {{ old('tipo', $manual->tipo ?? '') == 'html' ? 'selected' : '' }}>HTML (Pasta)</option>
    </select>
    <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
</div>

{{-- Campo Arquivo PDF (condicional) --}}
<div class="mt-4" id="campo-arquivo-pdf">
    <x-input-label for="arquivo" :value="__('Arquivo PDF')" />
    <input id="arquivo" name="arquivo" type="file" accept=".pdf"
           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
            {{-- A validação 'required' será feita no controller --}}
    <x-input-error :messages="$errors->get('arquivo')" class="mt-2" />
    @if (!empty($manual->arquivo_path) && $manual->tipo == 'pdf')
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            Arquivo atual: <a href="{{ Storage::url($manual->arquivo_path) }}" target="_blank" class="underline">{{ $manual->arquivo_nome_original ?? basename($manual->arquivo_path) }}</a>.
            Deixe em branco para manter o arquivo atual.
        </p>
    @endif
</div>

{{-- Campo Caminho HTML (condicional) --}}
<div class="mt-4" id="campo-caminho-html" style="display: none;"> {{-- Começa escondido --}}
    <x-input-label for="caminho_html" :value="__('Caminho Relativo para index.html')" />
    <x-text-input id="caminho_html" class="block mt-1 w-full" type="text" name="caminho_html" :value="old('caminho_html', $manual->caminho_html ?? '')"
                  placeholder="Ex: html-manuais/manual-xyz/index.html" />
    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Caminho a partir da pasta 'public'. Ex: html-manuais/nome-da-pasta-manual/index.html</p>
    <x-input-error :messages="$errors->get('caminho_html')" class="mt-2" />
     @if (!empty($manual->caminho_html) && $manual->tipo == 'html')
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            Caminho atual: <a href="{{ asset($manual->caminho_html) }}" target="_blank" class="underline">{{ $manual->caminho_html }}</a>.
        </p>
    @endif
</div>

{{-- Publico (Checkbox) --}}
<div class="block mt-4">
    <label for="publico" class="inline-flex items-center">
        <input id="publico" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="publico" value="1" {{ old('publico', $manual->publico ?? false) ? 'checked' : '' }}>
        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Visível publicamente?') }}</span>
    </label>
    <x-input-error :messages="$errors->get('publico')" class="mt-2" />
</div>

{{-- Script para filtrar checkboxes --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('modelo-search');
        const checkboxList = document.getElementById('modelo-checkbox-list');
        const modeloItems = checkboxList.querySelectorAll('.modelo-item');

        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.toLowerCase();

            modeloItems.forEach(function(item) {
                const nomeModelo = item.dataset.nome || ''; // Pega o nome do data attribute
                if (nomeModelo.includes(searchTerm)) {
                    item.style.display = ''; // Mostra o item
                } else {
                    item.style.display = 'none'; // Esconde o item
                }
            });
        });
    });
</script>

{{-- Script para mostrar/ocultar campos PDF/HTML --}}
<script>
    function toggleManualFields(tipoSelecionado) {
        const campoPdf = document.getElementById('campo-arquivo-pdf');
        const campoHtml = document.getElementById('campo-caminho-html');

        if (tipoSelecionado === 'html') {
            campoPdf.style.display = 'none';
            campoHtml.style.display = 'block';
        } else { // pdf ou outro valor
            campoPdf.style.display = 'block';
            campoHtml.style.display = 'none';
        }
    }

    // Chama a função no carregamento inicial da página para ajustar os campos
    document.addEventListener('DOMContentLoaded', function() {
        const tipoInicial = document.getElementById('tipo').value;
        toggleManualFields(tipoInicial);
    });
</script> 