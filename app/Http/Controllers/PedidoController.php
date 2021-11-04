<?php

namespace App\Http\Controllers;

use App\PedidoProduto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $data['validado'] = false;
        $pedido = PedidoProduto::query()->create($data);

        return $pedido;
    }
}
