<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Abate extends Model {

	protected $table = 'abate';
	public $timestamps = false;

	//use SoftDeletes;

	protected $fillable = array('id_engorda','id_animal', 'data_abate', 'peso');	

	
	public function engorda()
    {
    	return $this->belongsTo('App\Engorda','id_engorda');
    }

    public function animal()
    {
    	return $this->belongsTo('App\Animal','id_animal');
    }

}