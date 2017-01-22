<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObitoRequest;

use App\Obito;
use Request;

use DateTime;
//
//use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\DB;


class ObitoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obitos= Obito::all();

        return view('obitos.index',compact('obitos'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $obitos = new Obito();         

         return view('obitos.create',compact('id_fase','tipo_fase'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ObitoRequest $request)
    {
        
         $obitos = Obito::create($request->all());

        session()->flash('flash_message','Obito successfully added.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $obitos;
        }else{             
             return redirect('obitos');            
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
    public function edit($obitos)
    {
         $obitos = Obito::find($obitos);
         
        return view('obitos.edit',compact('obitos'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ObitoRequest $request,  $obitos)
    {
        $obitos= Obito::find($obitos);

        $obitos->update($request->all());
        session()->flash('flash_message','Obito successfully updated.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $obitos;
        }else{
            return redirect('obitos');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $obitos)
    {
        $obitos = obito::find($obitos);
        $obitos->deleted_at = new DateTime();
        $obitos->save();
        //$deleted= $Obito->delete();
        session()->flash('flash_message','Obito was removed with success');

        if (Request::wantsJson()){
            return (string) $obitos;
        }else{
            return redirect('obitos');
        }
    }
}
