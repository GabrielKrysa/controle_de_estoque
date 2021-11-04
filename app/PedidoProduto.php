<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PedidoProduto extends Model
{
    protected $fillable = [
        'nome',
        'valor',
        'telefone',
        'produto_id',
        'quantidade',
        'validado',
    ];

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }
}
