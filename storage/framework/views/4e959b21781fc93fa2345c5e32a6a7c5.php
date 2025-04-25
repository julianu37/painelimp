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
            <?php echo e(__('Resultados da Busca por:')); ?> "<?php echo e(request('q')); ?>"
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            
            <?php if($referenciasPdf->isNotEmpty()): ?>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-medium mb-4">Códigos Encontrados em Manuais (<?php echo e($referenciasPdf->count()); ?>)</h3>
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            <?php $__currentLoopData = $referenciasPdf; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ref): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($ref->manual): ?> 
                                    <li class="py-3">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <span class="font-semibold text-indigo-600 dark:text-indigo-400"><?php echo e($ref->codigo_encontrado); ?></span>
                                                encontrado em
                                                <a href="<?php echo e(route('manuais.view', ['manual' => $ref->manual->slug, 'page' => $ref->numero_pagina])); ?>" 
                                                   target="_blank" 
                                                   class="font-semibold underline hover:text-indigo-500">
                                                    <?php echo e($ref->manual->nome); ?>

                                                </a>
                                                (página <?php echo e($ref->numero_pagina); ?>)
                                            </div>
                                            <a href="<?php echo e(route('manuais.view', ['manual' => $ref->manual->slug, 'page' => $ref->numero_pagina])); ?>" 
                                                target="_blank"
                                                class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                Abrir PDF &rarr;
                                            </a>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?> 

            
            <div class="mb-8 p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Modelos Encontrados (<?php echo e($modelos->count()); ?>)</h2>
                <?php if($modelos->isNotEmpty()): ?>
                    <ul class="list-disc list-inside space-y-2 text-gray-700 dark:text-gray-300">
                        <?php $__currentLoopData = $modelos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modelo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e(route('modelos.show', $modelo)); ?>" class="text-indigo-600 hover:underline dark:text-indigo-400">
                                    <?php echo e($modelo->nome); ?> (<?php echo e($modelo->marca->nome ?? 'Marca desconhecida'); ?>)
                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php else: ?>
                    <p class="text-gray-500 dark:text-gray-400">Nenhum modelo encontrado.</p>
                <?php endif; ?>
            </div>

            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Manuais Encontrados (<?php echo e($manuais->count()); ?>)</h3>
                    <?php if($manuais->isNotEmpty()): ?>
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            <?php $__currentLoopData = $manuais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="py-3 flex flex-col sm:flex-row justify-between sm:items-center">
                                    <div>
                                        <span class="text-base font-medium text-gray-900 dark:text-gray-100"><?php echo e($manual->nome); ?></span>
                                        <p class="text-xs text-gray-500 dark:text-gray-400" title="<?php echo e($manual->arquivo_nome_original); ?>">(<?php echo e(Str::limit($manual->arquivo_nome_original, 40)); ?>)</p>
                                         
                                         <?php if($manual->modelos->isNotEmpty()): ?>
                                            <?php $primeiroModeloManual = $manual->modelos->first(); ?>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                <?php if($manual->modelos->count() > 1): ?>
                                                    Modelos:
                                                <?php else: ?>
                                                    Modelo:
                                                <?php endif; ?>
                                                <a href="<?php echo e(route('modelos.show', $primeiroModeloManual)); ?>" class="hover:underline"><?php echo e($primeiroModeloManual->nome); ?></a>
                                                <?php if($primeiroModeloManual->marca): ?>
                                                (<a href="<?php echo e(route('marcas.show', $primeiroModeloManual->marca)); ?>" class="hover:underline"><?php echo e($primeiroModeloManual->marca->nome); ?></a>)
                                                <?php endif; ?>
                                                <?php if($manual->modelos->count() > 1): ?>
                                                    <span class="text-xs text-gray-400 italic"> (e outros)</span>
                                                <?php endif; ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mt-2 sm:mt-0 sm:ml-4 flex-shrink-0 flex space-x-2">
                                        
                                        <a href="<?php echo e(route('manuais.view', $manual)); ?>" target="_blank" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-800">
                                            Visualizar
                                        </a>
                                         <?php if(auth()->guard()->check()): ?>
                                             
                                             <a href="<?php echo e(route('manuais.download', $manual)); ?>" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
                                                Download
                                            </a>
                                         <?php else: ?>
                                             
                                             <span class="inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-600 text-xs font-medium rounded-md text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-700 cursor-not-allowed" title="Faça login para baixar">
                                                Download
                                            </span>
                                         <?php endif; ?>
                                     </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum manual encontrado.</p>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="mt-6">
                 <a href="<?php echo e(url()->previous()); ?>" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    &laquo; Voltar
                </a>
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
<?php endif; ?>
<?php /**PATH C:\painelimp\resources\views/public/busca/index.blade.php ENDPATH**/ ?>