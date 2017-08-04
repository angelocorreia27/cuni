<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AnimalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {        
            return [ 
                    'sexo'=> 'required',
                    'id_gaiola' =>'required',
                    'id_raca'  => 'required',
                    'data_nascimento'=>'required',
                    'tipo_uso' =>'required',
                    'id_banda'=>'required'
                ];  
        
    }



}
