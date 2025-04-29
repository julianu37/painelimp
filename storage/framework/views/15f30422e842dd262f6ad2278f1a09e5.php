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
            <?php echo e(__('Detalhes do Técnico: ')); ?> <?php echo e($tecnico->name); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">
                    
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Informações</h3>
                        <dl class="mt-2 border-t border-b border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
                            <div class="py-3 flex justify-between text-sm font-medium">
                                <dt class="text-gray-500 dark:text-gray-400">Nome</dt>
                                <dd class="text-gray-900 dark:text-white"><?php echo e($tecnico->name); ?></dd>
                            </div>
                            <div class="py-3 flex justify-between text-sm font-medium">
                                <dt class="text-gray-500 dark:text-gray-400">Email</dt>
                                <dd class="text-gray-900 dark:text-white"><?php echo e($tecnico->email); ?></dd>
                            </div>
                            <div class="py-3 flex justify-between text-sm font-medium">
                                <dt class="text-gray-500 dark:text-gray-400">Membro desde</dt>
                                <dd class="text-gray-900 dark:text-white"><?php echo e($tecnico->created_at->format('d/m/Y H:i')); ?></dd>
                            </div>
                            
                            <?php if($tecnico->avatar): ?>
                            <div class="py-3 flex justify-between text-sm font-medium">
                                <dt class="text-gray-500 dark:text-gray-400">Avatar</dt>
                                <dd>
                                    <img src="<?php echo e(Storage::url($tecnico->avatar)); ?>" alt="Avatar" class="h-16 w-16 rounded-full object-cover">
                                </dd>
                            </div>
                            <?php endif; ?>
                        </dl>
                    </div>

                    
                    <div class="flex items-center justify-end mt-4">
                        <a href="<?php echo e(route('admin.tecnicos.index')); ?>" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
                            Voltar para Lista
                        </a>
                        <a href="<?php echo e(route('admin.tecnicos.edit', $tecnico)); ?>" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                            Editar
                        </a>
                         <form action="<?php echo e(route('admin.tecnicos.destroy', $tecnico)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja excluir este técnico?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Excluir
                            </button>
                        </form>
                    </div>
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
<?php endif; ?> <?php /**PATH C:\painelimp\resources\views\admin\tecnicos\show.blade.php ENDPATH**/ ?>