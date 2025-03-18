<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cart(Request $request)
    {
        $userId = auth()->id();
        $productId = $request->product_id;

        $cart = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($cart) {
            $cart->delete();
        } else {
            Cart::create(['user_id' => $userId, 'product_id' => $productId]);
        }
    }
    public function showMyCart(Request $request)
    {
        $userId = auth()->id();

        $cartProducts = Product::whereHas('carts', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        return Inertia::render('CartPage', [
            'cartProducts' => $cartProducts
        ]);
    }
    public function updateQuantity(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:carts,product_id',
        'quantity' => 'required|integer|min:1',
    ]);

    // Trouver le produit dans le panier
    $cart = Cart::where('product_id', $request->product_id)
                ->where('user_id', auth()->id())
                ->firstOrFail();

    // Mettre à jour la quantité
    $cart->quantity = $request->quantity;
    $cart->save();

    return redirect()->back()->with('success', 'Quantité mise à jour avec succès.');
}
    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Cart  $cart
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Cart $cart)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Cart  $cart
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Cart $cart)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Cart  $cart
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Cart $cart)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Cart  $cart
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Cart $cart)
    // {
    //     //
    // }
}
