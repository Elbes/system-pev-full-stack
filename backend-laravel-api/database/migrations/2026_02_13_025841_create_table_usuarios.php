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
        Schema::create('Usuarios', function (Blueprint $table) {
            $table->increments('id_usuario')->index();
            $table->string('nom_usuario', 250)->nullable();
            $table->string('num_cpf', 15)->nullable();
            $table->date('dat_nascimento')->nullable();
            $table->foreign('id_unidade')->references('id_unidade')->on('UnidadeServico')->onDelete('cascade');
            $table->integer('id_unidade')->unsigned();
            $table->foreign('id_perfil')->references('id_perfil')->on('Perfil')->onDelete('cascade');
            $table->integer('id_perfil')->nullable();
            $table->string('dsc_email', 250)->nullable();
            $table->string('pws_senha', 250)->nullable();
            $table->string('sit_usuario', 1)->nullable();
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
        Schema::dropIfExists('Usuarios');
    }
};
