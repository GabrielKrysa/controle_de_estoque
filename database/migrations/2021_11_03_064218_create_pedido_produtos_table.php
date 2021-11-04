<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void]
     *  'nome',
     * 'valor',
     * 'telefone',
     * 'produto_id',
     * 'quantidade',
     */
    public function up()
    {
        Schema::create('pedido_produtos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('valor');
            $table->integer('quantidade');
            $table->string('telefone');
            $table->string('nome');
            $table->boolean('validado');
            $table->bigInteger('produto_id')->unsigned();
            $table->foreign('produto_id')->on('produtos')->references('id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_produtos');
    }
}
