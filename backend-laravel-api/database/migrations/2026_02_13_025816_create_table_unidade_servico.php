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
        Schema::create('UnidadeServico', function (Blueprint $table) {
            $table->increments('id_unidade')->index();
            $table->string('nome', 150)->nullable();
            $table->foreign('id_ra')->references('id_ra')->on('RegiaoAdministrativa')->onDelete('cascade');
            $table->integer('id_ra')->unsigned();
            $table->string('endereco', 200)->nullable();
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
        Schema::dropIfExists('UnidadeServico');
    }
};
