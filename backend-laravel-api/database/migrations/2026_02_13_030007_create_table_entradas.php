<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Entradas', function (Blueprint $table) {
            $table->increments('id_entrada')->index();
            $table->string('placa_veiculo', 30)->nullable();
            $table->foreign('id_ra')->references('id_ra')->on('RegiaoAdministrativa')->onDelete('cascade');
            $table->integer('id_ra')->unsigned();
            $table->foreign('id_unidade')->references('id_unidade')->on('UnidadeServico')->onDelete('cascade');
            $table->integer('id_unidade')->nullable();
            $table->integer('alerta_irregularidade')->nullable();
            $table->integer('id_usuario')->unsigned();
            $table->timestamp('dhs_cadastro')->nullable();
            $table->timestamp('dhs_atualizacao')->nullable();
            $table->timestamp('dhs_exclusao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Entradas');
    }
};
