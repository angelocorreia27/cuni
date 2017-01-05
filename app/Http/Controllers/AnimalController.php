<?php

namespace App\Http\Controllers;



use App\Http\Requests\AnimalRequest;

use App\Animal;
use App\Fornecedor;
use App\Raca;
use App\Gaiola;
use Request;
use Illuminate\Support\Facades\DB;

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
        $animais= Animal::all();

        print_r($animais);

        if (Request::wantsJson()){
            return $animais;
        }else{
            return view('animais.index',compact('animais'));
        }
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
         $gaiolas = Gaiola::pluck('descricao','id')->all();
         $racas = Raca::pluck('descricao','id')->all();
         $banda =  DB::table('dominio')
         ->where('dominio','BANDA')->get();

         print_r($banda);
         return view('animais.create',compact('animal','fornecedores','racas','gaiolas', 'banda'));
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

        session()->flash('flash_message','Animal successfully added.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $animal;
        }else{             
             return redirect('animais');            
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
        $fornecedores = Fornecedor::pluck('name','id')->all();
         $gaiolas = Gaiola::pluck('descricao','id')->all();
         $racas = Raca::pluck('descricao','id')->all();
        return view('providers.edit',compact('animal','fornecedores','racas','gaiolas'));  
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
        session()->flash('flash_message','Animal successfully updated.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $animal;
        }else{
            return redirect('animais');
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
        session()->flash('flash_message','Animal successfully deleted.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return (string) $deleted;
        }else{
            return redirect()->route('animais.index');
        }
    }
}
