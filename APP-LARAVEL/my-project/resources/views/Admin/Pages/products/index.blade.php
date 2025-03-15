@extends('admin.Layouts.AuthenticatedLayout')

@section('title', 'Product list')

@section('content')
<div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-800">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-2xl font-semibold">Products</h1>
            <p>A list of all products with their details.</p>
        </div>
        <a href="{{ route('products.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">Add Product</a>
    </div>
    
    <div class="overflow-x-auto rounded-lg">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-300 dark:border-gray-600  bg-gray-50 dark:bg-gray-900">
                    <th class="py-3 text-gray-600 dark:text-gray-100">Name</th>
                    <th class="py-3 text-gray-600 dark:text-gray-100">Price</th>
                    <th class="py-3 text-gray-600 dark:text-gray-100">Model</th>
                    <th class="py-3 text-gray-600 dark:text-gray-100 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300 dark:divide-gray-700 divide-opacity-100">
                @foreach ($products as $product)
                <tr>
                    <td class="py-3 font-medium text-gray-900 dark:text-gray-50">{{ $product->name }}</td>
                    <td class="py-3 text-gray-500 dark:text-gray-600">{{ $product->price }}€</td>
                    <td class="py-3 text-gray-500 dark:text-gray-600">{{ $product->model }}</td>
                    <td class="p-2 text-center flex gap-2 justify-center">
                        <div class="inline-block text-left">
                            <!-- Bouton pour afficher le dropdown -->
                            <a href="{{ route('products.edit', $product) }}" class="group flex items-center gap-3 rounded-lg px-3 py-2 text-theme-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                                <i class="pi pi-pen-to-square" aria-hidden="true"></i> Edit
                            </a>
                        </div>    
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection