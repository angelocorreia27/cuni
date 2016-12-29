<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gaiola extends Model {

	protected $table = 'gaiolas';
	public $timestamps = true;

	use SoftDeletes;

	protected $fillable = array('codigo', 'descricao');

	public function animais(){
    	return $this->hasMany('App\Animal');
    }

}