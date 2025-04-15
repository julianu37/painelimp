{{-- Código de Erro Associado (Apenas na Criação) --}}
@if (!isset($solucao)) {{-- Mostra apenas se não estiver editando --}}
    <div>
        <x-input-label for="codigo_erro_id" :value="__('Código de Erro Associado')" />
        <select id="codigo_erro_id" name="codigo_erro_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
            <option value="">-- Selecione o Código --</option>
            @foreach ($codigosErro as $id => $codigo)
                <option value="{{ $id }}"
                        {{ old('codigo_erro_id', $solucao->codigo_erro_id ?? $selectedCodigoErroId ?? '') == $id ? 'selected' : '' }}>
                    {{ $codigo }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('codigo_erro_id')" class="mt-2" />
    </div>
@else
    {{-- Mostra o código associado na edição (não editável aqui) --}}
     <div class="mt-4">
        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Código de Erro Associado:</span>
        <span class="ml-2 text-sm text-gray-900 dark:text-white">{{ $solucao->codigoErro->codigo ?? 'N/A' }}</span>
         {{-- Campo oculto para manter o ID, embora não seja usado na validação de update --}}
        <input type="hidden" name="codigo_erro_id" value="{{ $solucao->codigo_erro_id }}">
    </div>
@endif

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