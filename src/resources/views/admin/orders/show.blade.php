@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalji porudžbine #{{ $order->id }}</h1>
        <p><strong>Email:</strong> {{ $order->email }}</p>
        <p><strong>Telefon:</strong> {{ $order->phone }}</p>
        <p><strong>Adresa:</strong> {{ $order->address }}</p>
        <p><strong>Ukupni troškovi:</strong> {{ $order->total_price }} RSD</p>
        <h3>Proizvodi</h3>
        <table class="table mt-3">
            <thead>
            <tr>
                <th>#</th>
                <th>Naziv</th>
                <th>Veličina</th>
                <th>Broj</th>
                <th>Cena</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->pivot->size }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ $product->pivot->price }} RSD</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

