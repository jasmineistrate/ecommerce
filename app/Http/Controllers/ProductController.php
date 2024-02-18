<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('back.product.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'=>'required'
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('productImages'), $imageName);
        Product::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'price'=>floatval($request->price),
            'image'=>$imageName,
            'color'=>$request->color
        ]);
        return redirect(route('admin.products'))->with('success', 'The product has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('back.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('back.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if($request->image){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('productImages'), $imageName);
        }
        if($request->image){
            $product->update([
                'title'=>$request->title,
                'description'=>$request->description,
                'price'=>floatval($request->price),
                'image'=>$imageName,
                'color'=>$request->color
            ]);
        }
        else
        {
            $product->update([
                'title'=>$request->title,
                'description'=>$request->description,
                'price'=>floatval($request->price),
                'color'=>$request->color
            ]);
        }
        return redirect(route('admin.products'))->with('success', 'The product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect(route('admin.products'))->with('success', 'The product has been deleted');
    }
}
