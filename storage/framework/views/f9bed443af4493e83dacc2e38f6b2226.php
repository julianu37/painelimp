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
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <?php echo e(__('Detalhes do Código de Erro:')); ?> <?php echo e($codigoErro->codigo); ?>

            </h2>
             <a href="<?php echo e(route('admin.codigos.edit', $codigoErro)); ?>" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                Editar Código
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
             
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-2">Informações do Código</h3>
                    <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                        <div class="py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Código</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2"><?php echo e($codigoErro->codigo); ?></dd>
                        </div>
                        <div class="py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Descrição</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2 whitespace-pre-wrap"><?php echo e($codigoErro->descricao); ?></dd>
                        </div>
                        <div class="py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Modelos Afetados</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                <?php $__empty_1 = true; $__currentLoopData = $codigoErro->modelos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modelo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <span class="inline-block bg-gray-200 dark:bg-gray-700 rounded-full px-2 py-0.5 text-xs font-semibold text-gray-700 dark:text-gray-300 mr-1 mb-1">
                                        <?php echo e($modelo->marca->nome ?? ''); ?> <?php echo e($modelo->nome); ?>

                                    </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    Todos / Genérico
                                <?php endif; ?>
                            </dd>
                        </div>
                        <div class="py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Público</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2"><?php echo e($codigoErro->publico ? 'Sim' : 'Não'); ?></dd>
                        </div>
                        <div class="py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Criado em</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2"><?php echo e($codigoErro->created_at->format('d/m/Y H:i')); ?></dd>
                        </div>
                        <div class="py-2 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Atualizado em</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2"><?php echo e($codigoErro->updated_at->format('d/m/Y H:i')); ?></dd>
                        </div>
                    </dl>
                </div>
            </div>

            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Soluções Associadas</h3>
                         <a href="<?php echo e(route('admin.solucoes.create', ['codigo_erro_id' => $codigoErro->id])); ?>" class="text-sm text-blue-600 hover:underline">Adicionar Solução</a>
                    </div>
                    <?php if($codigoErro->solucoes->isNotEmpty()): ?>
                       <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                           <?php $__currentLoopData = $codigoErro->solucoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $solucao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <li class="py-3 flex justify-between items-center">
                                   <a href="<?php echo e(route('admin.solucoes.show', $solucao)); ?>" class="text-sm font-medium text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 truncate" title="<?php echo e($solucao->titulo); ?>">
                                        <?php echo e($solucao->titulo); ?>

                                   </a>
                                   <span class="text-xs text-gray-500 dark:text-gray-400">Criada em <?php echo e($solucao->created_at->format('d/m/y')); ?></span>
                               </li>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </ul>
                    <?php else: ?>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhuma solução associada a este código de erro.</p>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="mt-6">
                 <a href="<?php echo e(route('admin.codigos.index')); ?>" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    &laquo; Voltar para Lista
                </a>
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
<?php endif; ?> <?php /**PATH C:\painelimp\resources\views\admin\codigos\show.blade.php ENDPATH**/ ?>