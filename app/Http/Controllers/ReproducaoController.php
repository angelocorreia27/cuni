<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests\ReproducaoRequest;

use App\Reproducao;
use App\Gaiola;
use App\Animal;
use Request;

use DateTime;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ReproducaoController extends Controller
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
        $reprodutores= Reproducao::all();

        if (Request::wantsJson()){
            return $reprodutores;
        }else{
            return view('reprodutores.index',compact('reprodutores'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $reproducao = new Reproducao();
         $gaiolas = Gaiola::pluck('descricao','id')->all();
         $reprodutor = Animal::where('sexo','1')->where('tipo_uso','Reproducao')->pluck('tatuagem','id')->all();   
         $matrizes = Animal::where('sexo','0')->where('tipo_uso','Reproducao')->pluck('tatuagem','id')->all();     
         

         return view('reprodutores.create',compact('reproducao','reprodutor','gaiolas', 'matrizes'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReproducaoRequest $request)
    {
        
         $Reproducao = Reproducao::create($request->all());

        session()->flash('flash_message','Reproducao successfully added.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $Reproducao;
        }else{             
             return redirect('reprodutores');            
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
    public function edit($reproducao)
    {
        $reproducao = Reproducao::find($reproducao);

        $gaiolas = Gaiola::pluck('descricao','id')->all();
        $reprodutor = Animal::where('sexo','1')->where('tipo_uso','Reproducao')->pluck('tatuagem','id')->all();   
        $matrizes = Animal::where('sexo','0')->where('tipo_uso','Reproducao')->pluck('tatuagem','id')->all();   
         
        return view('reprodutores.edit',compact('reproducao','reprodutor','gaiolas', 'matrizes'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReproducaoRequest $request,  $reproducao)
    {
        $reproducao = Reproducao::find($reproducao);

        $reproducao->update($request->all());
        session()->flash('flash_message','Reproducao successfully updated.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $reproducao;
        }else{
            return redirect('reprodutores');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $reproducao)
    {
        $reproducao = Reproducao::find($reproducao);
        //$Reproducao->deleted_at = new DateTime();
        $reproducao->delete();
        //$deleted= $Reproducao->delete();
        session()->flash('flash_message','Reproducao was removed with success');

        if (Request::wantsJson()){
            return (string) $reproducao;
        }else{
            return redirect('reprodutores');
        }
    }
}
