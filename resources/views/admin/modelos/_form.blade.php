{{-- Marca --}}
<div>
    <x-input-label for="marca_id" :value="__('Marca')" />
    <select id="marca_id" name="marca_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
        <option value="">-- Selecione a Marca --</option>
        @foreach ($marcas as $id => $nome)
            <option value="{{ $id }}"
                    {{ old('marca_id', $modelo->marca_id ?? $selectedMarcaId ?? '') == $id ? 'selected' : '' }}>
                {{ $nome }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('marca_id')" class="mt-2" />
</div>

{{-- Nome do Modelo --}}
<div class="mt-4">
    <x-input-label for="nome" :value="__('Nome do Modelo')" />
    <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome', $modelo->nome ?? '')" required />
    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
</div> 