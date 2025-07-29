<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Cupom;

class CartController extends Controller
{
    public function index()
    {
        return session('cart', []);
    }

    public function add(Request $request)
    {
        $produto = Produto::findOrFail($request->produto_id);
        $quantity = $request->input('quantity', 1);

        $cart = session()->get('cart', []);
        $cart[$produto->id_product] = [
            'produto' => $produto,
            'quantity' => ($cart[$produto->id_product]['quantity'] ?? 0) + $quantity,
        ];

        session(['cart' => $cart]);

        return response()->json(['message' => 'Produto adicionado com sucesso.', 'cart' => $cart]);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);

        return response()->json(['message' => 'Produto removido.', 'cart' => $cart]);
    }

    public function applyCupom(Request $request)
    {
        $cupom = Cupom::where('codigo', $request->codigo)->first();

        if (!$cupom || !$cupom->validoParaUsuario($request->user())) {
            return response()->json(['message' => 'Cupom inválido ou expirado.'], 400);
        }

        session(['cupom' => $cupom]);

        return response()->json(['message' => 'Cupom aplicado com sucesso.', 'cupom' => $cupom]);
    }

    public function total()
    {
        $cart = session('cart', []);
        $cupom = session('cupom');
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['produto']->preco * $item['quantity'];
        }

        if ($cupom) {
            if ($cupom->tipo === 'percentual') {
                $total -= $total * ($cupom->valor / 100);
            } else {
                $total -= $cupom->valor;
            }
        }

        return response()->json(['total' => max(0, $total)]);
    }
}
