<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Details</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #fdf6e4; padding: 20px;">
<h1 style="color: #d97706;">Vaša porudžbina je uspešno kreirana!</h1>
<p>Poštovani, hvala vam na porudžbini. U nastavku se nalazi pregled vaše korpe:</p>

{{--@if($items && count($items))--}}
{{--    <div style="margin: 20px 0;">--}}
{{--        @foreach($items as $item)--}}
{{--            <div style="background-color: #fffaeb; border-radius: 8px; padding: 10px; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">--}}
{{--                <div style="flex: 1;">--}}
{{--                    <h2 style="font-size: 18px; color: #c2410c;">{{ $item['name'] ?? 'N/A' }}</h2>--}}
{{--                    <p style="color: #9a3412;">Veličina: {{ $item['size'] ?? 'N/A' }}</p>--}}
{{--                    <p style="color: #9a3412;">Cena: {{ $item['price'] ?? 'N/A' }} RSD</p>--}}
{{--                </div>--}}
{{--                @if(isset($item['image']))--}}
{{--                    <div>--}}
{{--                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] ?? 'Pizza' }}" style="width: 80px; border-radius: 10px;">--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--@else--}}
{{--    <p style="color: #666;">Vaša korpa je prazna.</p>--}}
{{--@endif--}}

{{--@if($items && count($items))--}}
{{--    <div style="font-size: 20px; font-weight: bold; color: #c2410c; margin-top: 20px;">--}}
{{--        Ukupno: {{ array_sum(array_column($items, 'price')) }} RSD--}}
{{--    </div>--}}
{{--@endif--}}

{{--<hr style="margin: 20px 0;">--}}
{{--<p>Detalji narudžbine:</p>--}}
{{--<ul>--}}
{{--    <li>Email: {{ $order->email }}</li>--}}
{{--    <li>Telefon: {{ $order->phone }}</li>--}}
{{--    <li>Adresa: {{ $order->address }}</li>--}}
{{--    <li>Komentar: {{ $order->comment }}</li>--}}
{{--</ul>--}}
{{--<p style="margin-top: 20px;">Hvala vam! Bićete uskoro kontaktirani.</p>--}}
</body>
</html>

