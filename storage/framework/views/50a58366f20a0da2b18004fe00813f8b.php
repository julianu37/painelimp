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
            <?php echo e(__('Dashboard Administrativo')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-5 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Técnicos</dt>
                            <dd class="text-3xl font-semibold text-gray-900 dark:text-gray-100"><?php echo e($totalTecnicos); ?></dd>
                        </div>
                    </div>
                     <div class="mt-4 text-sm">
                        <a href="<?php echo e(route('admin.tecnicos.index')); ?>" class="font-medium text-blue-600 dark:text-blue-400 hover:underline">Gerenciar Técnicos &rarr;</a>
                    </div>
                </div>

                 
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-5 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                             <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Marcas</dt>
                            <dd class="text-3xl font-semibold text-gray-900 dark:text-gray-100"><?php echo e($totalMarcas); ?></dd>
                        </div>
                    </div>
                    <div class="mt-4 text-sm">
                        <a href="<?php echo e(route('admin.marcas.index')); ?>" class="font-medium text-green-600 dark:text-green-400 hover:underline">Gerenciar Marcas &rarr;</a>
                    </div>
                </div>

                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-5 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10em-1 .5-2 2.5c.5 1.5 1.5 2.5 3 3l-3.5 3.5a1 1 0 01-1.414 0l-3.5-3.5a1 1 0 010-1.414l3.5-3.5a1 1 0 011.414 0l3.5 3.5c1.5-1 2.5-2 3-3 .5-1 .5-2-1-3.5zM15 5a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Modelos</dt>
                            <dd class="text-3xl font-semibold text-gray-900 dark:text-gray-100"><?php echo e($totalModelos); ?></dd>
                        </div>
                    </div>
                    <div class="mt-4 text-sm">
                        <a href="<?php echo e(route('admin.modelos.index')); ?>" class="font-medium text-yellow-600 dark:text-yellow-400 hover:underline">Gerenciar Modelos &rarr;</a>
                    </div>
                </div>

                 
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-5 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                             <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Códigos de Erro</dt>
                            <dd class="text-3xl font-semibold text-gray-900 dark:text-gray-100"><?php echo e($totalCodigos); ?></dd>
                        </div>
                    </div>
                     <div class="mt-4 text-sm">
                        <a href="<?php echo e(route('admin.codigos.index')); ?>" class="font-medium text-red-600 dark:text-red-400 hover:underline">Gerenciar Códigos &rarr;</a>
                    </div>
                </div>

                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-5 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                             <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.707.707M12 21a5 5 0 110-10 5 5 0 010 10z" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Soluções</dt>
                            <dd class="text-3xl font-semibold text-gray-900 dark:text-gray-100"><?php echo e($totalSolucoes); ?></dd>
                        </div>
                    </div>
                     <div class="mt-4 text-sm">
                        <a href="<?php echo e(route('admin.solucoes.index')); ?>" class="font-medium text-purple-600 dark:text-purple-400 hover:underline">Gerenciar Soluções &rarr;</a>
                    </div>
                </div>

                 
                 <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-5 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-cyan-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Manuais</dt>
                            <dd class="text-3xl font-semibold text-gray-900 dark:text-gray-100"><?php echo e($totalManuais); ?></dd>
                        </div>
                    </div>
                    <div class="mt-4 text-sm">
                        <a href="<?php echo e(route('admin.manuais.index')); ?>" class="font-medium text-cyan-600 dark:text-cyan-400 hover:underline">Gerenciar Manuais &rarr;</a>
                    </div>
                </div>

                
                 <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-5 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-pink-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Comentários</dt>
                            <dd class="text-3xl font-semibold text-gray-900 dark:text-gray-100"><?php echo e($totalComentarios); ?></dd>
                        </div>
                    </div>
                    
                 </div>

                 
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-5 border border-gray-200 dark:border-gray-700 flex flex-col justify-center items-center">
                     <a href="<?php echo e(route('admin.codigos.create')); ?>" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 w-full mb-3 text-center">
                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Novo Código
                    </a>
                     <a href="<?php echo e(route('admin.solucoes.create')); ?>" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 w-full text-center">
                        <svg class="w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L1.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18.75 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L22.5 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z" /></svg>
                        Nova Solução
                    </a>
                </div>
            </div>

            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 px-6 py-4 border-b dark:border-gray-700">Últimos Códigos Adicionados</h3>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        <?php $__empty_1 = true; $__currentLoopData = $ultimosCodigos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $codigo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="px-6 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <div class="flex justify-between items-center">
                                    <a href="<?php echo e(route('admin.codigos.show', $codigo)); ?>" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline truncate pr-4" title="<?php echo e($codigo->descricao); ?>">
                                        <?php echo e($codigo->codigo); ?> - <?php echo e(Str::limit($codigo->descricao, 60)); ?>

                                    </a>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap"><?php echo e($codigo->created_at->diffForHumans(null, true)); ?></span>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">Nenhum código de erro encontrado.</li>
                        <?php endif; ?>
                    </ul>
                     <div class="px-6 py-3 border-t dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50 text-right">
                        <a href="<?php echo e(route('admin.codigos.index')); ?>" class="text-xs font-medium text-indigo-600 dark:text-indigo-400 hover:underline">Ver Todos &rarr;</a>
                    </div>
                </div>

                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 px-6 py-4 border-b dark:border-gray-700">Últimos Comentários</h3>
                     <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        <?php $__empty_1 = true; $__currentLoopData = $ultimosComentarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comentario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                             <li class="px-6 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <div class="flex justify-between items-start">
                                    <div class="text-sm flex-1 pr-4">
                                        <p class="text-gray-700 dark:text-gray-300 mb-1"><?php echo e(Str::limit($comentario->conteudo, 100)); ?></p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            Por: <span class="font-medium"><?php echo e($comentario->user->name ?? 'N/A'); ?></span>
                                            <?php if($comentario->comentavel): ?>
                                                em <a href="<?php echo e(route('admin.codigos.show', $comentario->comentavel)); ?>" class="text-indigo-500 hover:underline"><?php echo e($comentario->comentavel->codigo ?? 'Item removido'); ?></a>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap"><?php echo e($comentario->created_at->diffForHumans(null, true)); ?></span>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                             <li class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">Nenhum comentário recente.</li>
                        <?php endif; ?>
                    </ul>
                    
                    
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
<?php endif; ?><?php /**PATH C:\painelimp\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>