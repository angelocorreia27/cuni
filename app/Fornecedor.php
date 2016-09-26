<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model {

	protected $table = 'fornecedores';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('name', 'email', 'endereco', 'Telemovel', 'telefone');

	public function animais(){
    	return $this->hasMany('App\Animal');
    }

}