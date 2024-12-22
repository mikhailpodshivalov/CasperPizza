@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dodajte novi proizvod</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Naziv</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Opis</label>
                <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Slika</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>

            <h3>Размеры</h3>

            <div class="form-group">
                <label for="size_30cm_price">Cena 30 cm</label>
                <input type="number" id="size_30cm_price" name="sizes[0][price]" class="form-control" step="0.01" value="{{ old('sizes.0.price') }}" required>
                <input type="hidden" name="sizes[0][size]" value="30 см">
            </div>

            <div class="form-group">
                <label for="size_50cm_price">Cena 50 cm</label>
                <input type="number" id="size_50cm_price" name="sizes[1][price]" class="form-control" step="0.01" value="{{ old('sizes.1.price') }}" required>
                <input type="hidden" name="sizes[1][size]" value="50 см">
            </div>

            <button type="submit" class="btn btn-success">Dodajte proizvod</button>
        </form>
    </div>
@endsection
