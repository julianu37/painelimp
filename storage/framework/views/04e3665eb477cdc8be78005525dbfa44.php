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
            <?php echo e(__('Painel do Técnico')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-2">Bem-vindo(a), <?php echo e(Auth::user()->name); ?>!</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Utilize a busca abaixo ou navegue pelas seções recentes.</p>
                    
                    <form action="<?php echo e(route('busca.index')); ?>" method="GET" class="flex">
                        <input type="text" name="q" placeholder="Buscar por código, manual, marca ou modelo..." class="flex-grow rounded-l-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:focus:border-indigo-600 dark:focus:ring-indigo-500/50" required>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-r-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                            Buscar
                        </button>
                    </form>
                </div>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border dark:border-gray-700">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 px-4 py-3 border-b dark:border-gray-700">Últimos Códigos</h3>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700 max-h-80 overflow-y-auto">
                        <?php $__empty_1 = true; $__currentLoopData = $ultimosCodigos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $codigo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <a href="<?php echo e(route('codigos.show', $codigo)); ?>" class="block text-sm text-indigo-600 dark:text-indigo-400 hover:underline truncate" title="<?php echo e($codigo->descricao); ?>">
                                    <span class="font-medium"><?php echo e($codigo->codigo); ?></span> - <?php echo e(Str::limit($codigo->descricao, 40)); ?>

                                </a>
                                <span class="text-xs text-gray-400 dark:text-gray-500 block"><?php echo e($codigo->created_at->diffForHumans(null, true)); ?></span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">Nenhum código encontrado.</li>
                        <?php endif; ?>
                    </ul>
                </div>

                 
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border dark:border-gray-700">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 px-4 py-3 border-b dark:border-gray-700">Últimos Manuais</h3>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700 max-h-80 overflow-y-auto">
                        <?php $__empty_1 = true; $__currentLoopData = $ultimosManuais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <a href="<?php echo e(route('manuais.view', $manual)); ?>" target="_blank" class="block text-sm text-indigo-600 dark:text-indigo-400 hover:underline truncate" title="<?php echo e($manual->arquivo_nome_original); ?>">
                                   <?php echo e($manual->nome); ?>

                                </a>
                                <?php if($manual->modelo): ?>
                                <span class="text-xs text-gray-400 dark:text-gray-500 block truncate"><?php echo e($manual->modelo->nome); ?> <?php if($manual->modelo->marca): ?> (<?php echo e($manual->modelo->marca->nome); ?>) <?php endif; ?></span>
                                <?php endif; ?>
                                <span class="text-xs text-gray-400 dark:text-gray-500 block"><?php echo e($manual->created_at->diffForHumans(null, true)); ?></span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                             <li class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">Nenhum manual encontrado.</li>
                        <?php endif; ?>
                    </ul>
                </div>

                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border dark:border-gray-700">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 px-4 py-3 border-b dark:border-gray-700">Últimos Comentários</h3>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700 max-h-80 overflow-y-auto">
                        <?php $__empty_1 = true; $__currentLoopData = $ultimosComentarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comentario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <p class="text-sm text-gray-700 dark:text-gray-300 mb-0.5 truncate"><?php echo e(Str::limit($comentario->conteudo, 60)); ?></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Por: <span class="font-medium"><?php echo e($comentario->user->name ?? 'N/A'); ?></span>
                                    <?php if($comentario->comentavel && $comentario->comentavel instanceof \App\Models\CodigoErro): ?> 
                                        em <a href="<?php echo e(route('codigos.show', $comentario->comentavel)); ?>" class="text-indigo-500 hover:underline"><?php echo e($comentario->comentavel->codigo ?? 'Item removido'); ?></a>
                                    <?php elseif($comentario->comentavel): ?>
                                         em <?php echo e(class_basename($comentario->comentavel)); ?> 
                                    <?php endif; ?>
                                </p>
                                <span class="text-xs text-gray-400 dark:text-gray-500 block"><?php echo e($comentario->created_at->diffForHumans(null, true)); ?></span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                             <li class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">Nenhum comentário recente.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Acesso Rápido</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                         <a href="<?php echo e(route('codigos.index')); ?>" class="block p-4 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-150">
                            <svg class="w-8 h-8 mx-auto mb-2 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.008v.008H12v-.008Z" /></svg>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Ver Códigos</span>
                        </a>
                         <a href="<?php echo e(route('manuais.index')); ?>" class="block p-4 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-150">
                             <svg class="w-8 h-8 mx-auto mb-2 text-cyan-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18c-2.305 0-4.408.867-6 2.292m0-14.25v14.25" /></svg>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Ver Manuais</span>
                        </a>
                        <a href="<?php echo e(route('marcas.index')); ?>" class="block p-4 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-150">
                             <svg class="w-8 h-8 mx-auto mb-2 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h6.75M9 11.25h6.75M9 15.75h6.75M9 20.25h6.75" /></svg>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Ver Marcas</span>
                        </a>
                        <a href="<?php echo e(route('modelos.index')); ?>" class="block p-4 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-150">
                             <svg class="w-8 h-8 mx-auto mb-2 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75V18.75M15.75 18.75h3.75M15 12.75H9M15 16.75H9M18.75 18a2.25 2.25 0 0 1-2.25 2.25H7.5a2.25 2.25 0 0 1-2.25-2.25V6.108c0-1.135.845-2.098 1.976-2.192a48.424 48.424 0 0 1 1.123-.08M18.75 18.75V18.75M6.25 18.75h3.75M3 12.75h.008v.008H3v-.008Zm0 4h.008v.008H3v-.008Z" /></svg>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Ver Modelos</span>
                        </a>
                    </div>
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
<?php /**PATH C:\painelimp\resources\views/dashboard.blade.php ENDPATH**/ ?>