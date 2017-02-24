<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDominioEstado extends Migration
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
                'dominio' => 'Estado',
                'codigo' => 'Activo',
                'significado' => 'Activo'
            ]
        );

        DB::table('dominio')->insert([
                'dominio' => 'Estado',
                'codigo' => 'Abatido',
                'significado' => 'Abatido'
            ]
        );

         DB::table('dominio')->insert([
                'dominio' => 'Estado',
                'codigo' => 'Obito',
                'significado' => 'Obito'
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
