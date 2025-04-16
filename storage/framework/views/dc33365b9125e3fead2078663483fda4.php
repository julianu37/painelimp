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
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <?php echo e(__('Editar Comentário')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    
                    

                    
                    <form method="POST" action="<?php echo e(route('comentarios.update', $comentario)); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        
                        <div class="mb-6 border-b pb-6 dark:border-gray-700">
                            <label for="conteudo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Conteúdo do Comentário:</label>
                            <textarea id="conteudo" name="conteudo" rows="5" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required><?php echo e(old('conteudo', $comentario->conteudo)); ?></textarea>
                            <?php $__errorArgs = ['conteudo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-6 border-b pb-6 dark:border-gray-700">
                            <h3 class="text-md font-medium mb-4 text-gray-800 dark:text-gray-200">Gerenciar Anexos Atuais</h3>
                            <?php if($comentario->midias->isNotEmpty()): ?>
                                <div class="space-y-4">
                                    <?php $__currentLoopData = $comentario->midias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $midia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex items-center justify-between border dark:border-gray-700 p-2 rounded-md bg-gray-50 dark:bg-gray-900/50">
                                            <div class="flex-1 min-w-0 mr-4">
                                                
                                                <?php if($midia->is_imagem): ?>
                                                    <img src="<?php echo e($midia->url); ?>" alt="Preview" class="h-10 w-10 object-cover rounded inline-block mr-2 border dark:border-gray-600">
                                                <?php elseif($midia->is_pdf): ?>
                                                    <svg class="w-6 h-6 inline-block mr-2 fill-current text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 0a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6.5A1.5 1.5 0 0 0 16.5 5h-5A1.5 1.5 0 0 1 10 .5V0H4zm8 6v4h4V6h-4zm-2 8H6v-2h4v2zm4 0h-2v-2h2v2zm0-3H6V9h8v2z"/></svg>
                                                <?php elseif($midia->is_video_mp4): ?>
                                                     <svg class="w-6 h-6 inline-block mr-2 fill-current text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zm14 1.574l-4 2v-4l4 2zM4 8v4h8V8H4z"/></svg>
                                                <?php elseif($midia->is_video_youtube): ?>
                                                    <svg class="w-6 h-6 inline-block mr-2 fill-current text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-4-4a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-2.293 2.293a1 1 0 101.414 1.414l4-4a1 1 0 000-1.414z" clip-rule="evenodd" /></svg>
                                                <?php endif; ?>
                                                
                                                <span class="text-sm text-gray-700 dark:text-gray-300 truncate"><?php echo e($midia->nome_original ?? 'Link YouTube'); ?></span>
                                                <?php if($midia->is_video_youtube): ?>
                                                    <a href="https://www.youtube.com/watch?v=<?php echo e($midia->caminho); ?>" target="_blank" class="text-xs text-blue-500 hover:underline">(Ver)</a>
                                                <?php elseif(!$midia->is_imagem): ?> 
                                                     <a href="<?php echo e($midia->url); ?>" target="_blank" class="text-xs text-blue-500 hover:underline">(Ver)</a>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <label for="remover_midia_<?php echo e($midia->id); ?>" class="flex items-center text-xs text-red-600 dark:text-red-400 hover:text-red-800 cursor-pointer whitespace-nowrap">
                                                <input type="checkbox" name="remover_midias[]" id="remover_midia_<?php echo e($midia->id); ?>" value="<?php echo e($midia->id); ?>" class="mr-1 h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                                Remover
                                            </label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <?php $__errorArgs = ['remover_midias.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-sm text-red-600 mt-2"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <?php else: ?>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum anexo encontrado.</p>
                            <?php endif; ?>
                        </div>

                        
                        <div class="mb-6">
                             <h3 class="text-md font-medium mb-4 text-gray-800 dark:text-gray-200">Adicionar Novos Anexos</h3>
                             <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="midias" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Upload de Arquivos <span class="text-xs">(Imagens, PDF, Vídeo Curto)</span></label>
                                    <input type="file" name="midias[]" id="midias" multiple class="block w-full text-sm text-gray-500 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm cursor-pointer focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 dark:file:bg-indigo-900/50 file:text-indigo-700 dark:file:text-indigo-300 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-800/50">
                                    <?php $__errorArgs = ['midias'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <?php $__errorArgs = ['midias.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div>
                                    <label for="youtube_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Link do YouTube (Substitui link existente)</label>
                                    <input id="youtube_link" type="url" name="youtube_link" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="https://www.youtube.com/watch?v=...">
                                    <?php $__errorArgs = ['youtube_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        
                        <div class="flex items-center justify-end mt-6 space-x-3 border-t pt-6 dark:border-gray-700">
                            <a href="<?php echo e(url()->previous()); ?>" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancelar
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?> <?php /**PATH C:\painelimp\resources\views/comentarios/edit.blade.php ENDPATH**/ ?>