<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password', 'cidade',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPedidosAttribute()
    {
        $categorias = Categoria::query()->where('user_id', $this->id)->get();
        $pedidos = [];

        foreach ($categorias as $categoria) {
            foreach ($categoria->produtos as $produto) {
                foreach ($produto->pedidos as $pedido) {
                    $pedido->produto;
                    $pedidos[] = $pedido;
                }
            }
        }

        return $pedidos;
    }
}
