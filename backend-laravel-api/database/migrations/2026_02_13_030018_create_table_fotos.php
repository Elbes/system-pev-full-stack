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
        Schema::create('FotosEntrada', function (Blueprint $table) {
            $table->increments('id_foto')->index();
            $table->text('nome_foto')->nullable();
            $table->text('file_path')->nullable();
            $table->foreign('id_entrada')->references('id_entrada')->on('Entradas')->onDelete('cascade');
            $table->integer('id_entrada')->unsigned();
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
        Schema::dropIfExists('FotosEntrada');
    }
};
