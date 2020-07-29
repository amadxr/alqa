<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alqa Checkout</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
    <script src="https://checkout.culqi.com/js/v3"></script>
</head>

<body style="overflow: hidden">
    <div id="app">
        <div class="container">
            Thanks for your purchase!!!
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>


</html>
