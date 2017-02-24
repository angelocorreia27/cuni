<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raca extends Model {

	protected $table = 'racas';
	public $timestamps = false;

	protected $fillable = array('codigo', 'descricao');

	public function animais(){
    	return $this->hasMany('App\Animal');
    }

}