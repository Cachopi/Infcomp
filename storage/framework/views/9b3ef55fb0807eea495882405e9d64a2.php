<?php $__env->startSection('usuarios'); ?>

    <div class="container mx-auto px-4">
        <div class="card">
            <div class="card-header">
                Lista de Usuarios
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="<?php echo e(route('Usuarios.create')); ?>" class="btn btn-success">Crear Usuario</a>
                </div>
                <div class="overflow-x-auto"> <!-- Permitir desplazamiento horizontal en pantallas pequeñas -->
                    <table class="table glass">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="w-16 md:w-24 text-center"> <img class="rounded-full w-10 h-10 md:w-12 md:h-12 mx-auto" src="<?php echo e(asset('storage/'.$user->foto_perfil)); ?>"></td> <!-- Centrar la imagen -->
                                <td><?php echo e($user->name); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td>
                                    <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($role->name); ?> <br> <!-- Mostrar el nombre de cada rol del usuario en una nueva línea -->
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td>
                                    <!-- Enlaces para editar y eliminar usuarios -->
                                    <a href="<?php echo e(route('Usuarios.show', $user->id)); ?>" class="btn btn-primary hover:bg-blue-500">Editar</a>
                                    <form action="<?php echo e(route('Usuarios.destroy', $user->id)); ?>" method="POST" style="display: inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-primary bg-red-700 border-danger-700 hover:bg-red-500">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("inicio.inicio", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DAW\Proyecto 2ºDAW\Infcomp\resources\views/usuarios/usuarios.blade.php ENDPATH**/ ?>