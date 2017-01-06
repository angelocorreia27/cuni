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


class CuniculaController extends Controller
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
        $cuniculas= Animal::all();

        //print_r($cuniculas);

        if (Request::wantsJson()){
            return $cuniculas;
        }else{
            return view('cuniculas.index',compact('cuniculas'));
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
         

         return view('cuniculas.create',compact('animal','racas','gaiolas', 'bandas'));
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
             return redirect('cuniculas');            
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
         
        return view('cuniculas.edit',compact('animal','racas','gaiolas', 'bandas'));  
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
            return redirect('cuniculas');
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
            return redirect('cuniculas');
        }
    }
}
