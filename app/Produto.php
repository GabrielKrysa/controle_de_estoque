<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'id', 'categoria_id', 'nome', 'quantidade', 'preco', 'descricao', 'image_name'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }

    public function pedidos()
    {
        return $this->hasMany(PedidoProduto::class, 'produto_id', 'id');
    }
}
