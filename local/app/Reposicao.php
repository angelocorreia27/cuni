<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Reposicao extends Model {

	protected $table = 'reposicao';
	public $timestamps = false;

	//use SoftDeletes;

	protected $fillable = array('id_gaiola', 'id_maternidade', 'data_entrada', 'quantidade', 'dias_fase', 'peso', 'prev_saida', 'prev_quantidade');

   public function gaiola()
    {
    	return $this->belongsTo('App\Gaiola','id_gaiola');
    }

    public function maternidade()
    {
        return $this->belongsTo('App\Maternidade', 'id_maternidade');
    }
	

}