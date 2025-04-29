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
    
    

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 text-center">
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-8 md:p-12 text-gray-900 dark:text-gray-100">
                    <h1 class="text-3xl md:text-4xl font-bold mb-3 text-indigo-600 dark:text-indigo-400">
                        Bem-vindo à Base de Conhecimento
                    </h1>
                    <p class="mb-6 text-lg text-gray-600 dark:text-gray-300">
                        Encontre códigos de erro, manuais, soluções e mais.
                    </p>

                    
                    <form action="<?php echo e(route('busca.index')); ?>" method="GET" class="max-w-xl mx-auto">
                        <label for="search-home" class="sr-only">Buscar</label>
                        <div class="relative">
                            <input type="search" name="q" id="search-home"
                                   class="block w-full px-4 py-3 text-base border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm pr-12"
                                   placeholder="Digite código, modelo ou termo..." required>
                            <button type="submit" aria-label="Buscar"
                                    class="absolute inset-y-0 right-0 flex items-center justify-center px-4 text-gray-500 hover:text-indigo-600 dark:hover:text-indigo-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 rounded-r-md">
                                
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            
            <h2 class="text-2xl font-semibold mb-6 text-gray-700 dark:text-gray-300">Ou explore por categoria:</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                
                
                
                <a href="<?php echo e(route('manuais.index')); ?>" class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1">
                     <div class="flex items-center mb-3">
                        
                        <svg class="w-8 h-8 text-blue-500 dark:text-blue-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Manuais</h3>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Faça o download de manuais de serviço e de usuário.</p>
                </a>
                 
                 <a href="<?php echo e(route('marcas.index')); ?>" class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1">
                     <div class="flex items-center mb-3">
                        
                        <svg class="w-8 h-8 text-green-500 dark:text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-5 5a2 2 0 01-2.828 0l-7-7A2 2 0 013 8V5c0-1.1.9-2 2-2h2z"></path></svg>
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Marcas & Modelos</h3>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Navegue pelos equipamentos por marca e modelo.</p>
                </a>
                
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
<?php /**PATH C:\painelimp\resources\views\welcome.blade.php ENDPATH**/ ?>