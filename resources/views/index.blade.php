<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">



    @vite('resources/css/app.css')
    <title>Infcomp</title>

    <style>
        .background-radial-gradient {
            background-color: hsl(218, 41%, 15%);
            background-image: radial-gradient(650px circle at 0% 0%,
            hsl(218, 41%, 35%) 15%,
            hsl(218, 41%, 30%) 35%,
            hsl(218, 41%, 20%) 75%,
            hsl(218, 41%, 19%) 80%,
            transparent 100%),
            radial-gradient(1250px circle at 100% 100%,
                hsl(218, 41%, 45%) 15%,
                hsl(218, 41%, 30%) 35%,
                hsl(218, 41%, 20%) 75%,
                hsl(218, 41%, 19%) 80%,
                transparent 100%);
        }
    </style>

</head>
<body>
<x-header></x-header>



<main class=".babackground-radial-gradient flex justify-center items-center flex-col m-6 md:m-10 lg:m-16 xl:m-20">
    <!-- Section: Design Block -->
    <section class="background-radial-gradient mb-10 md:mb-16 w-full md:w-[80%]">
        <div class="px-4 sm:px-6 py-8 md:py-12 text-center md:text-left md:px-12 lg:px-16">
            <div class="w-full mx-auto sm:max-w-md md:max-w-3xl lg:max-w-5xl xl:max-w-7xl">
                <div class="grid items-center gap-8 md:gap-12 lg:grid-cols-2">
                    <div class="mt-6 lg:mt-0">
                        <h1 class="mt-0 mb-8 md:mb-10 lg:mb-12 text-3xl md:text-4xl xl:text-5xl font-bold tracking-tight md:tracking-normal xl:tracking-tight text-[hsl(218,81%,95%)]">
                            Los mejores componentes <br /><span class="text-[hsl(218,81%,75%)]">al mejor precio</span>
                        </h1>
                        <a class="inline-block rounded bg-neutral-50 px-6 md:px-8 py-3 text-sm md:text-base font-medium uppercase leading-normal text-neutral-800 shadow-md transition duration-150 ease-in-out hover:bg-neutral-100 hover:shadow-lg focus:bg-neutral-100 focus:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-300 active:bg-neutral-200 active:shadow-lg dark:shadow-[0_4px_9px_-4px_rgba(251,251,251,0.3)] dark:hover:shadow-lg dark:focus:shadow-lg dark:active:shadow-lg"
                           data-te-ripple-init data-te-ripple-color="light" href="{{route('Productos.index')}}" role="button">Componentes</a>
                    </div>
                    <div class="mb-6 lg:mb-0">
                        <img src="{{asset('images/pc.png')}}" class="w-full rounded-lg shadow-lg" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<x-footer></x-footer>
</body>
</html>
