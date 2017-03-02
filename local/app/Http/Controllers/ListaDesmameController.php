<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests\MaternidadeRequest;

use App\Gaiola;
use App\Maternidade;
use Request;

use DateTime;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ListaDesmameController extends Controller
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
        //$maternidades= Maternidade::all();
        $maternidades = Maternidade::whereNull('data_desmame')->orderBy('data_prev_desmame', 'asc')->get();
        
        $gaiolas= Gaiola::all();


        if (Request::wantsJson()){
            return $maternidaes;
        }else{
            return view('maternidades.index',compact('maternidades','gaiolas'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $maternidade = new Maternidade();
         $gaiolas = Gaiola::pluck('descricao','id')->all();         

         return view('maternidades.create',compact('maternidade','gaiolas'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaternidadeRequest $request)
    {
        
         $maternidade = Maternidade::create($request->all());

        session()->flash('flash_message','Maternidade successfully added.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $maternidade;
        }else{             
             return redirect('maternidades');            
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
    public function edit(Maternidade $maternidade)
    {
         //$maternidade = Maternidade::find($maternidade);

        $gaiolas = Gaiola::pluck('descricao','id')->all();
         
        return view('maternidades.edit',compact('maternidade','gaiolas'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MaternidadeRequest $request,  Maternidade $maternidade)
    {

        $maternidade->update($request->all());
        session()->flash('flash_message','Maternidade successfully updated.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $maternidade;
        }else{
            return redirect('maternidades');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maternidade $maternidade)
    {
       
       //// $maternidade->deleted_at = new DateTime();
        //$maternidade->save();
        $deleted= $maternidade->delete();
        session()->flash('flash_message','Maternidade was removed with success');

        if (Request::wantsJson()){
            return (string) $deleted;
        }else{
            return redirect('maternidades');
        }
    }
}
