<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProdutoController extends Controller
{
    public function index()
    {
        return Produto::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:50',
            'ean' => 'required|string|size:13|unique:produtos,ean',
            'preco' => 'required|numeric|min:0',
            'custo' => 'required|numeric|min:0',
        ]);

        $produto = Produto::create($validated);
        return response()->json($produto, 201);
    }

    public function show($id)
    {
        return Produto::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);

        $validated = $request->validate([
            'product_name' => 'sometimes|required|string|max:50',
            'ean' => 'sometimes|required|string|size:13|unique:produtos,ean,' . $id . ',id_product',
            'preco' => 'sometimes|required|numeric|min:0',
            'custo' => 'sometimes|required|numeric|min:0',
        ]);

        $produto->update($validated);

        return response()->json($produto, 200);
    }

    public function destroy($id)
    {
        Produto::destroy($id);
        return response()->json(null, 204);
    }
}
