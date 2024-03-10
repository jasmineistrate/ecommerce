<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jackiedo\Cart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Cart::name('shopping')->getDetails();
        //dd($cartItems);
        return view('cart.index', compact('cartItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $shoppingCart   = Cart::name('shopping');
        $productItem  = $shoppingCart->addItem([
            'id'       => $request->product_id,
            'title'    => $request->product_title,
            'quantity' => 1,
            'price'    => $request->product_price,
            'options' => [
                'image' => $request->product_image,
                'size' => [
                    'label' => 'XL',
                    'value' => 'XL'
                ],
                'color' => [
                    'label' => $request->product_color,
                    'value' => $request->product_color,
                ]
            ],
            'extra_info' => [
                'date_time' => [
                    'added_at' => time(),
                ]
            ]
        ]);
        return redirect()->back()->with('success', 'The item ' . $request->product_title . ' has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateQuantity(Request $request, string $id)
    {
        $updatedItem = Cart::name('shopping')->updateItem($id, [
            'quantity' => intval($request->quantity)
        ]);
    }

    public function cartTotal()
    {
        $total = Cart::name('shopping')->getDetails()->total;
        return response()->json($total);
    }

    public function applyDiscount()
    {
        Cart::name('shopping')->applyAction([
            'group'      => 'Discount',
            'id'         => 1,
            'title'      => 'Sale 10%',
            'value'      => '-10%',
            'extra_info' => [
                'description' => 'Winter sale program'
            ]
        ]);
    }

    public function removeDiscount()
    {
        Cart::name('shopping')->clearActions();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        //$this->cart->clearActions();
        Cart::name('shopping')->removeItem($id);
        return redirect(route('cart.index'))->with('success', 'The item has been deleted');
    }
}
