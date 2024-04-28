<?php $__env->startSection("formulario"); ?>
<div class="container">
    <h1>Crear Producto</h1>

    <form action="<?php echo e(route('Productos.store')); ?>" method="POST" enctype="multipart/form-data">
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
            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" class="form-control-file" required>
        </div>

        <button type="submit" class="btn btn-primary">Crear Producto</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("inicio.inicio", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DAW\proyecto 2daw\Infcomp\resources\views/productos/create.blade.php ENDPATH**/ ?>