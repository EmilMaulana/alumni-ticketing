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
        return view('dashboard.product.index', [
            'title' => 'Product List'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function frontProduct()
    {
        return view('front.product.product', [
            'title' => 'Semua Produk'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function detail(Product $product)
    {
        return view('front.product.detail', [
            'title' => $product->name,
            'product' => $product
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
