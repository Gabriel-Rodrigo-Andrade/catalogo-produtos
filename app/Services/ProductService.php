<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductService
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function create(array $attributes): Product
    {
        $validatedAttributes = Validator::make($attributes, [
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'preco' => ['required', 'numeric', 'gt:0', 'decimal:0,2'],
            'estoque' => ['required', 'integer', 'min:0'],
        ])->validate();

        return Product::query()->create($validatedAttributes);
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function update(Product $product, array $attributes): Product
    {
        $validatedAttributes = Validator::make($attributes, [
            'nome' => ['sometimes', 'required', 'string', 'max:255'],
            'descricao' => ['sometimes', 'nullable', 'string'],
            'preco' => ['sometimes', 'required', 'numeric', 'gt:0', 'decimal:0,2'],
            'estoque' => ['sometimes', 'required', 'integer', 'min:0'],
        ])->validate();

        $product->update($validatedAttributes);

        return $product->refresh();
    }
}
