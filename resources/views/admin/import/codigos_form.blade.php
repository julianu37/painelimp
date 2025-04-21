<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
            {{ __('Importar Códigos de Erro para Modelos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <p class="mb-4 text-sm text-gray-600">
                        Selecione os modelos aos quais os códigos de erro (código e descrição) da base de dados de origem
                        (conexão '{{ config('database.connections.mysql_import.database', 'NÃO CONFIGURADA') }}')
                         serão associados. Códigos já existentes serão associados se ainda não estiverem; códigos novos serão criados.
                    </p>
                    <p class="mb-4 text-sm text-red-600 font-semibold">
                        Atenção: Certifique-se que a conexão 'mysql_import' esteja corretamente configurada em <code>config/database.php</code> e <code>.env</code>.
                        O nome da tabela de origem configurado é: <code>{{ app(App\Services\CodigoImportService::class)->getNomeTabelaOrigem() }}</code>.
                    </p>

                    {{-- Exibir mensagens de sucesso ou erro --}}
                    <x-alert-messages />

                    <form action="{{ route('admin.import.codigos.process') }}" method="POST">
                        @csrf

                        <div class="mb-6">
                            <label class="block font-medium text-sm text-gray-700 mb-2">Selecione os Modelos de Destino:</label>
                            <div class="max-h-96 overflow-y-auto border border-gray-300 rounded-md p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                @forelse ($modelos as $modelo)
                                    <div class="flex items-center">
                                        <input type="checkbox"
                                               name="modelo_ids[]"
                                               id="modelo_{{ $modelo->id }}"
                                               value="{{ $modelo->id }}"
                                               {{-- Manter selecionado se houve erro de validação --}}
                                               @if(is_array(old('modelo_ids')) && in_array($modelo->id, old('modelo_ids')))
                                                checked
                                               @endif
                                               class="rounded border-gray-300 text-cyan-600 shadow-sm focus:ring-cyan-500">
                                        <label for="modelo_{{ $modelo->id }}" class="ml-2 text-sm text-gray-800">{{ $modelo->nome }} (@ {{$modelo->marca->nome}})</label>
                                    </div>
                                @empty
                                    <p class="text-gray-500 col-span-full">Nenhum modelo encontrado para seleção.</p>
                                @endforelse
                            </div>
                             @error('modelo_ids')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                            @error('modelo_ids.*')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <x-primary-button type="submit">
                                {{ __('Importar Códigos e Associar') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout> 