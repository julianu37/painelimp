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
        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
             <?php echo e(__('Manuais para:')); ?> <?php echo e($modelo->nome); ?> (<?php if($modelo->marca): ?><a href="<?php echo e(route('marcas.show', $modelo->marca)); ?>" class="text-cyan-600 hover:underline"><?php echo e($modelo->marca->nome); ?></a><?php endif; ?>)
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
             <div class="mb-4">
                 <a href="<?php echo e(route('modelos.show', $modelo)); ?>" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    &larr; Voltar para <?php echo e($modelo->nome); ?>

                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <?php if($manuais->isNotEmpty()): ?>
                        <ul class="divide-y divide-gray-200">
                            <?php $__currentLoopData = $manuais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="py-4 flex flex-col sm:flex-row justify-between sm:items-center">
                                    <div>
                                        <span class="text-lg font-medium text-gray-900"><?php echo e($manual->nome); ?></span>
                                        <p class="text-sm text-gray-500" title="<?php echo e($manual->arquivo_nome_original); ?>">
                                            Arquivo: <?php echo e(Str::limit($manual->arquivo_nome_original, 50)); ?>

                                        </p>
                                    </div>
                                    <div class="mt-2 sm:mt-0 sm:ml-4 flex-shrink-0 flex space-x-2">
                                         
                                         <a href="<?php echo e(route('manuais.view', $manual)); ?>" target="_blank" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            Visualizar
                                        </a>
                                         <?php if(auth()->guard()->check()): ?>
                                            
                                            <a href="<?php echo e(route('manuais.download', $manual)); ?>" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Download
                                            </a>
                                         <?php else: ?>
                                             
                                             <span class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-400 bg-gray-100 cursor-not-allowed" title="Faça login para baixar">
                                                Download
                                             </span>
                                         <?php endif; ?>
                                     </div>
                                 </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

                        <div class="mt-6">
                            <?php echo e($manuais->links('pagination::tailwind')); ?> 
                        </div>
                    <?php else: ?>
                        <p class="text-center text-gray-500">Nenhum manual encontrado para este modelo.</p>
                    <?php endif; ?>
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
<?php endif; ?> <?php /**PATH C:\painelimp\resources\views\public\modelos\show_manuais.blade.php ENDPATH**/ ?>