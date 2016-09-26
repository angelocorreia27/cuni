<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGaiolasTable extends Migration {

	public function up()
	{
		Schema::create('gaiolas', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('codigo')->unique();
			$table->string('descricao');
		});
	}

	public function down()
	{
		Schema::drop('gaiolas');
	}
}