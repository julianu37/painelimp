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
                <?php echo e(__('Detalhes do Modelo:')); ?> <?php echo e($modelo->marca->nome); ?> <?php echo e($modelo->nome); ?>

            </h2>
             <a href="<?php echo e(route('admin.modelos.edit', $modelo)); ?>" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                Editar Modelo
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
             
             <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-2">Informações</h3>
                    <p>Marca: <?php echo e($modelo->marca->nome); ?></p>
                    <p>Modelo: <?php echo e($modelo->nome); ?></p>
                    <p>Criado em: <?php echo e($modelo->created_at->format('d/m/Y H:i')); ?></p>
                 </div>
             </div>

             
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Manuais Associados</h3>
                         
                         <a href="<?php echo e(route('admin.manuais.create', ['modelo_id' => $modelo->id])); ?>" class="text-sm text-blue-600 hover:underline">Adicionar Manual</a>
                    </div>
                    <?php if($modelo->manuais->isNotEmpty()): ?>
                       <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                           <?php $__currentLoopData = $modelo->manuais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <li class="py-2 flex justify-between items-center">
                                   <a href="<?php echo e(route('admin.manuais.edit', $manual)); ?>" class="text-sm font-medium text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 truncate" title="<?php echo e($manual->nome); ?>">
                                        <?php echo e($manual->nome); ?>

                                   </a>
                               </li>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </ul>
                    <?php else: ?>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum manual associado a este modelo.</p>
                    <?php endif; ?>
                </div>
            </div>

             
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Códigos de Erro Associados</h3>
                         
                    </div>
                    <?php if($modelo->codigosErro->isNotEmpty()): ?>
                       <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                           <?php $__currentLoopData = $modelo->codigosErro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $codigoErro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <li class="py-2 flex justify-between items-center">
                                   <a href="<?php echo e(route('admin.codigos.show', $codigoErro)); ?>" class="text-sm font-medium text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 truncate" title="<?php echo e($codigoErro->descricao); ?>">
                                        <?php echo e($codigoErro->codigo); ?>

                                   </a>
                               </li>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </ul>
                    <?php else: ?>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum código de erro associado a este modelo.</p>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Imagens Associadas</h3>
                        
                         <span class="text-xs text-gray-500">(Funcionalidade Adicionar Pendente)</span>
                    </div>
                    <?php if($modelo->imagens->isNotEmpty()): ?>
                       <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            <?php $__currentLoopData = $modelo->imagens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imagem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="relative group">
                                    <img src="<?php echo e(Storage::url($imagem->path)); ?>" alt="<?php echo e($imagem->titulo); ?>" class="w-full h-32 object-cover rounded-md shadow-md">
                                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity duration-300 rounded-md">
                                        <a href="<?php echo e(route('admin.imagens.edit', $imagem)); ?>" class="text-white text-xs bg-indigo-600 px-2 py-1 rounded mr-1">Editar</a>
                                        <form action="<?php echo e(route('admin.imagens.destroy', $imagem)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Excluir imagem?');">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="text-white text-xs bg-red-600 px-2 py-1 rounded">X</button>
                                        </form>
                                    </div>
                                     <p class="text-xs text-center mt-1 truncate" title="<?php echo e($imagem->titulo); ?>"><?php echo e($imagem->titulo); ?></p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhuma imagem associada a este modelo.</p>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                     <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Vídeos Associados</h3>
                         
                          <span class="text-xs text-gray-500">(Funcionalidade Adicionar Pendente)</span>
                    </div>
                    <?php if($modelo->videos->isNotEmpty()): ?>
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                             <?php $__currentLoopData = $modelo->videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="py-3 flex justify-between items-center">
                                   <span>
                                        <?php echo e($video->titulo ?? ($video->tipo === 'link' ? $video->url_ou_path : 'Arquivo de Vídeo')); ?>

                                        <span class="text-xs text-gray-500">(<?php echo e(Str::ucfirst($video->tipo)); ?>)</span>
                                        <?php if($video->tipo === 'link'): ?>
                                            <a href="<?php echo e($video->url_ou_path); ?>" target="_blank" class="text-blue-500 hover:underline ml-1 text-xs">(abrir)</a>
                                        <?php endif; ?>
                                    </span>
                                    <div>
                                        <a href="<?php echo e(route('admin.videos.edit', $video)); ?>" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Editar</a>
                                         <form action="<?php echo e(route('admin.videos.destroy', $video)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Excluir vídeo?');">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 text-xs">Excluir</button>
                                        </form>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php else: ?>
                         <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum vídeo associado a este modelo.</p>
                    <?php endif; ?>
                </div>
            </div>

             
            <div class="mt-6">
                 <a href="<?php echo e(route('admin.modelos.index', ['marca_id' => $modelo->marca_id])); ?>" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    &laquo; Voltar para Lista de Modelos (<?php echo e($modelo->marca->nome); ?>)
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
<?php endif; ?> <?php /**PATH C:\painelimp\resources\views\admin\modelos\show.blade.php ENDPATH**/ ?>