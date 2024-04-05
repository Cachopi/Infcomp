<?php $__env->startSection("updateCursos"); ?>
    <form  action="<?php echo e(route('Cursos.update', $curso->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo e($curso->nombre); ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control"><?php echo e($curso->descripcion); ?></textarea>
        </div>

        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" value="<?php echo e($curso->precio); ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="horas">Horas</label>
            <input type="number" name="horas" id="horas" value="<?php echo e($curso->horas); ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <img src="<?php echo e(asset('storage/' . $curso->ruta)); ?>" alt="car"/>
            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control-file">
        </div>


        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("inicio.inicio", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DAW\Proyecto 2ºDAW\Infcomp\resources\views/Cursos/update.blade.php ENDPATH**/ ?>