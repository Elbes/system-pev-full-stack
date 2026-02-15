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
        Schema::create('PerfilPermissao', function (Blueprint $table) {
            $table->increments('id_perfil_permissao')->index();
            $table->integer('id_perfil')->unsigned();
            $table->foreign('id_perfil')->references('id_perfil')->on('Perfil')->onDelete('cascade');
            $table->integer('id_permissao')->unsigned();
            $table->foreign('id_permissao')->references('id_permissao')->on('Permissao')->onDelete('cascade');
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
        Schema::dropIfExists('PerfilPermissao');
    }
};
