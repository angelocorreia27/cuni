<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDominioFase extends Migration
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
                'dominio' => 'Fase',
                'codigo' => 'Engorda',
                'significado' => 'Engorda'
            ]
        );

         DB::table('dominio')->insert([
                'dominio' => 'Fase',
                'codigo' => 'Reproducao',
                'significado' => 'Reprodução'
            ]
        );

        DB::table('dominio')->insert([
                'dominio' => 'Fase',
                'codigo' => 'Lactacao',
                'significado' => 'Lactação'
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
