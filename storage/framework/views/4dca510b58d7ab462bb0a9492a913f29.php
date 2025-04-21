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
            <?php echo e(__('Códigos de Erro para:')); ?> <?php echo e($modelo->nome); ?> (<?php if($modelo->marca): ?><a href="<?php echo e(route('marcas.show', $modelo->marca)); ?>" class="text-cyan-600 hover:underline"><?php echo e($modelo->marca->nome); ?></a><?php endif; ?>)
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-4">
                 <a href="<?php echo e(route('modelos.show', $modelo)); ?>" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    &larr; Voltar para <?php echo e($modelo->nome); ?>

                </a>
            </div>

            
            <div class="mb-4">
                <form action="<?php echo e(route('modelos.show.codigos', $modelo)); ?>" method="GET" class="flex items-center space-x-2">
                    <input type="text"
                           name="busca_codigo"
                           value="<?php echo e($buscaCodigo ?? ''); ?>"
                           placeholder="Buscar por código ou descrição..."
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500 sm:text-sm">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-cyan-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-700 focus:bg-cyan-700 active:bg-cyan-800 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Buscar
                    </button>
                    
                    <?php if(request()->has('busca_codigo') && request('busca_codigo') != ''): ?>
                        <a href="<?php echo e(route('modelos.show.codigos', $modelo)); ?>"
                           class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                           Limpar
                        </a>
                    <?php endif; ?>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <?php if($codigosErro->isNotEmpty()): ?>
                        <ul class="divide-y divide-gray-200">
                            <?php $__currentLoopData = $codigosErro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $codigo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="py-4">
                                    <a href="<?php echo e(route('modelos.codigos.show', [$modelo, $codigo])); ?>" class="block hover:bg-gray-50 p-3 rounded-md transition">
                                        <h3 class="text-lg font-semibold text-cyan-600"><?php echo e($codigo->codigo); ?></h3>
                                        <p class="mt-1 text-sm text-gray-600"><?php echo e(Str::limit($codigo->descricao, 150)); ?></p>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

                        <div class="mt-6">
                            <?php echo e($codigosErro->links('pagination::tailwind')); ?> 
                        </div>
                    <?php else: ?>
                        <p class="text-center text-gray-500">Nenhum código de erro público encontrado para este modelo.</p>
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
<?php endif; ?> <?php /**PATH C:\painelimp\resources\views/public/modelos/show_codigos.blade.php ENDPATH**/ ?>