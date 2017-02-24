<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests\AbateRequest;

use App\Abate;
use App\Gaiola;
use App\Animal;
use Request;

use DateTime;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class AbateController extends Controller
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
        $abates= Abate::all();

        if (Request::wantsJson()){
            return $abates;
        }else{
            return view('abates.index',compact('abates'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $Abate = new Abate();
         $gaiolas = Gaiola::pluck('descricao','id')->all();
         $reprodutor = Animal::where('sexo','1')->where('tipo_uso','Abate')->pluck('tatuagem','id')->all();   
         $matrizes = Animal::where('sexo','0')->where('tipo_uso','Abate')->pluck('tatuagem','id')->all();     
         

         return view('abates.create',compact('Abate','reprodutor','gaiolas', 'matrizes'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AbateRequest $request)
    {
        
         $Abate = Abate::create($request->all());

        session()->flash('flash_message','Abate successfully added.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $Abate;
        }else{             
             return redirect('abates');            
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
    public function edit($Abate)
    {
        $Abate = Abate::find($Abate);

        $gaiolas = Gaiola::pluck('descricao','id')->all();
        $reprodutor = Animal::where('sexo','1')->where('tipo_uso','Abate')->pluck('tatuagem','id')->all();   
        $matrizes = Animal::where('sexo','0')->where('tipo_uso','Abate')->pluck('tatuagem','id')->all();   
         
        return view('abates.edit',compact('Abate','reprodutor','gaiolas', 'matrizes'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AbateRequest $request,  $Abate)
    {
        $Abate = Abate::find($Abate);

        $Abate->update($request->all());
        session()->flash('flash_message','Abate successfully updated.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $Abate;
        }else{
            return redirect('abates');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $Abate)
    {
        $Abate = Abate::find($Abate);
        //$Abate->deleted_at = new DateTime();
        $Abate->delete();
        //$deleted= $Abate->delete();
        session()->flash('flash_message','Abate was removed with success');

        if (Request::wantsJson()){
            return (string) $Abate;
        }else{
            return redirect('abates');
        }
    }
}
