<?php

use Tests\TestCase;
use App\Models\Cupom;

class CupomServiceTest extends TestCase
{
    public function test_desconto_percentual()
    {
        $cupom = new Cupom([
            'tipo' => 'percentual',
            'valor' => 10,
        ]);

        $valorTotal = 200;
        $desconto = $cupom->calcularDesconto($valorTotal);

        $this->assertEquals(20, $desconto);
    }
}