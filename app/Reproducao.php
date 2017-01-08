<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Reproducao extends Model {

	protected $table = 'reprodutores';
	public $timestamps = false;

	//use SoftDeletes;

	protected $fillable = array('id_gaiola', 'id_reprodutor', 'id_matriz', 'data_cobertura', 'prev_parto', 'rep_cio', 'aborto', 'data_parto');

	

}