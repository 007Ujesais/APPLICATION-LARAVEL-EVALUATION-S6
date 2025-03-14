<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $userLikes = Like::where('user_id', auth()->id())->pluck('product_id');

        return Inertia::render('Home', [
            'products' => $products,
            'userLikes' => $userLikes
        ]);
    }

    // public function index() {
    //     $produits = Produit::all();
    //     return view('produits.index', compact('produits'));
    // }
}
