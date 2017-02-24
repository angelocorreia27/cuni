<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDominioDiasFase extends Migration
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
                'dominio' => 'DiasFase',
                'codigo' => 'Engorda',
                'significado' => '90'
            ]
        );

        DB::table('dominio')->insert([
                'dominio' => 'DiasFase',
                'codigo' => 'Lactacao',
                'significado' => '31'
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
