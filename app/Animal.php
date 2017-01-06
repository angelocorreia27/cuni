<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animal extends Model {

	protected $table = 'animais';
	public $timestamps = false;

	use SoftDeletes;

	protected $fillable = array('id_gaiola', 'tatuagem', 'id_raca', 'ciclo', 'data_nascimento', 'peso_entrada', 'tipo_uso', 'sexo', 'data_entrada', 'ciclo_entrada','id_banda');

	public function gaiola()
    {
    	return $this->belongsTo('App\Gaiola');
    }

	public function fornecedor()
    {
    	return $this->belongsTo('App\Fornecedor');
    }

    public function raca()
    {
    	return $this->belongsTo('App\Raca');
    }

}