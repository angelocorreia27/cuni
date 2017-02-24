<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Maternidade extends Model {

	protected $table = 'maternidade';
	public $timestamps = false;

	//use SoftDeletes;

	protected $fillable = array('id_gaiola', 'id_reproducao', 'data_parto', 'vivos', 'n_m', 'peso_ninhada', 'peso_desmame', 'a_desmamar','prev_desmame','prev_cobertura');

	public function gaiola()
    {
    	return $this->belongsTo('App\Gaiola','id_gaiola');
    }

}