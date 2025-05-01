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
            <ol role="list" class="flex items-center space-x-4 text-sm list-none">
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            
            <?php
                // Carrega a relação manuais APENAS se a contagem for 1, para eficiência
                if ($modelo->manuais_count === 1) {
                    $modelo->load('manuais'); // Carrega a coleção de manuais
                }
                $manualUnico = ($modelo->manuais_count === 1) ? $modelo->manuais->first() : null;
                $mostrarViewSimplificada = ($manualUnico && $manualUnico->tipo === 'html');
            ?>

            <?php if($mostrarViewSimplificada): ?>
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-medium mb-2">Manual Interativo</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Este modelo possui um manual HTML completo.
                        </p>
                        <a href="<?php echo e(route('manuais.html.view', $manualUnico)); ?>" target="_blank"
                           class="inline-flex items-center px-4 py-2 bg-cyan-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-700 hover:text-white focus:bg-cyan-700 active:bg-cyan-800 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Acessar Manual HTML &rarr;
                        </a>
                    </div>
                </div>

            <?php else: ?>
                

                
                <div class="mb-8 pb-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Buscar em Manuais de <?php echo e($modelo->nome); ?></h3>
                    
                    <form action="<?php echo e(route('modelos.show', $modelo)); ?>" method="GET" class="flex items-center space-x-3 mb-6 max-w-xl">
                        
                         <input type="search" name="q_modelo" placeholder="Digite código ou termo para buscar nos manuais..." value="<?php echo e($queryBuscaManual ?? ''); ?>" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:focus:border-indigo-600 dark:focus:ring-indigo-500/50">
                         <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Buscar</button>
                         <?php if($queryBuscaManual): ?>
                            <a href="<?php echo e(route('modelos.show', $modelo)); ?>" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 whitespace-nowrap">Limpar</a>
                         <?php endif; ?>
                    </form>

                    
                    <?php if(isset($queryBuscaManual) && !empty($queryBuscaManual)): ?>
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg max-w-xl">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                
                                 <h4 class="text-lg font-medium mb-4">Resultados da busca por "<?php echo e($queryBuscaManual); ?>" (<?php echo e($resultadosBuscaManualModelo->count()); ?>)</h4>
                                 <?php if($resultadosBuscaManualModelo->isNotEmpty()): ?>
                                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                        <?php $__currentLoopData = $resultadosBuscaManualModelo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ref): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($ref->manual): ?> 
                                                <li class="py-3">
                                                    <div class="flex justify-between items-center">
                                                        
                                                         <div>
                                                            <span class="font-semibold text-indigo-600 dark:text-indigo-400"><?php echo e($ref->codigo_encontrado); ?></span>
                                                            encontrado em
                                                            
                                                            <?php if($ref->manual->tipo === 'html'): ?>
                                                                <a href="<?php echo e(route('manuais.html.view', $ref->manual)); ?>" target="_blank" class="font-semibold underline hover:text-indigo-500"><?php echo e($ref->manual->nome); ?> (HTML)</a>
                                                            <?php else: ?> 
                                                                <a href="<?php echo e(route('manuais.view', ['manual' => $ref->manual->slug, 'page' => $ref->numero_pagina])); ?>" target="_blank" class="font-semibold underline hover:text-indigo-500"><?php echo e($ref->manual->nome); ?></a> (página <?php echo e($ref->numero_pagina); ?>)
                                                            <?php endif; ?>
                                                        </div>
                                                        
                                                        <?php if($ref->manual->tipo === 'html'): ?>
                                                            <a href="<?php echo e(route('manuais.html.view', $ref->manual)); ?>" target="_blank" class="text-sm text-purple-600 hover:text-purple-800 dark:text-purple-400 dark:hover:text-purple-300">Abrir HTML &rarr;</a>
                                                        <?php else: ?> 
                                                            <a href="<?php echo e(route('manuais.view', ['manual' => $ref->manual->slug, 'page' => $ref->numero_pagina])); ?>" target="_blank" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Abrir PDF &rarr;</a>
                                                        <?php endif; ?>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php else: ?>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 italic">Nenhuma ocorrência encontrada nos PDFs indexados para este modelo.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                    
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            
                             <h3 class="text-lg font-medium mb-2">Manuais</h3>
                            <?php if($modelo->manuais_count > 0): ?>
                                <p class="text-sm text-gray-600 mb-4"><?php echo e($modelo->manuais_count); ?> <?php echo e(Str::plural('manual', $modelo->manuais_count)); ?> disponível<?php echo e(Str::plural('s', $modelo->manuais_count)); ?> para este modelo.</p>
                                <a href="<?php echo e(route('modelos.show.manuais', $modelo)); ?>" class="inline-flex items-center px-4 py-2 bg-cyan-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-700 hover:text-white focus:bg-cyan-700 active:bg-cyan-800 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition ease-in-out duration-150">Ver Manuais &rarr;</a>
                            <?php else: ?>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum manual encontrado para este modelo.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div></div>
                </div> 

            <?php endif; ?> 

            
            <div class="mt-8">
                <a href="<?php echo e(route('marcas.show', $modelo->marca)); ?>" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    &larr; Voltar para <?php echo e($modelo->marca->nome); ?>

                </a>
                <span class="mx-2 text-gray-400">|</span>
                <a href="<?php echo e(route('modelos.index')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
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