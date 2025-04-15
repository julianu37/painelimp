{{-- Nome --}}
<div>
    <x-input-label for="name" :value="__('Nome')" />
    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $tecnico->name ?? '')" required autofocus autocomplete="name" />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

{{-- Email --}}
<div class="mt-4">
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $tecnico->email ?? '')" required autocomplete="username" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

{{-- Senha --}}
<div class="mt-4">
    <x-input-label for="password" :value="__('Senha')" />
    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" {{ isset($tecnico) ? '' : 'required' }} />
    <x-input-error :messages="$errors->get('password')" class="mt-2" />
    @isset($tecnico)
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Deixe em branco para não alterar a senha.</p>
    @endisset
</div>

{{-- Confirmar Senha --}}
<div class="mt-4">
    <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />
    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" {{ isset($tecnico) ? '' : 'required' }} />
    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>

{{-- Campo oculto para a role (sempre 'tecnico') --}}
<input type="hidden" name="role" value="tecnico">

{{-- TODO: Campo para Avatar (opcional) --}}
{{-- <div class="mt-4">
    <x-input-label for="avatar" :value="__('Avatar (Opcional)')" />
    <input id="avatar" name="avatar" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
    <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
    @if (isset($tecnico) && $tecnico->avatar)
        <div class="mt-2">
            <img src="{{ Storage::url($tecnico->avatar) }}" alt="Avatar Atual" class="h-16 w-16 rounded-full object-cover">
            <label for="remover_avatar" class="inline-flex items-center mt-1">
                <input id="remover_avatar" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remover_avatar" value="1">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remover Avatar') }}</span>
            </label>
        </div>
    @endif
</div> --}} 