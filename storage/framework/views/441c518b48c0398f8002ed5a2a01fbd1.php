<!doctype html>
<html lang="en" data-theme="white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/logo.png')); ?>">

    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <title>Cursos</title>
</head>

<body class=" ">
<?php if (isset($component)) { $__componentOriginalfd1f218809a441e923395fcbf03e4272 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfd1f218809a441e923395fcbf03e4272 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $attributes = $__attributesOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__attributesOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $component = $__componentOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__componentOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
<?php if(Session::has('error')): ?>
    <div id="error-popup" class="popup" style="display:none;">
        <?php echo e(Session::get('error')); ?>

    </div>
<?php endif; ?>
<?php if($errors->any()): ?>
    <div id="error-popup" class="popup">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($error); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>

<?php if(Session::has('success')): ?>
    <div id="success-popup" class="success-popup">
        <?php echo e(Session::get('success')); ?>

    </div>
<?php endif; ?>
<script>

    setTimeout(function() {
        document.querySelectorAll('.popup').forEach(function(element) {
            element.style.display = 'none';
        });
    }, 3000);

    setTimeout(function() {
        document.querySelectorAll('.success-popup').forEach(function(element) {
            element.style.display = 'none';
        });
    }, 3000);
</script>

<main class="p-5 min-h-screen">

    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Admin')): ?>
    <div class="mt-4 flex flex-row-reverse ">
        <a href="<?php echo e(route('Cursos.create')); ?>" class="btn btn-success">Agregar Curso</a>
    </div>
    <?php endif; ?>

    
    <div class="flex justify-center mt-4 mb-4">
        <input type="text" id="searchInput" placeholder="Buscar cursos..." class="p-2 border border-gray-300 rounded-md">
    </div>

    <section class="flex flex-row p-2 flex-wrap">
        <?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card w-96 glass m-3 curso" data-nombre="<?php echo e($curso->nombre); ?>" data-descripcion="<?php echo e($curso->descripcion); ?>" data-precio="<?php echo e($curso->precio); ?>" data-ruta="<?php echo e(asset('storage/'.$curso->ruta)); ?>" onclick="openModal(this)">
                <figure class="p-2"><img src="<?php echo e(asset('storage/'.$curso->ruta)); ?>" alt="<?php echo e($curso->nombre); ?>"/></figure>
                <div class="card-body">
                    <h2 class="card-title"><?php echo e($curso->nombre); ?></h2>
                    <p><?php echo e($curso->descripcion); ?></p>
                    <h3 class="flex flex-row-reverse mb-2 text-red-700 font-bold"><?php echo e($curso->precio); ?> €</h3>

                    <div class="card-actions justify-end">
                        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Usuario')): ?>
                        <form action="<?php echo e(route('cesta.anadir', [$curso->id, 'tipo' => 'curso'])); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-primary hover:bg-blue-500" type="submit">Añadir </button>
                        </form>
                        <?php endif; ?>
                        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Admin')): ?>
                        <form action="<?php echo e(route('Cursos.destroy',($curso->id))); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-primary bg-red-700 border-red-700  hover:bg-red-500">Eliminar</button>

                        </form>
                        <a href="<?php echo e(route('Cursos.edit', $curso->id)); ?>" class="btn btn-primary hover:bg-blue-500">Editar</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </section>
</main>

<?php if (isset($component)) { $__componentOriginal8a8716efb3c62a45938aca52e78e0322 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a8716efb3c62a45938aca52e78e0322 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $attributes = $__attributesOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $component = $__componentOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__componentOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>

<script>
    // Función para filtrar cursos según el texto ingresado en el buscador
    document.getElementById('searchInput').addEventListener('input', function() {
        var filter = this.value.toLowerCase();
        var cursos = document.querySelectorAll('.curso');

        cursos.forEach(function(curso) {
            var nombre = curso.getAttribute('data-nombre').toLowerCase();
            if (nombre.includes(filter)) {
                curso.style.display = '';
            } else {
                curso.style.display = 'none';
            }
        });
    });
</script>

</body>
</html>
<?php /**PATH D:\DAW\proyecto 2daw\Infcomp\resources\views/cursos/cursos.blade.php ENDPATH**/ ?>