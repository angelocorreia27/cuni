<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDominioSimNao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::table('dominio')->insert([
                'dominio' => 'SimNao',
                'codigo' => 'SIM',
                'significado' => 'Sim'
            ]
        );

        DB::table('dominio')->insert([
                'dominio' => 'SimNao',
                'codigo' => 'NAO',
                'significado' => 'Não'
            ]
        );
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
