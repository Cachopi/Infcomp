<?php $__env->startSection("formularioCursos"); ?>
    <div class="container flex justify-center flex-col items-center ">
<h1>Crear Curso</h1>

        <form action="<?php echo e(route('Cursos.store')); ?>" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-lg">
            <?php echo csrf_field(); ?>

            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                <input type="text" name="nombre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700 text-sm font-bold mb-2">Descripción:</label>
                <textarea name="descripcion" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            </div>

            <div class="mb-4">
                <label for="precio" class="block text-gray-700 text-sm font-bold mb-2">Precio:</label>
                <input type="number" name="precio" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="horas" class="block text-gray-700 text-sm font-bold mb-2">Horas:</label>
                <input type="number" name="horas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="imagen" class="block text-gray-700 text-sm font-bold mb-2">Imagen:</label>
                <input type="file" name="imagen" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Crear Curso</button>
            </div>
        </form>


    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("inicio.inicio", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DAW\proyecto 2daw\Infcomp\resources\views\cursos\create.blade.php ENDPATH**/ ?>