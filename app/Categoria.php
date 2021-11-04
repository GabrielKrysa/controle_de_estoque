<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nome', 'user_id'
    ];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
