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
            <?php echo e(__('Códigos de Erro Comuns')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                <form action="<?php echo e(route('codigos.index')); ?>" method="GET" class="flex items-center space-x-3">
                    <input type="search"
                           name="busca_codigo"
                           placeholder="Buscar por código ou descrição..."
                           value="<?php echo e(request('busca_codigo')); ?>"
                           class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-cyan-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-700 focus:bg-cyan-700 active:bg-cyan-800 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Buscar
                    </button>
                    
                    <?php if(request('busca_codigo')): ?>
                        <a href="<?php echo e(route('codigos.index')); ?>" class="text-sm text-gray-500 hover:text-gray-700 whitespace-nowrap">Limpar busca</a>
                    <?php endif; ?>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <?php if($codigos->isNotEmpty()): ?>
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            <?php $__currentLoopData = $codigos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $codigo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="py-4">
                                    
                                    <?php if($codigo->modelos->isNotEmpty()): ?>
                                        <?php $primeiroModelo = $codigo->modelos->first(); ?>
                                        <a href="<?php echo e(route('modelos.codigos.show', [$primeiroModelo, $codigo])); ?>" class="block hover:bg-gray-50 dark:hover:bg-gray-700 p-3 rounded-md transition">
                                            <h3 class="text-lg font-semibold text-indigo-600 dark:text-indigo-400"><?php echo e($codigo->codigo); ?></h3>
                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400"><?php echo e(Str::limit($codigo->descricao, 150)); ?></p>
                                            
                                            <span class="text-xs text-gray-400 dark:text-gray-500 mt-1 block">Modelo: <?php echo e($primeiroModelo->nome); ?> <?php if($codigo->modelos->count() > 1): ?>(e outros)<?php endif; ?></span>
                                        </a>
                                    <?php else: ?>
                                        
                                        <div class="p-3">
                                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300"><?php echo e($codigo->codigo); ?></h3>
                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400"><?php echo e(Str::limit($codigo->descricao, 150)); ?></p>
                                            <span class="text-xs text-red-500 dark:text-red-400 mt-1 block">Nenhum modelo associado</span>
                                        </div>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

                        <div class="mt-6">
                            <?php echo e($codigos->links()); ?> 
                        </div>
                    <?php else: ?>
                        <p class="text-center text-gray-500 dark:text-gray-400">Nenhum código de erro público encontrado.</p>
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
<?php endif; ?> <?php /**PATH C:\painelimp\resources\views/public/codigos/index.blade.php ENDPATH**/ ?>