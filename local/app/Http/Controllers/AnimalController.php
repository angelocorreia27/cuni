<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests\AnimalRequest;

use App\Animal;
use App\Fornecedor;
use App\Raca;
use App\Gaiola;
use App\Dominio;
use Request;

use DateTime;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class AnimalController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $animais= Animal::all();

       // print_r($animais);
        $animais = Animal::where('estado', 'Activo')->get();

        if (Request::wantsJson()){
            return $animais;
        }else{
            return view('animais.index',compact('animais'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $animal = new Animal();
         $gaiolas = Gaiola::pluck('descricao','id')->all();
         $racas = Raca::pluck('descricao','id')->all();
         $bandas = Dominio::where('dominio','BANDA')->pluck('significado','id')->all();  
         $estados = Dominio::where('dominio','Estado')->pluck('significado','codigo')->all();  
        
         return view('animais.create',compact('animal','racas','gaiolas', 'bandas', 'estados'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimalRequest $request)
    {
        
         $animal = Animal::create($request->all());

        session()->flash('flash_message','Animal successfully added.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $animal;
        }else{             
             return redirect('animais');            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($animal)
    {
         $animal = Animal::find($animal);

         $gaiolas = Gaiola::pluck('descricao','id')->all();
         $racas = Raca::pluck('descricao','id')->all();
         $bandas = Dominio::where('dominio','BANDA')->pluck('significado','id')->all();  
         $estados = Dominio::where('dominio','Estado')->pluck('significado','codigo')->all();  
        return view('animais.edit',compact('animal','racas','gaiolas', 'bandas', 'estados'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnimalRequest $request,  $animal)
    {
        $animal = Animal::find($animal);

        $animal->update($request->all());
        session()->flash('flash_message','Animal successfully updated.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $animal;
        }else{
            return redirect('animais');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $animal)
    {
        $animal = Animal::find($animal);
        $animal->deleted_at = new DateTime();
        $animal->save();
        //$deleted= $animal->delete();
        session()->flash('flash_message','Animal was removed with success');

        if (Request::wantsJson()){
            return (string) $animal;
        }else{
            return redirect('animais');
        }
    }



}
