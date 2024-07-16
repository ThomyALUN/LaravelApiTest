<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        if ($product->save()) {
            return response([
                'mensaje'=>'Creación exitosa'
            ], 201);
        } else {
            return response([
                'mensaje'=>'Creación fallida'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            return response()->json($product);
        } catch (\Exception $e) {
            return response([
                'mensaje'=>'Producto no encontrado'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $product = Product::findOrFail($id);
        } catch (\Exception $e) {
            return response([
                'mensaje'=>'Producto no encontrado'
            ], 404);
        }
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        if ($product->save()) {
            return response([
                'mensaje'=>'Actualización exitosa'
            ], 200);
        } else {
            return response([
                'mensaje'=>'Actualización fallida'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product=Product::find($id);
        if ($product->delete()) {
            return response([
                'mensaje'=>'Eliminación exitosa'
            ], 200);
        } else {
            return response([
                'mensaje'=>'Eliminación fallida'
            ], 500);
        }
    }
}
