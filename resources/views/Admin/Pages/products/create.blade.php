@extends('admin.Layouts.AuthenticatedLayout')

@section('title', 'Create product')

@section('content')
    <h1>{{ isset($product) ? 'Modifier' : 'Ajouter' }} un produit</h1>
    <form action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" method="POST">
        @csrf
        @if(isset($product)) @method('PUT') @endif

        <label>Nom :</label>
        <input type="text" name="name" value="{{ $product->name ?? old('name') }}" required>

        <label>Prix :</label>
        <input type="number" name="price" value="{{ $product->price ?? old('price') }}" required>

        <label>Modèle :</label>
        <input type="text" name="model" value="{{ $product->model ?? old('model') }}" required>

        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
@endsection
