<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Abate extends Model {

	protected $table = 'reprodutores';
	public $timestamps = false;

	//use SoftDeletes;

	protected $fillable = array('id_engorda', 'id_gaiola', 'id_animal', 'data_abate', 'peso');	

}