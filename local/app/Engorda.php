<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Engorda extends Model {

	protected $table = 'engorda';
	//public $timestamps = false;

	//use SoftDeletes;

	protected $fillable = array('id_maternidade', 'id_gaiola', 'data_entrada', 'quantidade', 'prev_saida', 'data_saida');


	 public function maternidade()
    {
    	return $this->belongsTo('App\Maternidade','id_maternidade');
    }
     public function gaiola()
    {
    	return $this->belongsTo('App\Gaiola','id_gaiola');
    }

}