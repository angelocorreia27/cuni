<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Obito extends Model {

	protected $table = 'obito';
	public $timestamps = false;

	use SoftDeletes;

	protected $fillable = array('data', 'causa', 'quantidade', 'id_fase', 'tipo_fase');

	public function obitos(){
     	return $this->hasMany('App\Obito');
     }

}