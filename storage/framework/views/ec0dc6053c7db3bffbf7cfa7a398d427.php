<?php if (isset($component)) { $__componentOriginal91fdd17964e43374ae18c674f95cdaa3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal91fdd17964e43374ae18c674f95cdaa3 = $attributes; } ?>
<?php $component = App\View\Components\AdminLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdminLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <?php echo e(__('Editar Solução')); ?>: <?php echo e($solucao->titulo); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <?php if (isset($component)) { $__componentOriginal23d008af6b2bbad4d7f1d91e2d40a6d9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23d008af6b2bbad4d7f1d91e2d40a6d9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert-messages','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert-messages'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23d008af6b2bbad4d7f1d91e2d40a6d9)): ?>
<?php $attributes = $__attributesOriginal23d008af6b2bbad4d7f1d91e2d40a6d9; ?>
<?php unset($__attributesOriginal23d008af6b2bbad4d7f1d91e2d40a6d9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23d008af6b2bbad4d7f1d91e2d40a6d9)): ?>
<?php $component = $__componentOriginal23d008af6b2bbad4d7f1d91e2d40a6d9; ?>
<?php unset($__componentOriginal23d008af6b2bbad4d7f1d91e2d40a6d9); ?>
<?php endif; ?>

                    <form action="<?php echo e(route('admin.solucoes.update', $solucao)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                         
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Código de Erro Associado</label>
                            <p class="mt-1 text-gray-600 dark:text-gray-400"><?php echo e($solucao->codigoErro->codigo ?? 'N/A'); ?></p>
                        </div>

                        
                        <div class="mb-4">
                            <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título <span class="text-red-500">*</span></label>
                            <input type="text" name="titulo" id="titulo" value="<?php echo e(old('titulo', $solucao->titulo)); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" required>
                            <?php $__errorArgs = ['titulo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-4">
                            <label for="descricao" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descrição Detalhada</label>
                            <textarea name="descricao" id="descricao" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"><?php echo e(old('descricao', $solucao->descricao)); ?></textarea>
                             <?php $__errorArgs = ['descricao'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="border-t dark:border-gray-700 pt-4 mt-6">
                            <h3 class="text-md font-medium mb-4">Gerenciar Mídias</h3>

                            
                            <div class="mb-6">
                                <h4 class="text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Imagens Atuais:</h4>
                                <?php if($solucao->imagens->isNotEmpty()): ?>
                                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                                        <?php $__currentLoopData = $solucao->imagens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imagem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="relative group border p-2 rounded-md dark:border-gray-700">
                                                <img src="<?php echo e($imagem->url); ?>" alt="<?php echo e($imagem->titulo ?? 'Imagem anexa'); ?>" class="w-full h-24 object-cover rounded-md shadow-sm mb-2">
                                                <p class="text-xs text-center truncate mb-2" title="<?php echo e($imagem->titulo ?? $imagem->nome_original); ?>"><?php echo e($imagem->titulo ?? $imagem->nome_original); ?></p>
                                                
                                                <div class="text-center">
                                                     <label for="remover_imagem_<?php echo e($imagem->id); ?>" class="flex items-center justify-center text-xs text-red-600 dark:text-red-400 hover:text-red-800 cursor-pointer">
                                                        <input type="checkbox" name="remover_imagens[]" id="remover_imagem_<?php echo e($imagem->id); ?>" value="<?php echo e($imagem->id); ?>" class="mr-1 h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                                        Remover
                                                    </label>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php else: ?>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Nenhuma imagem associada.</p>
                                <?php endif; ?>
                            </div>

                            
                            <div class="mb-4">
                                <label for="imagens" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Adicionar Novas Imagens (JPG, PNG, GIF, WEBP - Máx 10MB cada)</label>
                                <input type="file" name="imagens[]" id="imagens" multiple accept="image/jpeg,image/png,image/gif,image/webp" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-gray-700 dark:file:text-gray-300 dark:hover:file:bg-gray-600">
                                <?php $__errorArgs = ['imagens.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                             
                            <div class="mb-6">
                                <h4 class="text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Vídeos Atuais:</h4>
                                <?php if($solucao->videos->isNotEmpty()): ?>
                                    <ul class="list-none space-y-2 text-xs">
                                        <?php $__currentLoopData = $solucao->videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="flex justify-between items-center border-b pb-2 dark:border-gray-700">
                                                 <span class="flex-1 mr-2">
                                                    <?php if($video->tipo === 'link'): ?>
                                                        <a href="<?php echo e($video->url_ou_path); ?>" target="_blank" class="text-blue-600 hover:underline dark:text-blue-400 truncate block" title="<?php echo e($video->url_ou_path); ?>"><?php echo e($video->titulo ?? $video->url_ou_path); ?></a> (Link YouTube)
                                                    <?php else: ?>
                                                        <a href="<?php echo e($video->url_ou_path); ?>" target="_blank" class="text-blue-600 hover:underline dark:text-blue-400 truncate block" title="<?php echo e($video->nome_original); ?>"><?php echo e($video->titulo ?? $video->nome_original); ?></a> (Upload)
                                                    <?php endif; ?>
                                                </span>
                                                
                                                <label for="remover_video_<?php echo e($video->id); ?>" class="flex items-center text-xs text-red-600 dark:text-red-400 hover:text-red-800 cursor-pointer ml-2 whitespace-nowrap">
                                                    <input type="checkbox" name="remover_videos[]" id="remover_video_<?php echo e($video->id); ?>" value="<?php echo e($video->id); ?>" class="mr-1 h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                                    Remover
                                                </label>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php else: ?>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Nenhum vídeo associado.</p>
                                <?php endif; ?>
                            </div>

                            
                            <div class="mb-4">
                                <label for="videos" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Adicionar Novos Vídeos (MP4, MOV, AVI, WMV - Máx 50MB cada)</label>
                                <input type="file" name="videos[]" id="videos" multiple accept="video/mp4,video/quicktime,video/x-msvideo,video/x-ms-wmv" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-gray-700 dark:file:text-gray-300 dark:hover:file:bg-gray-600">
                                <?php $__errorArgs = ['videos.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                             
                             
                             <div class="mb-4">
                                <label for="youtube_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Link do YouTube (Substitui link existente, se houver):</label>
                                <?php
                                    // Encontra o primeiro vídeo do tipo link, se existir
                                    $youtubeVideo = $solucao->videos->firstWhere('tipo', 'link');
                                ?>
                                <input type="url" name="youtube_link" id="youtube_link" placeholder="https://www.youtube.com/watch?v=..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" value="<?php echo e(old('youtube_link', $youtubeVideo->url_ou_path ?? '')); ?>">
                                <?php $__errorArgs = ['youtube_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                 
                            </div>
                        </div>

                        
                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="<?php echo e(route('admin.solucoes.index')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancelar
                            </a>
                             <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Atualizar Solução
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $attributes = $__attributesOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__attributesOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $component = $__componentOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?> <?php /**PATH C:\painelimp\resources\views/admin/solucoes/edit.blade.php ENDPATH**/ ?>