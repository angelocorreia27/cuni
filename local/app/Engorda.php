<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Engorda extends Model {

	protected $table = 'engorda';
	//public $timestamps = false;

	use SoftDeletes;

	protected $fillable = array('id_maternidade', 'id_gaiola', 'data_entrada', 'quantidade', 'dias_fase', 'prev_saida');


	 public function engorda(){
     	return $this->hasMany('App\Engorda');
     }

}