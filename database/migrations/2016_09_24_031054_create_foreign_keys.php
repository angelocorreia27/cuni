<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('animais', function(Blueprint $table) {
			$table->foreign('id_gaiola')->references('id')->on('gaiolas')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('animais', function(Blueprint $table) {
			$table->foreign('id_raca')->references('id')->on('racas')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('animais', function(Blueprint $table) {
			$table->foreign('id_fornecedor')->references('id')->on('fornecedores')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('animais', function(Blueprint $table) {
			$table->dropForeign('animais_id_gaiola_foreign');
		});
		Schema::table('animais', function(Blueprint $table) {
			$table->dropForeign('animais_id_raca_foreign');
		});
		Schema::table('animais', function(Blueprint $table) {
			$table->dropForeign('animais_id_fornecedor_foreign');
		});
	}
}