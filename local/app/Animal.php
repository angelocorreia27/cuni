<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animal extends Model {

	protected $table = 'animais';
	public $timestamps = false;

	use SoftDeletes; 

	   protected $fillable = array('tatuagem', 'id_gaiola', 'id_raca', 'ciclo', 'data_nascimento', 'peso_entrada', 'tipo_uso', 'sexo', 'data_entrada', 'id_banda', 'estado');
  
	public function gaiola()
    {
    	return $this->belongsTo('App\Gaiola','id_gaiola');
    }

	public function fornecedor()
    {
    	return $this->belongsTo('App\Fornecedor');
    }

    public function raca()
    {
    	return $this->belongsTo('App\Raca', 'id_raca');
    }

    public function banda()
    {
        return $this->belongsTo('App\Dominio', 'id_banda');
    }

}