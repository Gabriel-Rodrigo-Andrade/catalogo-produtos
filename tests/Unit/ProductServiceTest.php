<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_is_not_created_when_price_breaks_business_rule(): void
    {
        $productService = app(ProductService::class);

        try {
            $productService->create([
                'nome' => 'Teclado mecânico',
                'descricao' => 'Teclado compacto',
                'preco' => 0,
                'estoque' => 5,
            ]);

            self::fail('A criação deveria rejeitar preço zero.');
        } catch (ValidationException $exception) {
            self::assertArrayHasKey('preco', $exception->errors());
        }

        $this->assertDatabaseCount('products', 0);
    }

    public function test_update_changes_product_information(): void
    {
        $product = Product::factory()->create([
            'nome' => 'Mouse',
            'preco' => 50,
            'estoque' => 4,
        ]);

        $updatedProduct = app(ProductService::class)->update($product, [
            'nome' => 'Mouse sem fio',
            'preco' => 79.90,
            'estoque' => 8,
        ]);

        self::assertSame('Mouse sem fio', $updatedProduct->nome);
        self::assertSame('79.90', $updatedProduct->preco);
        self::assertSame(8, $updatedProduct->estoque);
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'nome' => 'Mouse sem fio',
            'preco' => '79.90',
            'estoque' => 8,
        ]);
    }

    public function test_update_rejects_invalid_price_without_changing_product(): void
    {
        $product = Product::factory()->create([
            'nome' => 'Monitor',
            'preco' => 899.90,
            'estoque' => 2,
        ]);

        try {
            app(ProductService::class)->update($product, ['preco' => -1]);

            self::fail('A atualização deveria rejeitar preço negativo.');
        } catch (ValidationException $exception) {
            self::assertArrayHasKey('preco', $exception->errors());
        }

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'nome' => 'Monitor',
            'preco' => '899.90',
            'estoque' => 2,
        ]);
    }
}
