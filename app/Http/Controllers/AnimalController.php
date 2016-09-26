<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests\AnimalRequest;
use App\Animal;
use App\Fornecedor;

class AnimalController extends Controller
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
        $animais = Animal::all();
        return view('animais.index',compact('animais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $animal = new Animal();
         $fornecedores = Fornecedor::pluck('name','id')->all();
         return view('animais.create',compact('animal','fornecedores'));
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

        \Session::flash('flash_message','Animal successfully added.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $animal;
        }else{             
             return view('animal.index');             
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
    public function edit(Animal $animal)
    {
        return view('providers.edit',compact('animal'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnimalRequest $request, Animal $animal)
    {
         $animal->update($request->all());
        \Session::flash('flash_message','Animal successfully updated.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $animal;
        }else{
            return redirect()->route('animais.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        $deleted= $animal->delete();
        \Session::flash('flash_message','Animal successfully deleted.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return (string) $deleted;
        }else{
            return redirect()->route('animais.index');
        }
    }
}
