<?php $__env->startSection("formularioCursos"); ?>
    <div class="container">



        <form action="<?php echo e(route('Cursos.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" name="precio" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="horas">Horas:</label>
                <input type="number" name="horas" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen" class="form-control-file" required>
            </div>

            <button type="submit" class="btn btn-primary">Crear Curso</button>
        </form>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("inicio.inicio", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DAW\Proyecto 2ºDAW\Infcomp\resources\views/cursos/create.blade.php ENDPATH**/ ?>