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
        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
            <?php echo e(__('Importar Códigos de Erro para Modelos')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <p class="mb-4 text-sm text-gray-600">
                        Selecione os modelos aos quais os códigos de erro (código e descrição) da base de dados de origem
                        (conexão '<?php echo e(config('database.connections.mysql_import.database', 'NÃO CONFIGURADA')); ?>')
                         serão associados. Códigos já existentes serão associados se ainda não estiverem; códigos novos serão criados.
                    </p>
                    <p class="mb-4 text-sm text-red-600 font-semibold">
                        Atenção: Certifique-se que a conexão 'mysql_import' esteja corretamente configurada em <code>config/database.php</code> e <code>.env</code>.
                        O nome da tabela de origem configurado é: <code><?php echo e(app(App\Services\CodigoImportService::class)->getNomeTabelaOrigem()); ?></code>.
                    </p>

                    
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

                    <form action="<?php echo e(route('admin.import.codigos.process')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="mb-6">
                            <label class="block font-medium text-sm text-gray-700 mb-2">Selecione os Modelos de Destino:</label>
                            <div class="max-h-96 overflow-y-auto border border-gray-300 rounded-md p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                <?php $__empty_1 = true; $__currentLoopData = $modelos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modelo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="flex items-center">
                                        <input type="checkbox"
                                               name="modelo_ids[]"
                                               id="modelo_<?php echo e($modelo->id); ?>"
                                               value="<?php echo e($modelo->id); ?>"
                                               
                                               <?php if(is_array(old('modelo_ids')) && in_array($modelo->id, old('modelo_ids'))): ?>
                                                checked
                                               <?php endif; ?>
                                               class="rounded border-gray-300 text-cyan-600 shadow-sm focus:ring-cyan-500">
                                        <label for="modelo_<?php echo e($modelo->id); ?>" class="ml-2 text-sm text-gray-800"><?php echo e($modelo->nome); ?> (@ <?php echo e($modelo->marca->nome); ?>)</label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p class="text-gray-500 col-span-full">Nenhum modelo encontrado para seleção.</p>
                                <?php endif; ?>
                            </div>
                             <?php $__errorArgs = ['modelo_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-sm text-red-600 mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <?php $__errorArgs = ['modelo_ids.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-sm text-red-600 mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit']); ?>
                                <?php echo e(__('Importar Códigos e Associar')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
                        </div>
                    </form>

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
<?php endif; ?> <?php /**PATH C:\painelimp\resources\views\admin\import\codigos_form.blade.php ENDPATH**/ ?>