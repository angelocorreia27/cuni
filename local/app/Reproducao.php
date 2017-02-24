<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Reproducao extends Model {

	protected $table = 'reproducao';
	public $timestamps = false;

	//use SoftDeletes;

	protected $fillable = array('id', 'id_gaiola','id_reprodutor','id_matriz','data_cobertura','prev_parto','aborto','data_parto','diagnostico');	

	public function reproducao(){
    	return $this->hasMany('App\Reproducao');
    }
    public function aborto()
    {
        return $this->belongsTo('App\Dominio', 'aborto');
    }

}