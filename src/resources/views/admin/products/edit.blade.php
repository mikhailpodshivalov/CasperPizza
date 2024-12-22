<!-- resources/views/admin/products/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Uređivanje proizvoda</h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Naziv</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Opis</label>
                <textarea id="description" name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Slika</label>
                <input type="file" id="image" name="image" class="form-control">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-thumbnail mt-2" width="100">
                @endif
            </div>

            <h3>Dimenzije</h3>
            @foreach($product->sizes as $size)
                <div class="form-group">
                    <label for="size_{{ $size->id }}">{{ $size->size }} Cena</label>
                    <input type="number" id="size_{{ $size->id }}" name="sizes[{{ $size->id }}][price]" class="form-control" value="{{ old('sizes.' . $size->id . '.price', $size->price) }}" required>
                    <input type="hidden" name="sizes[{{ $size->id }}][size]" value="{{ $size->size }}">
                </div>
            @endforeach

            <button type="submit" class="btn btn-success">Ažuriranje proizvoda</button>
        </form>
    </div>
@endsection
