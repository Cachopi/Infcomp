<?php $__env->startSection('actualizar_usuario'); ?>
    <div class="container flex justify-center flex-col items-center ">

          <h1>Editar Usuario</h1>



                <form action="<?php echo e(route('Usuarios.update', $user->id)); ?>" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-md">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                        <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo e($user->name); ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                        <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo e($user->email); ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="role_id" class="block text-gray-700 text-sm font-bold mb-2">Rol:</label>
                        <select name="role_id" id="role_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($role->id); ?>" <?php echo e($user->roles->contains('id', $role->id) ? 'selected' : ''); ?>>
                                    <?php echo e($role->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar Cambios</button>
                    </div>
                </form>


        </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('inicio.inicio', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DAW\Proyecto 2ºDAW\Infcomp\resources\views/usuarios/update.blade.php ENDPATH**/ ?>