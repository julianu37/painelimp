<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Código de Erro') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-alert-messages />

                    {{-- Formulário de edição de código de erro --}}
                    <form method="POST" action="{{ route('admin.codigos.update', $codigoErro) }}">
                        @csrf
                        @method('PUT')

                        {{-- Inclui o formulário parcial, passando o código de erro existente --}}
                        @include('admin.codigos._form', ['codigoErro' => $codigoErro])

                        {{-- Botões de Ação --}}
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.codigos.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
                                Cancelar
                            </a>
                            <x-primary-button>
                                {{ __('Atualizar Código') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> 