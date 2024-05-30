<?php $__env->startSection("cesta"); ?>
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-semibold mb-5">Tu Cesta</h1>

        <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex items-center py-5 px-8 border-b border-gray-200">
                <img class="w-16 h-16 object-cover rounded" src="<?php echo e(asset($producto->ruta)); ?>" alt="Product Image">
                <div class="ml-3">
                    <h3 class="text-gray-900 font-semibold"><?php echo e($producto->nombre); ?></h3>
                    <p class="text-gray-700 mt-1"><?php echo e($producto->precio); ?></p>
                </div>
                <form action="<?php echo e(route('cesta.eliminar', $producto->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="ml-auto py-2 px-4 bg-red-700 hover:bg-red-500 text-white rounded-lg">
                        X
                    </button>
                </form>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="mt-5">
            <a href="<?php echo e(route('cesta.vaciar')); ?>" class="text-red-500 hover:text-red-700">Vaciar Cesta</a>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("components.header", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DAW\proyecto 2daw\Infcomp\resources\views\components\cesta.blade.php ENDPATH**/ ?>