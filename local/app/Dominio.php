<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Dominio extends Model {

	protected $table = 'dominio';
	public $timestamps = false;

	//use SoftDeletes;

	protected $fillable = array('dominio', 'codigo', 'significado');


	 public function animais(){
     	return $this->hasMany('App\Animal');
     }

}