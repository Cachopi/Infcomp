<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <title>Productos</title>
</head>
<body>
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
<main class="p-5">
    <div class="flex justify-center mb-4">
        <input type="text" id="searchInput" placeholder="Buscar productos..." class="input input-bordered w-full max-w-xs">
    </div>
    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Admin')): ?>
    <div class="mt-4 flex flex-row-reverse">
        <a href="<?php echo e(route('Productos.create')); ?>" class="btn btn-success">Agregar Producto</a>
    </div>
    <?php endif; ?>
    <section class="flex flex-row p-2 flex-wrap">
        <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card w-96 glass m-3 producto" data-nombre="<?php echo e($producto->nombre); ?>">
                <figure><img src="<?php echo e(asset('storage/'.$producto->ruta)); ?>" alt="<?php echo e($producto->nombre); ?>"/></figure>
                <div class="card-body">
                    <h2 class="card-title"><?php echo e($producto->nombre); ?></h2>
                    <p><?php echo e($producto->descripcion); ?></p>
                    <h3 class="flex flex-row-reverse mb-2 text-red-700 font-bold"><?php echo e($producto->precio); ?> €</h3>
                    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Admin')): ?>
                    <h3 class="flex flex-row-reverse mb-2 text-red-700 font-bold">Stock: <?php echo e($producto->stock); ?> UD</h3>
                    <?php endif; ?>
                    <div class="card-actions justify-end">
                        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Usuario')): ?>
                        <form action="<?php echo e(route('cesta.anadir', [$producto->id,'tipo'=>'producto'])); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-primary hover:bg-blue-500" type="submit">Añadir</button>
                        </form>
                        <?php endif; ?>
                        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Admin')): ?>
                        <form action="<?php echo e(route('Productos.destroy',($producto->id))); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-primary bg-red-700 border-danger-700 hover:bg-red-500">
                                Eliminar
                            </button>
                        </form>
                        <a href="<?php echo e(route('Productos.edit', $producto->id)); ?>" class="btn btn-primary hover:bg-blue-500">Editar</a>
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
    document.getElementById('searchInput').addEventListener('input', function() {
        var filter = this.value.toLowerCase();
        var productos = document.querySelectorAll('.producto');

        productos.forEach(function(producto) {
            var nombre = producto.getAttribute('data-nombre').toLowerCase();
            if (nombre.includes(filter)) {
                producto.style.display = '';
            } else {
                producto.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>
<?php /**PATH D:\DAW\Proyecto 2ºDAW\Infcomp\resources\views/productos/productos.blade.php ENDPATH**/ ?>