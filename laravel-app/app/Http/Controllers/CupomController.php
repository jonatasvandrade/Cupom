<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Cupom;

class CupomController extends Controller
{
    public function showForm()
    {
        $produtos = Produto::all();
        return view('dashboard', compact('produtos'));
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'codigo_cupom' => 'required|string',
        ]);

        $produtos = Produto::all();
        $cupom = Cupom::where('codigo', $request->codigo_cupom)
                      ->where('ativo', true)
                      ->first();

        if (!$cupom) {
            return redirect()->route('dashboard')
                ->withErrors(['codigo_cupom' => 'Cupom inválido ou inativo.']);
        }

        if ($cupom->validade && now()->gt($cupom->validade)) {
            return redirect()->route('dashboard')
                ->withErrors(['codigo_cupom' => 'Cupom expirado.']);
        }

        if ($cupom->max_uso !== null) {
            $totalUsos = \DB::table('cupom_usuario')->where('cupom_id', $cupom->id)->sum('usos');
            if ($totalUsos >= $cupom->max_uso) {
                return redirect()->route('dashboard')
                    ->withErrors(['codigo_cupom' => 'Cupom já atingiu o número máximo de usos.']);
            }
        }

        $user = auth()->user();
        $pivot = $user->cupons()->where('cupom_id', $cupom->id)->first();
        $usosUsuario = $pivot ? $pivot->pivot->usos : 0;

        if ($cupom->uso_unico && $usosUsuario >= 1) {
            return redirect()->route('dashboard')
                ->withErrors(['codigo_cupom' => 'Você já usou este cupom.']);
        }

        $total = $produtos->sum('preco');
        if ($cupom->valor_minimo && $total < $cupom->valor_minimo) {
            return redirect()->route('dashboard')
                ->withErrors(['codigo_cupom' => "Valor mínimo para usar este cupom é R$ ".number_format($cupom->valor_minimo, 2, ',', '.')."."]);
        }

        $desconto = 0;
        if ($cupom->tipo_desconto === 'percentual') {
            $desconto = ($total * $cupom->valor_desconto) / 100;
        } else {
            $desconto = $cupom->valor_desconto;
        }
        $total_com_desconto = max(0, $total - $desconto);

        if ($pivot) {
            $usos = $pivot->pivot->usos + 1;
            $user->cupons()->updateExistingPivot($cupom->id, ['usos' => $usos]);
        } else {
            $user->cupons()->attach($cupom->id, ['usos' => 1]);
        }

        // Salva cupom e valores na sessão para usar na view
        return redirect()->route('dashboard')->with([
            'cupom_aplicado' => true,
            'cupom_codigo' => $cupom->codigo,
            'desconto' => $desconto,
            'total_com_desconto' => $total_com_desconto,
        ]);
    }

    public function removeCoupon()
    {
        // Remove dados do cupom da sessão
        session()->forget(['cupom_aplicado', 'cupom_codigo', 'desconto', 'total_com_desconto']);
        return redirect()->route('dashboard');
    }
}
