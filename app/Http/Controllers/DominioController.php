<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\DominioRequest;

use App\Dominio;

use Request;

class DominioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dominios  = Dominio::all();
        return view('dominios.index',compact('dominios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dominios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DominioRequest $request)
    {
         $dominio = Dominio::create($request->all());
        session()->flash('flash_message','Dominio was stored with success');

        if (Request::wantsJson()){
            return $dominio;
        }else{
            return redirect('dominios');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dominio $dominio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dominio $dominio)
    {
        return view('dominios.edit',compact('dominio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DominioRequest $request, Dominio $dominio)
    {
        $dominio->update($request->all());
        session()->flash('flash_message','Dominio was update with success');

        if (Request::wantsJson()){
            return $dominio;
        }else{
            return redirect('dominios');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dominio $dominio)
    {
        $deleted= $dominio->delete();
        session()->flash('flash_message','Dominio was removed with success');

        if (Request::wantsJson()){
            return (string) $deleted;
        }else{
            return redirect('dominios');
        }
    }
}
