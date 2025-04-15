{{-- Título (Opcional) --}}
<div>
    <x-input-label for="titulo" :value="__('Título do Vídeo (Opcional)')" />
    <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo" :value="old('titulo', $video->titulo ?? '')" autofocus />
    <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Um título descritivo, se aplicável.</p>
</div>

{{-- Tipo de Vídeo --}}
<div class="mt-4">
    <x-input-label for="tipo" :value="__('Tipo de Vídeo')" />
    <select id="tipo" name="tipo" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
        <option value="upload" {{ old('tipo', $video->tipo ?? 'upload') == 'upload' ? 'selected' : '' }}>Upload de Arquivo</option>
        <option value="link" {{ old('tipo', $video->tipo ?? '') == 'link' ? 'selected' : '' }}>Link Externo (YouTube, Vimeo, etc.)</option>
    </select>
    <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
</div>

{{-- Campo para Upload de Arquivo --}}
<div class="mt-4" id="campo-upload">
    <x-input-label for="video_upload" :value="__('Arquivo de Vídeo')" />
    <input id="video_upload" name="video_upload" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
           accept="video/mp4,video/webm,video/ogg" {{ (isset($video) && $video->tipo == 'upload') ? '' : 'required' }}> {{-- Obrigatório apenas se tipo=upload e na criação --}}
     <x-input-error :messages="$errors->get('video_upload')" class="mt-2" />
     <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Formatos aceitos: MP4, WebM, Ogg. Tamanho máximo: 50MB.</p> {{-- TODO: Ajustar validação no backend e limite de tamanho --}}
      @if (isset($video) && $video->tipo == 'upload')
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Vídeo atual: {{ basename($video->url_ou_path) }}. Deixe vazio se não quiser alterar.</p>
        {{-- Poderia adicionar um player básico se quisesse visualizar o vídeo atual --}}
        {{-- <video controls width="320" class="mt-2 border border-gray-300 rounded"><source src="{{ Storage::url($video->url_ou_path) }}" type="video/mp4">Seu navegador não suporta vídeo.</video> --}}
     @endif
</div>

{{-- Campo para Link Externo --}}
<div class="mt-4" id="campo-link" style="display: none;"> {{-- Começa oculto --}}
    <x-input-label for="url_ou_path" :value="__('URL do Vídeo Externo')" />
    <x-text-input id="url_ou_path" class="block mt-1 w-full" type="url" name="url_ou_path" :value="old('url_ou_path', (isset($video) && $video->tipo == 'link') ? $video->url_ou_path : '')" placeholder="https://www.youtube.com/watch?v=..." />
    <x-input-error :messages="$errors->get('url_ou_path')" class="mt-2" />
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Cole a URL completa do vídeo.</p>
</div>

{{-- Script para alternar campos --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tipoSelect = document.getElementById('tipo');
        const campoUpload = document.getElementById('campo-upload');
        const campoLink = document.getElementById('campo-link');
        const inputUpload = document.getElementById('video_upload');
        const inputLink = document.getElementById('url_ou_path');
        const isEditing = {{ isset($video) ? 'true' : 'false' }};
        const currentType = '{{ $video->tipo ?? 'upload' }}';

        function toggleFields() {
            if (tipoSelect.value === 'upload') {
                campoUpload.style.display = 'block';
                campoLink.style.display = 'none';
                inputLink.value = ''; // Limpa o campo não usado
                 // Torna upload obrigatório apenas se for criação OU se era upload e está editando
                if (!isEditing || (isEditing && currentType === 'upload')) {
                     inputUpload.required = true;
                } else {
                     inputUpload.required = false; // Não obrigatório se está editando um link ou se mudou para upload
                }
                inputLink.required = false;
            } else { // tipo === 'link'
                campoUpload.style.display = 'none';
                campoLink.style.display = 'block';
                inputUpload.value = ''; // Limpa o campo não usado
                inputUpload.required = false;
                 // Torna link obrigatório apenas se for criação ou se está editando
                inputLink.required = true;
            }
        }

        tipoSelect.addEventListener('change', toggleFields);

        // Garante que o estado inicial esteja correto ao carregar a página (especialmente na edição com erros de validação)
        toggleFields();
    });
</script>

{{-- TODO: Campos para associação (videoable_type, videoable_id) --}} 