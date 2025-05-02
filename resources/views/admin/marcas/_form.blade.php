<div>
    <x-input-label for="nome" :value="__('Nome da Marca')" />
    <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome', $marca->nome ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
</div>

{{-- Campo para Upload do Logo --}}
<div class="mt-4">
    <x-input-label for="logo" :value="__('Logo da Marca (Opcional)')" />
    <input id="logo" name="logo" type="file" accept="image/*"
           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Tipos permitidos: JPG, JPEG, PNG, WEBP, SVG. Máx 2MB.</p>
    <x-input-error :messages="$errors->get('logo')" class="mt-2" />

    {{-- Exibir Logo Atual (apenas na edição) --}}
    @isset($marca)
        @if ($marca->logo_path && Storage::disk('public')->exists($marca->logo_path))
            <div class="mt-4">
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Logo Atual:</p>
                <img src="{{ Storage::url($marca->logo_path) }}" alt="Logo {{ $marca->nome }}" class="h-16 w-auto rounded border border-gray-300 dark:border-gray-600">
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Envie um novo arquivo para substituir o logo atual.</p>
            </div>
        @endif
    @endisset
</div> 