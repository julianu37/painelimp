<?php if(session('success')): ?>
    <div class="mb-4 px-4 py-3 leading-normal text-green-700 bg-green-100 rounded-lg" role="alert">
        <p><?php echo e(session('success')); ?></p>
    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="mb-4 px-4 py-3 leading-normal text-red-700 bg-red-100 rounded-lg" role="alert">
        <p><?php echo e(session('error')); ?></p>
    </div>
<?php endif; ?>


<?php if($errors->any() && !$errors->hasAny(array_keys(request()->input()))): ?> 
    <div class="mb-4 px-4 py-3 leading-normal text-red-700 bg-red-100 rounded-lg" role="alert">
        <p>Ocorreram erros de validação:</p>
        <ul class="mt-2 list-disc list-inside">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?> <?php /**PATH C:\painelimp\resources\views/components/alert-messages.blade.php ENDPATH**/ ?>