@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Proizvodi</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Dodajte proizvod</a>
        <table class="table mt-3">
            <thead>
            <tr>
                <th>#</th>
                <th>Naziv</th>
                <th>Veličine i cene</th>
                <th>Opis</th>
                <th>Slika</th>
                <th>Akcije</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                        @foreach($product->sizes as $size)
                            <p>{{ $size->size }}: {{ $size->price }} RSD</p>
                        @endforeach
                    </td>
                    <td>{{ $product->description }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" width="200">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Uredi</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Izbriši</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

