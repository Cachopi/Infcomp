<?php $__env->startSection("update"); ?>
    <form  action="<?php echo e(route('Productos.update', $producto->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo e($producto->nombre); ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control"><?php echo e($producto->descripcion); ?></textarea>
        </div>

        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" value="<?php echo e($producto->precio); ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <img src="<?php echo e(asset('storage/' . $producto->ruta)); ?>" alt="car"/>
            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("inicio.inicio", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DAW\Proyecto 2ºDAW\Infcomp\resources\views/productos/update.blade.php ENDPATH**/ ?>