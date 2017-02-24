<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRacasTable extends Migration {

	public function up()
	{
		Schema::create('racas', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('codigo')->unique();
			$table->string('descricao');
		});
	}

	public function down()
	{
		Schema::drop('racas');
	}
}