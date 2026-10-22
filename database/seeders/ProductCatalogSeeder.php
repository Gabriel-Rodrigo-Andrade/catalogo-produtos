<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'nome' => 'Fonte Iphone tipo-c',
                'descricao' => 'Maravilhoso, pois você gasta o rim no celular e tem que vender o olho pra comprar a fonte',
                'preco' => 200.00,
                'estoque' => 50,
            ],
            [
                'nome' => 'Iphone 19',
                'descricao' => 'Muito ruim, caro e eu reclamo porque nao existe',
                'preco' => 3000.00,
                'estoque' => 50,
            ],
            [
                'nome' => 'Iphone Duo',
                'descricao' => 'Perfeito pra quem pretende vender a casa e usar o celular aberto como telhado',
                'preco' => 790000.00,
                'estoque' => 1,
            ],
            [
                'nome' => 'Mochila Gamer',
                'descricao' => 'Essa mochila é equipada com uma jetpack e um painel solar pra quando faltar energia em seu recinto',
                'preco' => 56000.00,
                'estoque' => 5,
            ],
            [
                'nome' => "Monitor 32'",
                'descricao' => "Muito pequeno, acho melhor comprar o de 45'",
                'preco' => 3000.00,
                'estoque' => 5,
            ],
            [
                'nome' => 'Mousepad tipo tapete 4Mx5M',
                'descricao' => 'Bom de tamanho mas pode ser pequeno de acordo com sua sensibilidade do mouse',
                'preco' => 500.00,
                'estoque' => 3,
            ],
            [
                'nome' => 'S98 Ultra x duplo Y',
                'descricao' => 'Muito bom pra quem quer o celular travando e perdendo 40% da fipe',
                'preco' => 40900.00,
                'estoque' => 2,
            ],
            [
                'nome' => 'Teclado Mecânico',
                'descricao' => 'Muito barulhento, péssimo para quem quer silêncio',
                'preco' => 900.00,
                'estoque' => 2,
            ],
        ];

        foreach ($products as $productAttributes) {
            Product::query()->updateOrCreate(
                ['nome' => $productAttributes['nome']],
                $productAttributes,
            );
        }
    }
}
