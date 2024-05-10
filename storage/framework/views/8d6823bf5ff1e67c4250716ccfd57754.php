<?php $__env->startSection('facturas_perfil'); ?>
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Facturas de <?php echo e($user->name); ?></h1>
        <table class="min-w-full leading-normal">
            <thead>
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Usuario</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fecha</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"></th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $facturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $factura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><?php echo e($factura->id); ?></td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><?php echo e($factura->total); ?></td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <?php if($factura->usuario): ?>
                            <?php echo e($factura->usuario->name); ?>

                        <?php else: ?>
                            Usuario no definido
                        <?php endif; ?>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><?php echo e($factura->created_at); ?></td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="<?php echo e(route('facturas.show', ['id' => $factura->id])); ?>" class="btn btn-primary hover:bg-blue-500">Ver Detalles</a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('inicio.inicio', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DAW\Proyecto 2ºDAW\Infcomp\resources\views/profile/facturas.blade.php ENDPATH**/ ?>