<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?> - Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body class="font-sans antialiased">
        
        <div class="min-h-screen bg-gray-100 flex flex-col">

            
            
            <div class="flex flex-grow">
                
                <aside class="w-64 bg-gray-800 shadow h-screen sticky top-0 overflow-y-auto">
                    <div class="p-4">
                        <!-- Logo - Cor ajustada -->
                        <div class="shrink-0 flex items-center">
                            <a href="<?php echo e(route('admin.dashboard')); ?>">
                                <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => ['class' => 'block h-12 w-auto fill-current text-gray-200']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'block h-12 w-auto fill-current text-gray-200']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $attributes = $__attributesOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $component = $__componentOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__componentOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
                            </a>
                        </div>
                    </div>
                    <nav class="mt-5">
                        <ul>
                            
                            <li class="px-4 py-2 hover:bg-gray-700 <?php if(request()->routeIs('admin.dashboard')): ?> bg-gray-700 border-l-4 border-cyan-400 <?php endif; ?>">
                                <a href="<?php echo e(route('admin.dashboard')); ?>" class="block text-gray-300 hover:text-white">Dashboard</a>
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-700 <?php if(request()->routeIs('admin.tecnicos.*')): ?> bg-gray-700 border-l-4 border-cyan-400 <?php endif; ?>">
                                <a href="<?php echo e(route('admin.tecnicos.index')); ?>" class="block text-gray-300 hover:text-white">Técnicos</a>
                            </li>
                             <li class="px-4 py-2 hover:bg-gray-700 <?php if(request()->routeIs('admin.marcas.*')): ?> bg-gray-700 border-l-4 border-cyan-400 <?php endif; ?>">
                                <a href="<?php echo e(route('admin.marcas.index')); ?>" class="block text-gray-300 hover:text-white">Marcas</a>
                            </li>
                             <li class="px-4 py-2 hover:bg-gray-700 <?php if(request()->routeIs('admin.modelos.*')): ?> bg-gray-700 border-l-4 border-cyan-400 <?php endif; ?>">
                                <a href="<?php echo e(route('admin.modelos.index')); ?>" class="block text-gray-300 hover:text-white">Modelos</a>
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-700 <?php if(request()->routeIs('admin.codigos.*')): ?> bg-gray-700 border-l-4 border-cyan-400 <?php endif; ?>">
                                <a href="<?php echo e(route('admin.codigos.index')); ?>" class="block text-gray-300 hover:text-white">Códigos de Erro</a>
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-700 <?php if(request()->routeIs('admin.solucoes.*')): ?> bg-gray-700 border-l-4 border-cyan-400 <?php endif; ?>">
                                <a href="<?php echo e(route('admin.solucoes.index')); ?>" class="block text-gray-300 hover:text-white">Soluções</a>
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-700 <?php if(request()->routeIs('admin.manuais.*')): ?> bg-gray-700 border-l-4 border-cyan-400 <?php endif; ?>">
                                <a href="<?php echo e(route('admin.manuais.index')); ?>" class="block text-gray-300 hover:text-white">Manuais</a>
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-700 <?php if(request()->routeIs('admin.imagens.*')): ?> bg-gray-700 border-l-4 border-cyan-400 <?php endif; ?>">
                                <a href="<?php echo e(route('admin.imagens.index')); ?>" class="block text-gray-300 hover:text-white">Imagens</a>
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-700 <?php if(request()->routeIs('admin.videos.*')): ?> bg-gray-700 border-l-4 border-cyan-400 <?php endif; ?>">
                                <a href="<?php echo e(route('admin.videos.index')); ?>" class="block text-gray-300 hover:text-white">Vídeos</a>
                            </li>

                            
                            <li class="px-4 py-2 mt-5 border-t border-gray-700 hover:bg-gray-700">
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <a href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault(); this.closest('form').submit();"
                                       class="block text-red-400 hover:text-red-300">
                                        Sair
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </nav>
                </aside>

                
                <main class="flex-1">
                    
                     <header class="bg-cyan-50 shadow sticky top-0 z-10 border-b border-gray-200">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                            <div>
                                <?php if(isset($header)): ?>
                                    <h2 class="font-semibold text-xl text-gray-700 leading-tight">
                                        <?php echo e($header); ?>

                                    </h2>
                                <?php endif; ?>
                            </div>
                            <div class="text-gray-600">
                                <?php echo e(Auth::user()->name); ?> (Admin)
                            </div>
                        </div>
                    </header>

                    
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
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900">
                                    <?php echo e($slot); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

            
            <footer class="bg-gray-800 text-white text-center p-4">
                <div class="max-w-7xl mx-auto">
                    Feito com ❤️ por JM
                </div>
            </footer>

        </div>
    </body>
</html> <?php /**PATH C:\painelimp\resources\views\layouts\admin.blade.php ENDPATH**/ ?>