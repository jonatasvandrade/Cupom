<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        $produtos = [
            [
                'product_name' => 'Faca Artesanal Aço Damasco',
                'ean' => '7891000123450',
                'preco' => 350.00,
                'custo' => 150.00,
            ],
            [
                'product_name' => 'Cutelo Forjado Rústico',
                'ean' => '7891000123451',
                'preco' => 270.00,
                'custo' => 120.00,
            ],
            [
                'product_name' => 'Canivete Dobrável',
                'ean' => '7891000123452',
                'preco' => 120.00,
                'custo' => 60.00,
            ],
            [
                'product_name' => 'Faca de Churrasco Premium',
                'ean' => '7891000123453',
                'preco' => 410.00,
                'custo' => 200.00,
            ],
            [
                'product_name' => 'Kit de Facas Chef',
                'ean' => '7891000123454',
                'preco' => 550.00,
                'custo' => 300.00,
            ],
        ];

        foreach ($produtos as $produto) {
            Produto::create($produto);
        }
    }
}
