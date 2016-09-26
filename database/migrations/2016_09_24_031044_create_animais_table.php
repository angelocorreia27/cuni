<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnimaisTable extends Migration {

	public function up()
	{
		Schema::create('animais', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('id_gaiola')->unsigned();
			$table->string('tatuagem', 50)->nullable();
			$table->integer('id_raca')->unsigned();
			$table->integer('ciclo')->nullable();
			$table->integer('id_fornecedor')->unsigned()->nullable();
			$table->date('data_nascimento');
			$table->integer('peso_entrada')->nullable();
			$table->string('tipo_uso', 20);
			$table->string('sexo', 1);
			$table->date('data_entrada')->nullable();
			$table->string('ciclo_entrada')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('animais');
	}
}