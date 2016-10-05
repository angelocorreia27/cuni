<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animal extends Model {

	protected $table = 'animais';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('id_gaiola', 'tatuagem', 'id_raca', 'ciclo', 'id_fornecedor', 'data_nascimento', 'peso_entrada', 'tipo_uso', 'sexo', 'data_entrada', 'ciclo_entrada');

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