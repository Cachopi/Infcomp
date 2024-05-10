<?php $__env->startSection('mostrar_facturas'); ?>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Facturas</h1>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
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
                                <a href="<?php echo e(route('Facturas.show', ['Factura' => $factura->id])); ?>" class="btn btn-primary hover:bg-blue-500">Ver Detalles</a>


                            <a class="btn btn-primary bg-red-700 border-red-700  hover:bg-red-500" href="<?php echo e(route('Facturas.destroy', ['Factura' => $factura->id])); ?>" onclick="event.preventDefault(); document.getElementById('delete-form-<?php echo e($factura->id); ?>').submit();">
                                Eliminar
                            </a>

                            <form id="delete-form-<?php echo e($factura->id); ?>" action="<?php echo e(route('Facturas.destroy', ['Factura' => $factura->id])); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                            </form>
                            </td>


                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('inicio.inicio', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DAW\Proyecto 2ºDAW\Infcomp\resources\views/facturas/facturas.blade.php ENDPATH**/ ?>