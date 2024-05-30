<?php $__env->startSection('usuario_cursos'); ?>
    <div class="container mx-auto">
        <h1 class="mb-8 text-3xl text-center">Mis Cursos</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
                    <img src="<?php echo e(Storage::url($curso->ruta)); ?>" class="w-full" alt="<?php echo e($curso->nombre); ?>">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2"><?php echo e($curso->nombre); ?></div>
                        <p class="text-gray-700 text-base"><?php echo e($curso->descripcion); ?></p>
                        <p class="text-gray-700 text-base">Progreso: <?php echo e($curso->pivot->progreso); ?>%</p>
                        <div class="w-full bg-gray-300 rounded-full mt-2">
                            <div class="bg-blue-500 text-xs leading-none py-1 text-center text-white rounded-full" style="width: <?php echo e($curso->pivot->progreso); ?>%;"><?php echo e($curso->pivot->progreso); ?>%</div>
                        </div>
                        <form action="<?php echo e(route('eliminar_curso_usuario', $curso->id)); ?>" method="POST" class="mt-4">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Eliminar Curso
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inicio.inicio', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DAW\proyecto 2daw\Infcomp\resources\views\cursos\usuario_curso.blade.php ENDPATH**/ ?>