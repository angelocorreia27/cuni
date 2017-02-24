<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsAnimais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::table('animais', function ($table) {
                $table->integer('id_reposicao')->unsigned()->nullable();
                $table->string('estado', '10');
           });

         Schema::table('animais', function (Blueprint $table) {

            $table->foreign('id_reposicao')
                  ->references('id')->on('reposicao')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
