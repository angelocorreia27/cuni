<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Raca extends Model {

	protected $table = 'racas';
	public $timestamps = false;

//	use SoftDeletes;

	protected $fillable = array('codigo', 'descricao');

	public function animais(){
    	return $this->hasMany('App\Animal');
    }

}