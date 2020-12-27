<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alqa</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ mix('css/tw.css') }}" rel="stylesheet" type="text/css">
</head>
<body class="overflow-hidden">
    <div class="flex flex-wrap p-4 border-b-2 border-black">
        <div class="flex-none text-xl">
          <a href="/cart">
            Lista de Deseos ({{ optional(session('cart.items'))->count() }})
          </a>
        </div>
        <div class="flex-grow text-center rouded-2">ALQA</div>
        <div class="flex-none ">
            <button
                @click="toggleMenu"
                class="w-10 h-10 uppercase rounded-full bg-alqa-charcoal"
                disabled>
            </button>
        </div>
    </div>
    <div id="app">
   </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
