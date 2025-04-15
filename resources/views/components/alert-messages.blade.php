@if (session('success'))
    <div class="mb-4 px-4 py-3 leading-normal text-green-700 bg-green-100 rounded-lg" role="alert">
        <p>{{ session('success') }}</p>
    </div>
@endif

@if (session('error'))
    <div class="mb-4 px-4 py-3 leading-normal text-red-700 bg-red-100 rounded-lg" role="alert">
        <p>{{ session('error') }}</p>
    </div>
@endif

{{-- Para exibir erros de validação gerais (não específicos de um campo) --}}
@if ($errors->any() && !$errors->hasAny(array_keys(request()->input()))) {{-- Evita mostrar se já houver erro específico de campo --}}
    <div class="mb-4 px-4 py-3 leading-normal text-red-700 bg-red-100 rounded-lg" role="alert">
        <p>Ocorreram erros de validação:</p>
        <ul class="mt-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 