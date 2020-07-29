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
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wishlistItems as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>1</td>
                            <td>$ {{ $item->price }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" class="text-right font-weight-bold">
                            Total:
                        </td>
                        <td>
                            $ {{ $wishlistItems->sum('price') }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center">
                            <button id="button__checkout" class="btn btn-primary"> Process Payment </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <form method="POST" id="checkout__form" action="/checkout">
                {{ csrf_field() }}
                <input type="hidden" name="culqi_token" id="culqi_token" value="">
                <input type="hidden" name="culqi_email" id="culqi_email" value="">
            </form>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

<script>

 Culqi.settings({
    title: 'Alqa',
    currency: 'USD',
    description: 'Alqa Artworks',
    amount: {{ $wishlistItems->sum('price_in_cents') }}
});

const cardButton = document.getElementById('button__checkout');
cardButton.addEventListener('click', function (e) {
    Culqi.open();
});

</script>

</html>
