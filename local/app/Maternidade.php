<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Maternidade extends Model {

	protected $table = 'maternidade';
	public $timestamps = false;

	//use SoftDeletes;

	protected $fillable = array('id_reproducao', 'data_parto', 'n_vivos', 'n_mortos', 'peso_ninhada', 'peso_desmame', 'a_desmamar','data_prev_desmame','data_prev_cobertura');

	public function reproducao()
    {
    	return $this->belongsTo('App\Reproducao','id_reproducao');
    }

}