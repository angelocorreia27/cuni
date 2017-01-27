<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAbateModifyColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //


            Schema::table('abate', function (Blueprint $table) {

                     $table->integer('id_engorda')->unsigned()->nullable()->change();
                     $table->integer('id_animal')->unsigned()->nullable()->change();
                     $table->integer('peso')->unsigned()->nullable()->change();

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
