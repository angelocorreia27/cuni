<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkMaternidadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reposicao', function (Blueprint $table) {

            $table->integer('id_maternidade')->unsigned()->change();
            $table->integer('id_gaiola')->unsigned()->change();

            $table->foreign('id_maternidade')
                  ->references('id')->on('maternidade')
                  ->onDelete('cascade');

            $table->foreign('id_gaiola')
                  ->references('id')->on('gaiolas')
                  ->onDelete('cascade');
        });

        Schema::table('maternidade', function (Blueprint $table) {
            $table->integer('id_gaiola')->unsigned()->change();
            $table->foreign('id_gaiola')
                  ->references('id')->on('gaiolas')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reposicao', function (Blueprint $table) {
            //
        });
    }
}
