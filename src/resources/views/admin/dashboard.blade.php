@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Kontrolna tabla</h1>
        <ul class="list-unstyled mt-4">
            <li><a href="{{ route('products.index') }}" class="btn mb-2 btn-primary">Upravljanje proizvodima</a></li>
            <li><a href="{{ route('orders.index') }}" class="btn btn-primary">Upravljanje porudžbinama</a></li>
        </ul>
    </div>
@endsection

