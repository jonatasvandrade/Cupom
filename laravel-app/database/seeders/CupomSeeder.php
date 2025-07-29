<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cupom;

class CupomSeeder extends Seeder
{
    public function run(): void
    {
        $cupons = [
            [
                'codigo' => 'DESCONTO10',
                'tipo_desconto' => 'percentual',
                'valor_desconto' => 10.00,
                'max_uso' => null, // ilimitado
                'usos' => 0,
                'validade' => '2025-12-31',
                'ativo' => true,
            ],
            [
                'codigo' => 'FIXO50',
                'tipo_desconto' => 'fixo',
                'valor_desconto' => 50.00,
                'max_uso' => 100,
                'usos' => 0,
                'validade' => '2025-08-31',
                'ativo' => true,
            ],
            [
                'codigo' => 'PROMO20',
                'tipo_desconto' => 'percentual',
                'valor_desconto' => 20.00,
                'max_uso' => 50,
                'usos' => 0,
                'validade' => '2025-10-31',
                'ativo' => true,
            ],
            [
                'codigo' => 'BLACKFRIDAY',
                'tipo_desconto' => 'percentual',
                'valor_desconto' => 40.00,
                'max_uso' => 200,
                'usos' => 0,
                'validade' => '2025-11-30',
                'ativo' => true,
            ],
            [
                'codigo' => 'WELCOME5',
                'tipo_desconto' => 'fixo',
                'valor_desconto' => 5.00,
                'max_uso' => null,
                'usos' => 0,
                'validade' => null,
                'ativo' => true,
            ],
        ];

        foreach ($cupons as $cupom) {
            Cupom::create($cupom);
        }
    }
}
