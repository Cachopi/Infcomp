
<header class="sticky top-0 z-10">
    <?php $productos  = \Illuminate\Support\Facades\Session::get('productoSesion',[]);
 $cantidad=0;
    foreach ($productos as $producto) {
        $cantidad+=$producto['cantidad'];
    }
    $cursos = \Illuminate\Support\Facades\Session::get('cursoSesion',[]);

    foreach ($cursos as $curso) {
        $cantidad+=$curso['cantidad'];
    }

    ?>

    <div class="navbar bg-base-100">
        <div class="flex-1">

            <a class="btn btn-ghost text-xl" href="<?php echo e(route('inicio')); ?>">Infcomp</a>


                <a class="btn btn-ghost text-xl" href="<?php echo e(route('Productos.index')); ?>">Productos</a>

                <a class="btn btn-ghost text-xl" href="<?php echo e(route('Cursos.index')); ?>">Cursos</a>
<?php if (\Illuminate\Support\Facades\Blade::check('role', 'Admin')): ?>
                <a class="btn btn-ghost text-xl" href="<?php echo e(route('Usuarios.index')); ?>">Usuarios</a>
            <a class="btn btn-ghost text-xl" href="<?php echo e(route('Facturas.index')); ?>">Facturas</a>
<?php endif; ?>

        </div>

        <div class="flex-none">
            <?php if(auth()->guard()->check()): ?>
                <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Usuario')): ?>
                <div class="dropdown dropdown-end">

                    <div tabindex="0" role="button" class="btn btn-ghost btn-circle" >

                        <div class="indicator">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span class="badge badge-sm indicator-item"><?php echo e($cantidad); ?></span>
                        </div>
                    </div>



                    <div class="max-w-96 mx-auto mt-16 bg-white rounded-lg overflow-hidden md:max-w-lg border border-gray-400 mt-3 z-[1] card card-compact dropdown-content w-80 bg-base-100 shadow">
                        <div class="px-4 py-2 border-b border-gray-200">
                            <h1 class="text-2xl font-semibold mb-5">Tu Cesta</h1>


                            <div class="container mx-auto mt-10 w-auto overflow-y-scroll h-[600px] ">




                                <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex items-center py-5 px-8 border-b border-gray-200">
                                        <img class="w-16 h-16 object-cover rounded" src="<?php echo e(asset('storage/'.$producto['ruta'])); ?>" alt="Product Image">
                                        <div class="ml-3">
                                            <h3 class="text-gray-900 font-semibold"><?php echo e($producto['nombre']); ?></h3>
                                            <p class="text-gray-700 mt-1"><?php echo e($producto['precio']); ?>€</p>
                                            <p class="text-gray-700 mt-1">cantidad <?php echo e($producto['cantidad']); ?></p>

                                        </div>
                                        <form action="<?php echo e(route('cesta.eliminar', $producto['id'])); ?>" method="POST">
                                            <?php echo method_field('DELETE'); ?>
                                            <?php echo csrf_field(); ?>

                                            <button type="submit" class="ml-auto py-2 px-4 bg-red-700 hover:bg-red-500 text-white rounded-lg">
                                                X
                                            </button>
                                        </form>
                                    </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex items-center py-5 px-8 border-b border-gray-200">
                                        <img class="w-16 h-16 object-cover rounded" src="<?php echo e(asset('storage/'.$curso['ruta'])); ?>" alt="Product Image">
                                        <div class="ml-3">
                                            <h3 class="text-gray-900 font-semibold"><?php echo e($curso['nombre']); ?></h3>
                                            <p class="text-gray-700 mt-1"><?php echo e($curso['precio']); ?>€</p>
                                            <p class="text-gray-700 mt-1">cantidad <?php echo e($curso['cantidad']); ?></p>

                                        </div>

                                        <form action="<?php echo e(route('cesta.eliminarCurso', $curso['id'])); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="ml-auto py-2 px-4 bg-red-700 hover:bg-red-500 text-white rounded-lg">
                                                X
                                            </button>
                                        </form>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                            </div>

                            <div class="mt-5">
                                <a href="<?php echo e(route('cesta.vaciar')); ?>" class="text-red-500 hover:text-red-700">Vaciar Cesta</a>
                            </div>


                        </div>
                        <div class="flex flex-col divide-y divide-gray-200">


                            



                        </div>
                        <div class="flex items-center justify-between px-6 py-3 bg-gray-100">
                            <h3 class="text-gray-900 font-semibold">Total: <?php echo e(Session::get('total', 0)); ?>€</h3>
                            <a class="py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white rounded-lg"  href="<?php echo e(route('cesta.mostrar')); ?>" >
                                Comprar
                            </a>
                        </div>
                    </div>
                    
                </div>
                <?php endif; ?>


        </div>
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img src="<?php echo e(auth()->user()-> getFoto()); ?>" alt="Foto de Perfil" />
                </div>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li>
                    <a class="justify-between"   href=" <?php echo e(route('profile.edit')); ?>">
                     Perfil
                    </a>
                </li>
<?php if (\Illuminate\Support\Facades\Blade::check('role', 'Usuario')): ?>
                <li>
                    <a class="justify-between" href="<?php echo e(route('facturas.mostrar')); ?>"   >
                       Facturas
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

</header>
<?php /**PATH D:\DAW\Proyecto 2ºDAW\Infcomp\resources\views/components/header.blade.php ENDPATH**/ ?>