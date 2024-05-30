<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/logo.png')); ?>">
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>
    <title>Infcomp</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        main {
            flex: 1;
        }
    </style>
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

<?php if(Session::has('error')): ?>
    <div id="error-popup" class="popup hidden fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-500 text-white p-4 rounded-lg shadow-lg z-50">
        <?php echo e(Session::get('error')); ?>

    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div id="error-popup" class="popup fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-500 text-white p-4 rounded-lg shadow-lg z-50">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($error); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>

<?php if(Session::has('success')): ?>
    <div id="success-popup" class="success-popup fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white p-4 rounded-lg shadow-lg z-50">
        <?php echo e(Session::get('success')); ?>

    </div>
<?php endif; ?>

<script>
    setTimeout(function() {
        document.querySelectorAll('.popup').forEach(function(element) {
            element.classList.add('hidden');
        });
    }, 3000);

    setTimeout(function() {
        document.querySelectorAll('.success-popup').forEach(function(element) {
            element.classList.add('hidden');
        });
    }, 3000);
</script>

<main class="flex flex-col justify-center items-center flex-1 m-4 md:m-10">
    <div class="container mx-auto p-4">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <?php echo $__env->yieldContent('login'); ?>
    <?php echo $__env->yieldContent('registro'); ?>
    <?php echo $__env->yieldContent("formulario"); ?>
    <?php echo $__env->yieldContent("formularioCursos"); ?>
    <?php echo $__env->yieldContent("update"); ?>
    <?php echo $__env->yieldContent("updateCursos"); ?>
    <?php echo $__env->yieldContent("cesta_pagina"); ?>
    <?php echo $__env->yieldContent("perfil"); ?>
    <?php echo $__env->yieldContent("usuarios"); ?>
    <?php echo $__env->yieldContent("crear_usuario"); ?>
    <?php echo $__env->yieldContent('actualizar_usuario'); ?>
    <?php echo $__env->yieldContent('mostrar_facturas'); ?>
    <?php echo $__env->yieldContent('show_factura'); ?>
    <?php echo $__env->yieldContent('facturas_perfil'); ?>
    <?php echo $__env->yieldContent('paypal'); ?>
    <?php echo $__env->yieldContent('usuario_cursos'); ?>
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
<?php /**PATH D:\DAW\proyecto 2daw\Infcomp\resources\views/inicio/inicio.blade.php ENDPATH**/ ?>