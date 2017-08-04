<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

	

    public function index()
    {
       
        return view('layouts.partials.goodfood.contact');
    
    }

    public function contato() {

	$rules = array( 'name' => 'required', 'email' => 'required|email', 'message' => 'required' );
	$validation = Validator::make(Input::all(), $rules);
	$data = array();
	 $data['name'] = Input::get("name");
	 $data['email'] = Input::get("email");
	 $data['message'] = Input::get("message");

	if($validation->passes()) {
		
		 Mail::send('layouts.partials.goodfood.contact', $data, function($message) {
		 $message->from(Input::get('email'), Input::get('name'));
	 	 $message->to('angelo.benjamim.correia@gmail.com') ->subject('Contato Bill Jr.');
		 });
		
	return Redirect::to('contato') ->with('msg', 'Mensagem enviada com sucesso!');

	 }

	return Redirect::to('contato') 
	 ->withInput() 
	 ->withErrors($validation) 
	 ->with('msg', 'Erro! Preencha todos os campos corretamente.');
	
	}


}
