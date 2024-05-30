<header class="sticky top-0 z-10 bg-base-100 shadow-md">
    <?php
        $usuarioId = auth()->id();
        $productos = Illuminate\Support\Facades\Session::get("productoSesion_{$usuarioId}", []);
        $cursos = Illuminate\Support\Facades\Session::get("cursoSesion_{$usuarioId}", []);
        $total = Illuminate\Support\Facades\Session::get("total_{$usuarioId}", 0);
        $cantidad = Illuminate\Support\Facades\Session::get("cantidad_{$usuarioId}", 0);

        $cantidad = 0;
        foreach ($productos as $producto) {
            $cantidad += $producto['cantidad'];
        }
        foreach ($cursos as $curso) {
            $cantidad += $curso['cantidad'];
        }
    ?>

    <div class="navbar flex-wrap justify-between">
        <div class="flex items-center space-x-4">
            <a class="btn btn-ghost text-xl" href="<?php echo e(route('inicio')); ?>">Infcomp</a>
            <div class="hidden md:flex space-x-4">
                <a class="btn btn-ghost text-xl" href="<?php echo e(route('Productos.index')); ?>">Productos</a>
                <a class="btn btn-ghost text-xl" href="<?php echo e(route('Cursos.index')); ?>">Cursos</a>
                <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Admin')): ?>
                <a class="btn btn-ghost text-xl" href="<?php echo e(route('Usuarios.index')); ?>">Usuarios</a>
                <a class="btn btn-ghost text-xl" href="<?php echo e(route('Facturas.index')); ?>">Facturas</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="flex items-center md:space-x-4">
            <div class="dropdown dropdown-end md:hidden">
                <button tabindex="0" class="btn btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
                <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="<?php echo e(route('Productos.index')); ?>">Productos</a></li>
                    <li><a href="<?php echo e(route('Cursos.index')); ?>">Cursos</a></li>
                    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Admin')): ?>
                    <li><a href="<?php echo e(route('Usuarios.index')); ?>">Usuarios</a></li>
                    <li><a href="<?php echo e(route('Facturas.index')); ?>">Facturas</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="flex-none flex items-center space-x-4">
                <?php if(auth()->guard()->check()): ?>
                    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Usuario')): ?>

                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                            <div class="indicator">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span class="badge badge-sm indicator-item"><?php echo e($cantidad); ?></span>
                            </div>
                        </div>

                            <div class="dropdown-content card card-compact w-80 bg-base-100 shadow mt-3 ml mr-[-90%] z-[1]">
                            <div class="card-body ">
                                <h2 class="card-title">Tu Cesta</h2>
                                <div class="overflow-y-auto max-h-60">
                                    <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex items-center py-2">
                                            <img class="w-12 h-12 object-cover rounded" src="<?php echo e(asset('storage/'.$producto['ruta'])); ?>" alt="Product Image">
                                            <div class="ml-3">
                                                <h3 class="text-gray-900 font-semibold"><?php echo e($producto['nombre']); ?></h3>
                                                <p class="text-gray-700 text-sm"><?php echo e($producto['precio']); ?>€</p>
                                                <p class="text-gray-700 text-sm">Cantidad: <?php echo e($producto['cantidad']); ?></p>
                                            </div>
                                            <form action="<?php echo e(route('cesta.eliminar', $producto['id'])); ?>" method="POST" class="ml-auto">
                                                <?php echo method_field('DELETE'); ?>
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-xs btn-error">X</button>
                                            </form>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex items-center py-2">
                                            <img class="w-12 h-12 object-cover rounded" src="<?php echo e(asset('storage/'.$curso['ruta'])); ?>" alt="Curso Image">
                                            <div class="ml-3">
                                                <h3 class="text-gray-900 font-semibold"><?php echo e($curso['nombre']); ?></h3>
                                                <p class="text-gray-700 text-sm"><?php echo e($curso['precio']); ?>€</p>
                                                <p class="text-gray-700 text-sm">Cantidad: <?php echo e($curso['cantidad']); ?></p>
                                            </div>
                                            <form action="<?php echo e(route('cesta.eliminarCurso', $curso['id'])); ?>" method="POST" class="ml-auto">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-xs btn-error">X</button>
                                            </form>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="card-actions justify-between mt-2">
                                    <a href="<?php echo e(route('cesta.vaciar')); ?>" class="btn btn-xs btn-warning">Vaciar Cesta</a>
                                    <h3 class="text-gray-900 font-semibold">Total: <?php echo e(is_numeric($total) ? $total : "0"); ?>€</h3>
                                    <a href="<?php echo e(route('cesta.mostrar')); ?>" class="btn btn-primary btn-xs">Comprar</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php endif; ?>

                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                <img src="<?php echo e(auth()->user()->getFoto()); ?>" alt="Foto de Perfil" />
                            </div>
                        </div>
                        <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                            <li>
                                <a class="justify-between" href="<?php echo e(route('profile.edit')); ?>">
                                    Perfil
                                </a>
                            </li>
                            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Usuario')): ?>
                            <li>
                                <a class="justify-between" href="<?php echo e(route('facturas.mostrar')); ?>">
                                    Facturas
                                </a>
                            </li>
                            <li>
                                <a class="justify-between" href="<?php echo e(route('mis-cursos')); ?>">
                                    Mis Cursos
                                </a>
                            </li>
                            <?php endif; ?>
                            <li>
                                <form action="<?php echo e(route("logout")); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit">Salir</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <div>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-primary">Entrar</a>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-primary">Registrarse</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
<?php /**PATH D:\DAW\Proyecto 2ºDAW\Infcomp\resources\views/components/header.blade.php ENDPATH**/ ?>