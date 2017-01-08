<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests\MaternidadeRequest;

use App\Raca;
use App\Reproducao;
use Request;

use DateTime;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class MaternidadeController extends Controller
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
        $Maternidades= Maternidade::all();

        //print_r($Maternidades);

        if (Request::wantsJson()){
            return $Maternidades;
        }else{
            return view('Maternidades.index',compact('Maternidades'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $Maternidade = new Maternidade();
         $gaiolas = Gaiola::pluck('descricao','id')->all();
         $racas = Raca::pluck('descricao','id')->all();

         $bandas = Dominio::where('dominio','BANDA')->pluck('significado','id')->all();        
         

         return view('Maternidades.create',compact('Maternidade','racas','gaiolas', 'bandas'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaternidadeRequest $request)
    {
        
         $Maternidade = Maternidade::create($request->all());

        session()->flash('flash_message','Maternidade successfully added.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $Maternidade;
        }else{             
             return redirect('Maternidades');            
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
    public function edit($Maternidade)
    {
         $Maternidade = Maternidade::find($Maternidade);

         $gaiolas = Gaiola::pluck('descricao','id')->all();
         $racas = Raca::pluck('descricao','id')->all();
         $bandas = Dominio::where('dominio','BANDA')->pluck('significado','id')->all();  
         
        return view('Maternidades.edit',compact('Maternidade','racas','gaiolas', 'bandas'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MaternidadeRequest $request,  $Maternidade)
    {
        $Maternidade = Maternidade::find($Maternidade);

        $Maternidade->update($request->all());
        session()->flash('flash_message','Maternidade successfully updated.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $Maternidade;
        }else{
            return redirect('Maternidades');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $Maternidade)
    {
        $Maternidade = Maternidade::find($Maternidade);
        $Maternidade->deleted_at = new DateTime();
        $Maternidade->save();
        //$deleted= $Maternidade->delete();
        session()->flash('flash_message','Maternidade was removed with success');

        if (Request::wantsJson()){
            return (string) $Maternidade;
        }else{
            return redirect('Maternidades');
        }
    }
}
