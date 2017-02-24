<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\RacaRequest;

use App\Raca;

use Request;

class RacaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $racas = Raca::all();
        return view('racas.index',compact('racas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('racas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RacaRequest $request)
    {
        $article = Raca::create($request->all());
        session()->flash('flash_message','Raca was stored with success');

        if (Request::wantsJson()){
            return $raca;
        }else{
            return redirect('racas');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Raca $raca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Raca $raca)
    {
        return view('racas.edit',compact('raca'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RacaRequest $request, Raca $raca)
    {
        $raca->update($request->all());
        session()->flash('flash_message','Raça was update with success');

        if (Request::wantsJson()){
            return $raca;
        }else{
            return redirect('racas');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Raca $raca)
    {
        $deleted= $raca->delete();
        session()->flash('flash_message','Raça was removed with success');

        if (Request::wantsJson()){
            return (string) $deleted;
        }else{
            return redirect('racas');
        }
    }
}
