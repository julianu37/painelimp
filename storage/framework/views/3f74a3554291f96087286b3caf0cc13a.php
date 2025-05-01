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
            
            <?php echo $__env->make('layouts.admin-navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Page Heading -->
            <?php if(isset($header)): ?>
                 
                <header class="bg-cyan-50 shadow border-b border-gray-200">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        
                        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
                             <?php echo e($header); ?>

                        </h2>
                    </div>
                </header>
            <?php endif; ?>

            <!-- Page Content -->
            
            <main class="flex-grow">
                 
                 <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
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
                 </div>
                

                <?php echo e($slot); ?>

            </main>

             
            <footer class="bg-gray-800 text-white text-center p-4">
                <div class="max-w-7xl mx-auto">
                    Feito com ❤️ por JM
                </div>
            </footer>
        </div>
    </body>
</html> <?php /**PATH C:\painelimp\resources\views/components/admin-layout.blade.php ENDPATH**/ ?>