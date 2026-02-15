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
        Schema::create('Menu', function (Blueprint $table) {
            $table->increments('id_menu')->index();
            $table->integer('id_menu_referencia')->nullable();
            $table->integer('id_permissao')->unsigned();;
            $table->foreign('id_permissao')->references('id_permissao')->on('Permissao')->onDelete('cascade');
            $table->string('nome_menu', 100)->nullable();
            $table->string('url_menu', 150)->nullable();
            $table->string('icon_menu', 50)->nullable();
            $table->integer('num_ordem')->nullable();
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
        Schema::dropIfExists('Menu');
    }
};
