<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaternidadeRequest extends FormRequest
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
            'id_reproducao' => 'required',
            'id_gaiola' =>'required',
            'data_parto'  => 'required',
            'n_vivos'  => 'required',
            'n_mortos'=>'required'

        ];
    }
}
