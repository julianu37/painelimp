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
           <a href="<?php echo e(route('marcas.show', $modelo->marca)); ?>" class="text-blue-600 dark:text-blue-400 hover:underline"><?php echo e($modelo->marca->nome); ?></a> / <?php echo e($modelo->nome); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol role="list" class="flex items-center space-x-4 text-sm">
                <li>
                    <div>
                        <a href="<?php echo e(route('home')); ?>" class="text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-300">
                            <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Home</span>
                        </a>
                    </div>
                </li>
                 <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-300 dark:text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                        </svg>
                        <a href="<?php echo e(route('marcas.index')); ?>" class="ml-4 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">Marcas</a>
                    </div>
                </li>
                 <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-300 dark:text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                        </svg>
                        <a href="<?php echo e(route('marcas.show', $modelo->marca)); ?>" class="ml-4 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200"><?php echo e($modelo->marca->nome); ?></a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-300 dark:text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                        </svg>
                        <span class="ml-4 text-sm font-medium text-gray-700 dark:text-gray-200"><?php echo e($modelo->nome); ?></span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

             
             

            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Códigos de Erro Comuns</h3>
                    <?php if($modelo->codigosErro->isNotEmpty()): ?>
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            <?php $__currentLoopData = $modelo->codigosErro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $codigo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="py-3">
                                    <a href="<?php echo e(route('codigos.show', $codigo)); ?>" class="hover:underline">
                                        <span class="font-semibold"><?php echo e($codigo->codigo); ?></span> - <?php echo e(Str::limit($codigo->descricao, 150)); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum código de erro comum encontrado para este modelo.</p>
                    <?php endif; ?>
                </div>
            </div>

             
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Manuais</h3>
                    <?php if($modelo->manuais->isNotEmpty()): ?>
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            <?php $__currentLoopData = $modelo->manuais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="py-3 flex flex-col sm:flex-row justify-between sm:items-center">
                                    <div>
                                        <span class="text-base font-medium text-gray-900 dark:text-gray-100"><?php echo e($manual->nome); ?></span>
                                        <p class="text-xs text-gray-500 dark:text-gray-400" title="<?php echo e($manual->arquivo_nome_original); ?>">(<?php echo e(Str::limit($manual->arquivo_nome_original, 40)); ?>)</p>
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
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum manual encontrado para este modelo.</p>
                    <?php endif; ?>
                </div>
            </div>

             
            <div class="mt-6">
                 <a href="<?php echo e(route('marcas.show', $modelo->marca)); ?>" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    &laquo; Voltar para <?php echo e($modelo->marca->nome); ?>

                </a>
                 <span class="mx-2 text-gray-400">|</span>
                 <a href="<?php echo e(route('modelos.index')); ?>" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                     Ver Todos Modelos
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
<?php /**PATH C:\painelimp\resources\views/public/modelos/show.blade.php ENDPATH**/ ?>