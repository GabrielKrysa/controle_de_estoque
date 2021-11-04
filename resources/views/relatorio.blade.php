@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">PEDIDOS</div>
                    <div class="card">
                        @if(isset($Ok))
                            <div class="alert alert-success" role="alert" align="center">
                                {{ $Ok }}

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                        @endif
                        @if(isset($NotOk))
                            <div class="alert alert-danger" role="alert" align="center">
                                {{ $NotOk }}

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                        @endif
                        <table class="table table-striped table-bordered table-hover" id="table_disciplines">
                            <tr>
                                <thead>
                                <th scope="col" width="20%">NOME</th>
                                <th scope="col" width="20%">TELEFONE</th>
                                <th scope="col" width="20%">PRODUTO</th>
                                <th scope="col" width="20%">PREÇO UNITÁRIO</th>
                                <th scope="col" width="20%">PREÇO TOTAL</th>
                                <th scope="col" width="20%">QUANTIDADE</th>
                                <th scope="col" width="20%">FEITO EM</th>
                                <th scope="col" width="20%"></th>
                                </thead>
                            </tr>
                            <tbody>
                            @foreach($pedidos as $pedido)
                                <tr>
                                    <td>{{ $pedido->nome }}</td>
                                    <td>{{ $pedido->telefone }}</td>
                                    <td>{{ $pedido->produto->nome }}</td>
                                    <td>R$ {{ number_format((float)$pedido->produto->preco,2, ',', '.'  ) }}</td>
                                    <td>R$ {{ number_format($pedido->valor,2, ',', '.'  ) }}</td>
                                    <td>{{ $pedido->quantidade }}</td>
                                    <td>{{ date('d/m/Y h:i', strtotime($pedido->created_at)) }}</td>
                                    <td>
                                        @if($pedido->validado)
                                            <span class="badge badge-success">VALIDADO</span>
                                        @else
                                            <form action="{{route('pedido_validado', ['id' => $pedido->id])}}"
                                                  method="post">
                                                @csrf
                                                <button type="submit">VALIDAR</button>
                                            </form>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    window.setTimeout(function () {
        $(".alert").fadeTo(1500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 5000);
</script>
