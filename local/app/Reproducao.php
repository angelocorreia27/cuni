<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Reproducao extends Model {

	protected $table = 'reproducao';
	public $timestamps = false;

	//use SoftDeletes;

	protected $fillable = array('id','id_reprodutor','id_matriz','data_cobertura','prev_parto','aborto','data_parto','diagnostico');	

	public function pai()
    {
        return $this->belongsTo('App\Animal','id_reprodutor');
    }

    public function mae()
    {
        return $this->belongsTo('App\Animal','id_matriz');
    }

    public function aborto()
    {
        return $this->belongsTo('App\Dominio', 'aborto');
    }

    public static function rolesReproducao($id, $id_matriz)
    {
        if ($id == null){
        return array(
            'data_cobertura' => 'required|unique:reproducao,data_cobertura,'.$id.',id,id_matriz,'.$id_matriz 
                    );
        }
    }
}