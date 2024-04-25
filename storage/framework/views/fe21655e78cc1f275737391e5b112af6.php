<!doctype html>
<html lang="en" data-theme="white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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


<main class="p-5 min-h-screen">
    <div class="mt-4 flex flex-row-reverse ">
        <a href="<?php echo e(route('Cursos.create')); ?>" class="btn btn-success">Agregar Curso</a>
    </div>

    <section class=" flex flex-row p-2 flex-wrap ">

        <?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card w-96 glass  m-3">
                <figure class="p-2"><img src="<?php echo e(asset('storage/'.$curso->ruta)); ?>" alt="<?php echo e($curso->nombre); ?>"/></figure>
                <div class="card-body">
                    <h2 class="card-title"><?php echo e($curso->nombre); ?></h2>
                    <p><?php echo e($curso->descripcion); ?></p>
                    <h3 class="flex flex-row-reverse mb-2 text-red-700 font-bold"><?php echo e($curso->precio); ?> €</h3>

                    <div class="card-actions justify-end">

                        <form action="<?php echo e(route('cesta.anadir', [$curso->id, 'tipo' => 'curso'])); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-primary" type="submit">Añadir </button>
                        </form>
                        <form action="<?php echo e(route('Cursos.destroy',($curso->id))); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-primary">Eliminar</button>

                        </form>
                        <a href="<?php echo e(route('Cursos.edit', $curso->id)); ?>" class="btn btn-primary">Editar</a>

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
</body>
</html>
<?php /**PATH D:\DAW\Proyecto 2ºDAW\Infcomp\resources\views/cursos/cursos.blade.php ENDPATH**/ ?>