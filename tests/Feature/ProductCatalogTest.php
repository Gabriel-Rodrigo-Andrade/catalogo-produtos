<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_supports_product_crud_and_displays_product_information(): void
    {
        $existingProduct = Product::factory()->create([
            'nome' => 'Caderno universitário',
            'descricao' => 'Caderno de 200 folhas',
            'preco' => 32.90,
            'estoque' => 14,
        ]);

        $this->get('/')->assertRedirect(route('products.index'));
        $this->get(route('products.index'))
            ->assertOk()
            ->assertSee('Caderno universitário')
            ->assertSee('R$ 32,90');
        $this->get(route('products.show', $existingProduct))
            ->assertOk()
            ->assertSee('Caderno de 200 folhas');

        $this->post(route('products.store'), [
            'nome' => 'Caneta azul',
            'descricao' => 'Ponta média',
            'preco' => 4.50,
            'estoque' => 20,
        ])->assertRedirect();

        $newProduct = Product::query()->where('nome', 'Caneta azul')->firstOrFail();
        $this->assertModelExists($newProduct);

        $this->put(route('products.update', $newProduct), [
            'nome' => 'Caneta azul premium',
            'descricao' => 'Ponta média e corpo emborrachado',
            'preco' => 6.75,
            'estoque' => 17,
        ])->assertRedirect(route('products.show', $newProduct));

        $this->assertDatabaseHas('products', [
            'id' => $newProduct->id,
            'nome' => 'Caneta azul premium',
            'preco' => '6.75',
            'estoque' => 17,
        ]);

        $this->delete(route('products.destroy', $newProduct))
            ->assertRedirect(route('products.index'));

        $this->assertModelMissing($newProduct);
    }
}
