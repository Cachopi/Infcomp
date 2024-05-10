<?php $__env->startSection('show_factura'); ?>

    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Detalles de la factura <?php echo e($factura->id); ?></h1>


        <div class="overflow-x-auto">
            <table class="w-full whitespace-no-wrap bg-white border-gray-200 shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-100 border-b-2 border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Nombre</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Precio</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Cantidad</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Subtotal</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                <?php $__currentLoopData = $factura->productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($producto->nombre); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($producto->precio); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($producto->pivot->cantidad); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($producto->precio * $producto->pivot->cantidad); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $factura->cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($curso->nombre); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($curso->precio); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($curso->pivot->cantidad); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($curso->precio * $curso->pivot->cantidad); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr class="font-bold">
                    <td colspan="3" class="px-6 py-4 text-right">Total:</td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo e($factura->total); ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('inicio.inicio', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DAW\Proyecto 2ºDAW\Infcomp\resources\views/facturas/show.blade.php ENDPATH**/ ?>