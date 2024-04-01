<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Productos</title>
</head>
<body>
<x-header></x-header>
<main>


    <section>


        <div class="card w-96 glass">
            <figure><img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="car!"/></figure>
            <div class="card-body">
                <h2 class="card-title">Life hack</h2>
                <p>How to park your car at your garage?</p>
                <div class="card-actions justify-end">
                    <button class="btn btn-primary">Comprar</button>
                </div>
            </div>
        </div>
    </section>
</main>
<x-footer></x-footer>

</body>
</html>
