<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\GaiolaRequest;

use App\Gaiola;

use Request;

class GaiolaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $gaiolas  = Gaiola::all();
        return view('gaiolas.index',compact('gaiolas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gaiolas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GaiolaRequest $request)
    {
         $gaiola = Gaiola::create($request->all());
        session()->flash('flash_message','Gaiola was stored with success');

        if (Request::wantsJson()){
            return $gaiola;
        }else{
            return redirect('gaiolas');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gaiola $gaiola)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Gaiola $gaiola)
    {
        return view('gaiolas.edit',compact('gaiola'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GaiolaRequest $request, Gaiola $gaiola)
    {
        $gaiola->update($request->all());
        session()->flash('flash_message','Gaiola was update with success');

        if (Request::wantsJson()){
            return $gaiola;
        }else{
            return redirect('gaiolas');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gaiola $gaiola)
    {
        $deleted= $gaiola->delete();
        session()->flash('flash_message','Gaiola was removed with success');

        if (Request::wantsJson()){
            return (string) $deleted;
        }else{
            return redirect('gaiolas');
        }
    }
}
