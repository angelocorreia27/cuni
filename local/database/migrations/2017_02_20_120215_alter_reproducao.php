<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterReproducao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('reproducao', function (Blueprint $table) {
                 $table->string('aborto', 255)->nullable()->change();
                 $table->date('prev_parto')->nullable()->change();
                 $table->date('data_parto')->nullable()->change();
                 $table->dropColumn('rep_cio');
                 $table->string('diagnostico', 2)->nullable();
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
