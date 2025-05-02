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
            <?php echo e(__('Marcas de Equipamentos')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                <form action="<?php echo e(route('marcas.index')); ?>" method="GET" class="flex items-center space-x-3">
                    <input type="search"
                           name="busca_marca"
                           placeholder="Buscar por nome da marca..."
                           value="<?php echo e(request('busca_marca')); ?>"
                           class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-cyan-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-700 focus:bg-cyan-700 active:bg-cyan-800 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Buscar
                    </button>
                    <?php if(request('busca_marca')): ?>
                        <a href="<?php echo e(route('marcas.index')); ?>" class="text-sm text-gray-500 hover:text-gray-700 whitespace-nowrap">Limpar busca</a>
                    <?php endif; ?>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <?php if($marcas->isNotEmpty()): ?>
                        
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            <?php $__currentLoopData = $marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('marcas.show', $marca)); ?>"
                                   class="block bg-gray-50 dark:bg-gray-700 rounded-lg shadow p-4 text-center hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out flex flex-col justify-between">
                                    <div> 
                                        <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-2 truncate" title="<?php echo e($marca->nome); ?>">
                                            <?php echo e($marca->nome); ?>

                                        </h3>
                                        
                                        <div class="h-16 flex items-center justify-center mb-2"> 
                                            <?php if($marca->logo_path && Storage::disk('public')->exists($marca->logo_path)): ?>
                                                <img src="<?php echo e(Storage::url($marca->logo_path)); ?>" alt="Logo <?php echo e($marca->nome); ?>"
                                                     class="max-h-full max-w-full object-contain">
                                            <?php else: ?>
                                                <div class="h-full w-full flex items-center justify-center bg-gray-200 dark:bg-gray-600 rounded">
                                                    <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-auto">
                                        <?php echo e($marca->modelos_count); ?> <?php echo e(Str::plural('modelo', $marca->modelos_count)); ?>

                                    </span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        
                        <div class="mt-6">
                            <?php echo e($marcas->links()); ?>

                        </div>
                    <?php else: ?>
                        <p class="text-center text-gray-500 dark:text-gray-400">Nenhuma marca encontrada.</p>
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
<?php endif; ?>
<?php /**PATH C:\painelimp\resources\views/public/marcas/index.blade.php ENDPATH**/ ?>