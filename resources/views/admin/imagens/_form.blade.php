{{-- Título --}}
<div>
    <x-input-label for="titulo" :value="__('Título da Imagem')" />
    <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo" :value="old('titulo', $imagem->titulo ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Um título descritivo para a imagem.</p>
</div>

{{-- Upload de Imagem --}}
<div class="mt-4">
    <x-input-label for="imagem" :value="__('Arquivo de Imagem')" />
    <input id="imagem" name="imagem" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
           accept="image/jpeg,image/png,image/gif,image/webp" {{ isset($imagem) ? '' : 'required' }}>
     <x-input-error :messages="$errors->get('imagem')" class="mt-2" />
     <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Formatos aceitos: JPG, PNG, GIF, WEBP. Tamanho máximo: 2MB.</p> {{-- TODO: Ajustar validação no backend --}}
</div>

{{-- Miniatura Atual (apenas na edição) --}}
@isset($imagem)
    <div class="mt-4">
        <p class="block font-medium text-sm text-gray-700 dark:text-gray-300">Imagem Atual:</p>
        <img src="{{ Storage::url($imagem->path) }}" alt="{{ $imagem->titulo }}" class="mt-2 h-40 w-auto object-contain rounded border border-gray-300 dark:border-gray-600">
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Deixe o campo "Arquivo de Imagem" vazio se não quiser alterar a imagem atual.</p>
    </div>
@endisset

{{-- TODO: Campos para associação (imageable_type, imageable_id) --}}
{{-- Poderiam ser campos ocultos preenchidos se a criação/edição for iniciada a partir de um Manual ou Solução,
     ou selects para escolher a associação manualmente. Por ora, a associação será feita no controller. --}} 