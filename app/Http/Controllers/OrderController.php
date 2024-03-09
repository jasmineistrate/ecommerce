<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::latest()->get();
        return view('back.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('back.order.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $productsName = '';
        for($i = 0; $i < count($request->products); $i++)
        {
            $productsName = $productsName . $request->products[$i] . ',';
        }
        Order::create([
            'user_id' =>auth()->user()->id,
            'product_name' =>$productsName,
            'total_price' =>$request->total_price,
            'city' =>$request->city,
            'adress' =>$request->adress,
            'quantity' =>$request->quantity,
            'country' =>$request->country,
            'status' =>$request->status
        ]);
        return redirect(route('admin.order'))->with('success', 'The order has been created');
    }

    /**
     * Display the specified resource.
     */

     public function simpleUserOrders()
     {
        $orders = Order::where('user_id', auth()->user()->id)->get();
        return view('back.simpleUser.orders', compact('orders'));
     }

    
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $products = Product::all();
        $order = Order::find($id);
        return view('back.order.edit', compact('order', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $order = Order::find($id);
        if($request->products)
        {
            $productsName = '';
            for($i = 0; $i < count($request->products); $i++)
            {
                $productsName = $productsName . $request->products[$i] . ',';
            }
            $order-> update([
                'user_id' =>auth()->user()->id,
                'product_name' =>$productsName,
                'total_price' =>$request->total_price,
                'city' =>$request->city,
                'adress' =>$request->adress,
                'quantity' =>$request->quantity,
                'country' =>$request->country,
                'status' =>$request->status
            ]);
        }
        else
        {
            $order-> update([
                'user_id' =>auth()->user()->id,
                'total_price' =>$request->total_price,
                'city' =>$request->city,
                'adress' =>$request->adress,
                'quantity' =>$request->quantity,
                'country' =>$request->country,
                'status' =>$request->status
            ]);
        }
        return redirect(route('admin.order'))->with('success', 'The order has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(String $id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect(route('admin.order'))->with('success', 'The order has been deleted');
    }
}
