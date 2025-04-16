<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <?php echo e(__('Código de Erro:')); ?> <?php echo e($codigoErro->codigo); ?>

            </h2>
            
            <a href="<?php echo e(url()->previous() ?? route('codigos.index')); ?>"
               class="inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                Voltar
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-1 text-indigo-700 dark:text-indigo-400"><?php echo e($codigoErro->titulo ?: $codigoErro->codigo); ?></h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Código: <?php echo e($codigoErro->codigo); ?></p>
                    <h4 class="text-lg font-semibold mb-2">Descrição do Problema</h4>
                    <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap"><?php echo e($codigoErro->descricao); ?></p>
                </div>
            </div>

            
            <?php if($codigoErro->imagens->isNotEmpty()): ?>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                        <h3 class="text-xl font-semibold mb-4">Imagens Relacionadas ao Código</h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            <?php $__currentLoopData = $codigoErro->imagens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imagem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="group text-center">
                                    <a href="<?php echo e(Storage::url($imagem->path)); ?>" target="_blank" data-lightbox="codigo-<?php echo e($codigoErro->id); ?>" data-title="<?php echo e($imagem->titulo); ?>">
                                        <img src="<?php echo e(Storage::url($imagem->path)); ?>" alt="<?php echo e($imagem->titulo); ?>" class="w-full h-32 object-cover rounded-md border border-gray-200 dark:border-gray-700 shadow-md hover:opacity-80 transition duration-150">
                                    </a>
                                     <p class="text-xs text-gray-600 dark:text-gray-400 mt-1 truncate" title="<?php echo e($imagem->titulo); ?>"><?php echo e($imagem->titulo); ?></p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            
            <?php if($codigoErro->videos->isNotEmpty()): ?>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                        <h3 class="text-xl font-semibold mb-4">Vídeos Relacionados ao Código</h3>
                        <ul class="space-y-3">
                            <?php $__currentLoopData = $codigoErro->videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-md">
                                    <span class="font-medium text-sm truncate pr-4" title="<?php echo e($video->titulo ?? 'Vídeo sem título'); ?>"><?php echo e($video->titulo ?? 'Vídeo sem título'); ?></span>
                                    <?php if($video->tipo === 'link'): ?>
                                        <a href="<?php echo e($video->url_ou_path); ?>" target="_blank" class="inline-flex items-center text-sm text-indigo-600 dark:text-indigo-400 hover:underline font-semibold whitespace-nowrap">
                                            Assistir <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        </a>
                                    <?php elseif($video->tipo === 'youtube'): ?>
                                        
                                        <a href="<?php echo e($video->url_ou_path); ?>" target="_blank" class="inline-flex items-center text-sm text-red-600 dark:text-red-400 hover:underline font-semibold whitespace-nowrap">
                                            Ver no YouTube <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(Storage::url($video->url_ou_path)); ?>" target="_blank" class="inline-flex items-center text-sm text-indigo-600 dark:text-indigo-400 hover:underline font-semibold whitespace-nowrap">
                                            Ver Vídeo <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                        </a>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold mb-6">Possíveis Soluções</h3>
                    <?php if($codigoErro->solucoes->isNotEmpty()): ?>
                        <div class="space-y-8">
                            <?php $__currentLoopData = $codigoErro->solucoes->load('imagens', 'videos'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $solucao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <div class="bg-gray-50 dark:bg-gray-900/50 p-5 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                                    <h4 class="text-lg font-bold mb-2 text-indigo-700 dark:text-indigo-400">Solução <?php echo e($index + 1); ?>: <?php echo e($solucao->titulo); ?></h4>
                                    <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-wrap mb-5"><?php echo e($solucao->descricao); ?></p>

                                    
                                    <?php if($solucao->imagens->isNotEmpty() || $solucao->videos->isNotEmpty()): ?>
                                        <div class="mt-3 border-t pt-3 dark:border-gray-600">
                                            <p class="text-xs font-medium text-gray-600 dark:text-gray-400 mb-2">Mídias da Solução:</p>

                                             
                                            <?php if($solucao->imagens->isNotEmpty()): ?>
                                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 mb-3">
                                                    <?php $__currentLoopData = $solucao->imagens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imagem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a href="<?php echo e($imagem->url); ?>" target="_blank" title="<?php echo e($imagem->titulo ?? $imagem->nome_original); ?>" class="block relative group">
                                                            <img src="<?php echo e($imagem->url); ?>" alt="<?php echo e($imagem->titulo ?? 'Imagem anexa'); ?>" class="w-full h-20 object-cover rounded-md shadow border dark:border-gray-700 group-hover:opacity-80 transition-opacity">
                                                            <p class="text-xs text-center mt-1 truncate text-gray-500 dark:text-gray-400" title="<?php echo e($imagem->titulo ?? $imagem->nome_original); ?>"><?php echo e($imagem->titulo ?? $imagem->nome_original); ?></p>
                                                        </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>

                                            
                                            <?php if($solucao->videos->isNotEmpty()): ?>
                                                <div class="space-y-2">
                                                    <?php $__currentLoopData = $solucao->videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div>
                                                            <?php if($video->tipo === 'link' && Str::contains($video->url_ou_path, ['youtube.com', 'youtu.be'])): ?>
                                                                
                                                                <?php
                                                                    parse_str(parse_url($video->url_ou_path, PHP_URL_QUERY), $query);
                                                                    $videoId = $query['v'] ?? Str::afterLast($video->url_ou_path, '/');
                                                                ?>
                                                                <div class="aspect-w-16 aspect-h-9 max-w-sm mb-1">
                                                                     <iframe src="https://www.youtube.com/embed/<?php echo e($videoId); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen class="rounded-md shadow border dark:border-gray-700"></iframe>
                                                                </div>
                                                                <p class="text-xs text-gray-500 dark:text-gray-400"><?php echo e($video->titulo ?? 'Vídeo YouTube'); ?></p>
                                                             <?php elseif($video->tipo === 'upload'): ?>
                                                                
                                                                <video controls preload="metadata" class="max-w-sm w-full rounded-md shadow border dark:border-gray-700 bg-black mb-1">
                                                                    <source src="<?php echo e($video->url_ou_path); ?>#t=0.1" type="<?php echo e(Storage::disk('public')->mimeType($video->path) ?? 'video/mp4'); ?>"> 
                                                                    Seu navegador não suporta o vídeo.
                                                                </video>
                                                                <p class="text-xs text-gray-500 dark:text-gray-400"><?php echo e($video->titulo ?? $video->nome_original); ?> (Upload)</p>
                                                             <?php else: ?> 
                                                                <a href="<?php echo e($video->url_ou_path); ?>" target="_blank" class="inline-flex items-center text-xs text-blue-600 hover:underline dark:text-blue-400">
                                                                    <svg class="w-3 h-3 mr-1 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                                                                    <?php echo e($video->titulo ?? $video->url_ou_path); ?>

                                                                </a>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-6">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-gray-100">Nenhuma solução encontrada</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Ainda não há soluções cadastradas para este código.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

             
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold mb-6">Comentários Técnicos</h3>

                    
                    <?php if(auth()->guard()->check()): ?>
                        <form action="<?php echo e(route('comentarios.store', ['comentavel_type' => 'codigo_erro', 'comentavel_id' => $codigoErro->id])); ?>" method="POST" enctype="multipart/form-data" class="mb-8 p-5 border rounded-lg dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 shadow-sm">
                            <?php echo csrf_field(); ?>
                            <div class="mb-4">
                                <label for="conteudo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deixe seu comentário ou sugestão:</label>
                                <textarea id="conteudo" name="conteudo" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required><?php echo e(old('conteudo')); ?></textarea>
                                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('conteudo'),'class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('conteudo')),'class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <label for="midias" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Anexar Arquivos <span class="text-xs">(Imagens, PDF, Vídeo Curto)</span></label>
                                    <input type="file" name="midias[]" id="midias" multiple class="block w-full text-sm text-gray-500 dark:text-gray-300
                                        border border-gray-300 dark:border-gray-700 rounded-md shadow-sm cursor-pointer
                                        focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500
                                        file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:text-sm file:font-semibold
                                        file:bg-indigo-50 dark:file:bg-indigo-900/50 file:text-indigo-700 dark:file:text-indigo-300
                                        hover:file:bg-indigo-100 dark:hover:file:bg-indigo-800/50">
                                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('midias'),'class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('midias')),'class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('midias.*'),'class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('midias.*')),'class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                                </div>
                                <div>
                                    <label for="youtube_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Link do YouTube</label>
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'youtube_link','type' => 'url','name' => 'youtube_link','class' => 'mt-1 block w-full','placeholder' => 'https://www.youtube.com/watch?v=...','value' => old('youtube_link')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'youtube_link','type' => 'url','name' => 'youtube_link','class' => 'mt-1 block w-full','placeholder' => 'https://www.youtube.com/watch?v=...','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('youtube_link'))]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('youtube_link'),'class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('youtube_link')),'class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                    <?php echo e(__('Enviar Comentário')); ?>

                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="text-center border rounded-lg p-6 bg-gray-50 dark:bg-gray-700/50 dark:border-gray-700 mb-8">
                             <p class="text-sm text-gray-700 dark:text-gray-300">
                                Para comentar ou adicionar anexos, por favor
                                <a href="<?php echo e(route('login')); ?>" class="font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">faça login</a> ou
                                <a href="<?php echo e(route('register')); ?>" class="font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">registre-se</a>.
                            </p>
                        </div>
                    <?php endif; ?>

                    
                    <h4 class="text-lg font-semibold mb-4">Histórico de Comentários</h4>
                    <?php if($codigoErro->comentarios->isNotEmpty()): ?>
                        <div class="space-y-6">
                            <?php $__currentLoopData = $codigoErro->comentarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comentario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <div class="p-4 bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <span class="font-semibold text-sm text-gray-800 dark:text-gray-200"><?php echo e($comentario->user->name ?? 'Usuário Anônimo'); ?></span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400 ml-2"><?php echo e($comentario->created_at->diffForHumans()); ?></span>
                                        </div>
                                        
                                        <?php if(Auth::user()?->isAdmin()): ?>
                                            <form action="<?php echo e(route('comentarios.destroy', $comentario)); ?>" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este comentário?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="text-gray-400 hover:text-red-500 dark:hover:text-red-400 text-xs" title="Excluir Comentário">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-gray-700 dark:text-gray-300 mb-4 whitespace-pre-wrap text-sm"><?php echo e($comentario->conteudo); ?></p>

                                    
                                    <?php if($comentario->midias->isNotEmpty()): ?>
                                        <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
                                            <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Anexos:</p>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                                <?php $__currentLoopData = $comentario->midias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $midia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="bg-gray-50 dark:bg-gray-700/50 p-2 rounded border dark:border-gray-600">
                                                        <?php if($midia->is_imagem): ?>
                                                            <a href="<?php echo e($midia->url); ?>" target="_blank" data-lightbox="comentario-<?php echo e($comentario->id); ?>" data-title="<?php echo e($midia->nome_original ?? 'Ver imagem'); ?>" class="block hover:opacity-80 transition">
                                                                <img src="<?php echo e($midia->url); ?>" alt="<?php echo e($midia->nome_original ?? 'Imagem anexa'); ?>" class="max-h-32 w-full rounded shadow-sm mb-1 object-contain border dark:border-gray-600">
                                                            </a>
                                                        <?php elseif($midia->is_video_mp4): ?>
                                                            <video controls class="max-h-40 w-full rounded shadow-sm mb-1 border dark:border-gray-600 bg-black">
                                                                <source src="<?php echo e($midia->url); ?>" type="video/mp4">
                                                                Seu navegador não suporta o vídeo MP4.
                                                            </video>
                                                        <?php elseif($midia->is_video_youtube): ?>
                                                            <div class="aspect-w-16 aspect-h-9 mb-1">
                                                                <iframe src="<?php echo e($midia->url); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen class="rounded shadow-sm border dark:border-gray-600"></iframe>
                                                            </div>
                                                        <?php elseif($midia->is_pdf): ?>
                                                            <a href="<?php echo e($midia->url); ?>" target="_blank" class="inline-flex items-center text-sm text-blue-600 hover:underline dark:text-blue-400 bg-white dark:bg-gray-800 px-2 py-1 rounded border dark:border-gray-600">
                                                                <svg class="w-4 h-4 mr-1.5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 0a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6.5A1.5 1.5 0 0 0 16.5 5h-5A1.5 1.5 0 0 1 10 .5V0H4zm8 6v4h4V6h-4zm-2 8H6v-2h4v2zm4 0h-2v-2h2v2zm0-3H6V9h8v2z"/></svg>
                                                                Ver PDF
                                                            </a>
                                                        <?php endif; ?>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 truncate" title="<?php echo e($midia->nome_original); ?>"><?php echo e($midia->nome_original); ?></p>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    
                                    <div class="mt-3 border-t pt-2 dark:border-gray-600 flex justify-between items-center">
                                        
                                        <div class="flex items-center space-x-2">
                                            <?php if(auth()->guard()->check()): ?> 
                                                <?php if($comentario->isLikedByAuthUser()): ?>
                                                    
                                                    <form action="<?php echo e(route('comments.unlike', $comentario)); ?>" method="POST" class="inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="flex items-center text-xs text-red-600 dark:text-red-500 hover:text-red-800 dark:hover:text-red-400" title="Remover Curtida">
                                                            
                                                            <svg class="w-4 h-4 mr-1 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                                            </svg>
                                                            Descurtir
                                                        </button>
                                                    </form>
                                                <?php else: ?>
                                                    
                                                    <form action="<?php echo e(route('comments.like', $comentario)); ?>" method="POST" class="inline">
                                                        <?php echo csrf_field(); ?>
                                                        <button type="submit" class="flex items-center text-xs text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-500" title="Curtir Comentário">
                                                            
                                                            <svg class="w-4 h-4 mr-1 fill-none stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                                            </svg>
                                                            Curtir
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            
                                            <span class="text-xs text-gray-500 dark:text-gray-400 ml-1">
                                                (<?php echo e($comentario->likers_count ?? 0); ?> curtida<?php echo e(($comentario->likers_count ?? 0) != 1 ? 's' : ''); ?>)
                                            </span>
                                        </div>

                                        
                                        
                                        
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-6 border-t dark:border-gray-700">
                            <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                              </svg>
                            <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-gray-100">Sem comentários</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Ainda não há comentários ou sugestões para este código.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
    
    <?php $__env->startPush('scripts'); ?>
        
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            // Opções do Lightbox (opcional)
            lightbox.option({
              'resizeDuration': 200,
              'wrapAround': true,
              'fadeDuration': 300
            })
        </script>
    <?php $__env->stopPush(); ?>
    <?php $__env->startPush('styles'); ?>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9noQE0ZAEps4hfPNEAXMlguw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            /* Ajustes para o tema escuro do lightbox, se necessário */
            .lb-dataContainer {
                background-color: rgba(31, 41, 55, 0.9); /* bg-gray-800 com alpha */
            }
            .lb-data .lb-details {
                color: #d1d5db; /* text-gray-300 */
            }
            .lb-data .lb-caption {
                 color: #e5e7eb; /* text-gray-200 */
            }
            .lb-data .lb-close {
                filter: invert(1) grayscale(100%) brightness(200%);
            }
            .lb-nav a.lb-prev, .lb-nav a.lb-next {
                 opacity: 0.6;
                 transition: opacity 0.2s ease-in-out;
            }
            .lb-nav a.lb-prev:hover, .lb-nav a.lb-next:hover {
                opacity: 1;
            }
        </style>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?> <?php /**PATH C:\painelimp\resources\views/public/codigos/show.blade.php ENDPATH**/ ?>