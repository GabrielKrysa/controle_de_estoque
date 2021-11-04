@extends('layouts.app')

@section('content')
    <div class="title d-flex justify-content-center mt-lg-5 mb-5">
        Feira Agroecológica
    </div>

    @guest
        <div class="d-flex justify-content-center">
            <a class="btn btn-success mr-5" style="width: 150px !important" href="/guarapuava">Guarapuava</a>
            <a class="btn btn-success ml-5" style="width: 150px !important" href="/irati">Irati</a>
        </div>
    @else
        <div class="links d-flex justify-content-center">
            <a href="{{route('categoria.index')}}">Cadastrar Categoria</a>
            <a href="{{route('produto.index')}}">Cadastrar Produtos</a>
            <br>
            <br>
            <a href="{{route('produto.indexExcluir')}}">Excluir Produtos</a>
            <a href="{{route('estoque.index')}}">Vizualizar Estoque de Produtos</a>
        </div>
        <div class="links d-flex justify-content-center mb-5">
            <a href="{{route('estoque.indexPedido')}}">Relatório de pedidos</a>
        </div>
        <div class="d-flex justify-content-center">
            <a class="btn btn-success mr-5" style="width: 150px !important" href="/guarapuava">Guarapuava</a>
            <a class="btn btn-success ml-5" style="width: 150px !important" href="/irati">Irati</a>
        </div>
    @endguest
@endsection
