<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Reproducao extends Model {

	protected $table = 'reproducao';
	public $timestamps = false;

	//use SoftDeletes;

	protected $fillable = array('id_gaiola', 'id_maternidade', 'data_entrada', 'quantidade', 'dias_fase', 'peso', 'prev_saida', 'prev_quantidade');


	

}