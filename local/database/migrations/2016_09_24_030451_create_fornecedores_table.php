<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFornecedoresTable extends Migration {

	public function up()
	{
		Schema::create('fornecedores', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name');
			$table->string('email');
			$table->text('endereco');
			$table->string('Telemovel', 20);
			$table->string('telefone', 20);
		});
	}

	public function down()
	{
		Schema::drop('fornecedores');
	}
}