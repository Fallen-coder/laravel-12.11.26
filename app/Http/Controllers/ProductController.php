<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|unique:products|max:255',
            'quantity' => 'required|integer',
            'description' => 'required',
        ]);

        $product = Product::create($validated);

        return redirect()
                ->route('products.show', [$product]) // vai ['product' => $product]
                ->with('message', "Product created successfully");
    }

    public function show(Product $product) {
        return view('products.show', compact('product'));
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect()
                ->route('products.index')
                ->with('message', "Product deleted successfully");
    }

    public function edit(Product $product) {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product) {
        $validated = $request->validate([
            'name' => 'required|unique:products|max:255',
            'quantity' => 'required|integer',
            'description' => 'required',
        ]);

        $product->update($validated);
        return redirect()
                ->route('products.show', [$product])
                ->with('message', "Product updated successfully");
    }

public function increaseQuantity(Product $product)
{
    $product->changeQuantity(1);

    return response()->json([
        'success' => true,
        'message' => 'Produkta daudzums veiksmīgi palielināts!',
        'quantity' => $product->fresh()->quantity,
    ]);
}

public function decreaseQuantity(Product $product)
{
    try {
        $product->changeQuantity(-1);

        return response()->json([
            'success' => true,
            'message' => 'Produkta daudzums veiksmīgi samazināts!',
            'quantity' => $product->fresh()->quantity,
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 422);
    }
}
}
