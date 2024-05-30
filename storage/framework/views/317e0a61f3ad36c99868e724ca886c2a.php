<?php $__env->startSection('content'); ?>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var errorPopup = document.getElementById('error-popup');
            if (errorPopup) {
                errorPopup.style.display = 'block';

                setTimeout(function() {
                    errorPopup.style.display = 'none';
                }, 10000);
            }
        });
    </script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("cesta_pagina"); ?>



<div class="bg-gray-100 bg-opacity-75 h-screen py-8 w-[80%] ">
    <div class="container mx-auto px-4 ">
        <h1 class="text-2xl font-semibold mb-4">Cesta</h1>
        <div class="flex flex-col md:flex-row gap-4">
            <div class="md:w-3/4">
                <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                    <table class="w-full">
                        <thead class="m-6">
                        <tr class="m-6 p-10">
                            <th class="text-left font-semibold">Producto</th>
                            <th class="text-left font-semibold">Precio</th>
                            <th class="text-left font-semibold">Cantidad</th>
                            <th class="text-left font-semibold">Total</th>
                        </tr>
                        </thead>
                        <tbody class="m-6">
                        <?php if(Session::has('error')): ?>
                            <div class="popup">
                                <?php echo e(Session::get('error')); ?>

                            </div>
                        <?php endif; ?>
                        <?php $__currentLoopData = $productosConCantidad; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="m-6 p-10">
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <img class="h-16 w-16 mr-4" src="storage/<?php echo e($producto['producto']->ruta); ?>" alt="Product image">
                                        <span class="font-semibold"><?php echo e($producto['producto']->nombre); ?></span>
                                    </div>
                                </td>
                                <td class="py-4"><?php echo e($producto['producto']->precio); ?></td>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <form action="<?php echo e(route('cesta.restar', $producto['producto']->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="border rounded-md py-2 px-4 mr-2">-</button>
                                        </form>
                                        <span class="text-center w-8"><?php echo e($producto['cantidad']); ?></span>
                                        <form action="<?php echo e(route('cesta.sumar', $producto['producto']->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="border rounded-md py-2 px-4 ml-2">+</button>
                                        </form>
                                    </div>
                                </td>
                                <td class="py-4"><?php echo e($producto['subtotal']); ?>€ </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $cursosConCantidad; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="m-6 p-10">
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <img class="h-16 w-16 mr-4" src="storage/<?php echo e($curso['curso']->ruta); ?>" alt="Curso image">
                                        <span class="font-semibold"><?php echo e($curso['curso']->nombre); ?></span>
                                    </div>
                                </td>
                                <td class="py-4"><?php echo e($curso['curso']->precio); ?></td>
                                <td class="py-4">
                                    <div class="flex items-center">
                                       
                                        <span class="text-center w-8"><?php echo e($curso['cantidad']); ?></span>

                                    </div>
                                </td>
                                <td class="py-4"><?php echo e($curso['subtotal']); ?>€ </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <!-- More product rows -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="md:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold mb-4">Recibo</h2>



                    <hr class="my-2">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Total</span>
                        <span class="font-semibold"><?php echo e($total); ?>€</span>
                    </div>
                    <form  action="<?php echo e(route('paypal.process')); ?>" >
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full">Comprar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("inicio.inicio", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DAW\proyecto 2daw\Infcomp\resources\views\cesta\cesta.blade.php ENDPATH**/ ?>