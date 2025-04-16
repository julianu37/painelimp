<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Imagem') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Formulário de edição de imagem --}}
                    {{-- O método real é PUT/PATCH, mas o HTML só suporta GET/POST. Laravel usa campo oculto _method --}}
                    {{-- enctype é essencial para upload de arquivos --}}
                    <form method="POST" action="{{ route('admin.imagens.update', $imagem) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- ou PATCH --}}

                        {{-- Inclui o formulário parcial, passando a imagem existente --}}
                        @include('admin.imagens._form', ['imagem' => $imagem])

                        {{-- Botões de Ação --}}
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.imagens.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
                                Cancelar
                            </a>
                            <x-primary-button>
                                {{ __('Atualizar Imagem') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> 