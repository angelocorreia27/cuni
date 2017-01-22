<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\EngordaRequest;

use App\Engorda;

use Request;

class EngordaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $engordas  = Engorda::all();
        return view('engordas.index',compact('engordas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('engordas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EngordaRequest $request)
    {
         $engorda = Engorda::create($request->all());
        session()->flash('flash_message','Engorda was stored with success');

        if (Request::wantsJson()){
            return $engorda;
        }else{
            return redirect('engordas');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Engorda $engorda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Engorda $engorda)
    {
        return view('engordas.edit',compact('engorda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EngordaRequest $request, Engorda $engorda)
    {
        $engorda->update($request->all());
        session()->flash('flash_message','Engorda was update with success');

        if (Request::wantsJson()){
            return $engorda;
        }else{
            return redirect('engordas');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Engorda $engorda)
    {
        $deleted= $engorda->delete();
        session()->flash('flash_message','Engorda was removed with success');

        if (Request::wantsJson()){
            return (string) $deleted;
        }else{
            return redirect('engordas');
        }
    }
}
