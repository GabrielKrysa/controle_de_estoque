<?php

namespace App\Http\Controllers;

use App\PedidoProduto;
use App\Produto;
use Illuminate\Support\Facades\Auth;

class EstoqueController extends Controller
{
    public function index()
    {
        $produtos = Produto::where('user_id', '=', Auth::user()->id)->with('categoria')->get();
        return view('controleEstoque', ["produtos" => $produtos]);
    }

    public function indexPedidos()
    {
        $pedidos = Auth::user()->pedidos;
        return view('relatorio', ["pedidos" => $pedidos]);
    }

    public function validarPedido($id)
    {
        $pedido = PedidoProduto::query()->findOrFail($id);

        $pedido->update(['validado' => true]);

        $produto = Produto::query()->findOrFail($pedido->produto_id);

        $produto->update(['quantidade' => $produto->quantidade - $pedido->quantidade]);

        $pedidos = Auth::user()->pedidos;

        return view('relatorio', ["pedidos" => $pedidos]);
    }

    public function reprovarPedido($id)
    {
        $pedido = PedidoProduto::query()->findOrFail($id);
        $pedido->delete();

        $pedidos = Auth::user()->pedidos;

        return view('relatorio', ["pedidos" => $pedidos]);
    }
}
