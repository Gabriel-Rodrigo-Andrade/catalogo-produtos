<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()->orderBy('nome')->paginate(12);

        return view('products.index', compact('products'));
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function store(Request $request, ProductService $productService): RedirectResponse
    {
        $product = $productService->create($request->all());

        return redirect()->route('products.show', $product)->with('success', 'Produto cadastrado com sucesso.');
    }

    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product, ProductService $productService): RedirectResponse
    {
        $productService->update($product, $request->all());

        return redirect()->route('products.show', $product)->with('success', 'Produto atualizado com sucesso.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produto removido do catálogo.');
    }
}
