<?php

namespace App\Http\Controllers;


use App\Models\products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // CREATE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);
        $product = products::create($validated);

        return response()->json(['product' => $product], 201);
    }

    // READ (all)
    public function index()
    {
        return response()->json(products::all());
    }

    // READ (single)
    public function show($id)
    {
        $product = products::find($id);

        if (!$product) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return response()->json($product);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $product = products::find($id);

        if (!$product) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $product->update($request->only(['name', 'description', 'price']));

        return response()->json(['product' => $product]);
    }

    // DELETE
    public function destroy($id)
    {
        $product = products::find($id);

        if (!$product) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
