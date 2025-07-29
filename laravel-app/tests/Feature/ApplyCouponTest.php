<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Cupom;

class ApplyCouponTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_aplica_cupom_valido()
    {
        $user = User::factory()->create();
        $cupom = Cupom::create([
            'codigo' => 'TESTE10',
            'tipo' => 'percentual',
            'valor' => 10,
            'max_uso' => 10,
            'validade' => now()->addDays(1),
        ]);

        $response = $this->actingAs($user)->post('/aplicar-cupom', [
            'cupom' => 'TESTE10',
        ]);

        $response->assertRedirect();
        $this->assertEquals(session('cupom')['codigo'], 'TESTE10');
    }
}
