<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\AbateRequest;

use App\Abate;
use App\Engorda;
use App\Animal;
use Request;
use Carbon\Carbon;
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
         $abates = new Abate();
         $engordas  = DB::table('engorda as e')
                    ->whereNull('e.data_saida')
                    ->join('gaiolas as g', 'e.id_gaiola', '=', 'g.id')
                    ->orderBy('e.data_entrada', 'asc')
                    ->pluck(DB::raw('CONCAT(g.descricao, " - ", e.data_entrada, " - ", "(",e.quantidade,")") AS descricao'),'e.id')
                    ->all();
                
         $abates->id_engorda = Input::get('id_engorda');
         $animais = Animal::wherein('estado', array('Activo', 'MAbate'))->pluck('tatuagem', 'id')->all();  
            
         return view('abates.create',compact('abates','animais', 'engordas'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AbateRequest $request)
    {
        
        //$abates = Abate::create($request->all());
        $abates = New Abate();

        $abates->data_abate = $request->data_abate;

        if (isset($request->id_engorda) && ($request->id_engorda !=null)){
        $abates->id_engorda = $request->id_engorda;
        }

        if (isset($request->id_animal) && ($request->id_animal !=null)){
        $abates->id_animal = $request->id_animal;
        }

        if ( $abates->save() ){          
               session()->flash('flash_message','Abate successfully added.'); //<--FLASH MESSAGE
               //return redirect('reproducao'); 
            }

        // Update estado animal
        if (isset($request->id_animal) && ($request->id_animal !=null)){

            $animal=Animal::find($request->id_animal);
        $animal->estado = 'Abate';
        $animal->update();
        }
        

        // Update data_saida engorda
        if (isset($abates->id_engorda) && ($abates->id_engorda !=null)){
        $engorda=Engorda::find($abates->id_engorda);
        $engorda->data_saida = Carbon::now();
        $engorda->update();
        }

        //session()->flash('flash_message','Abate successfully added.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $abates;
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
    public function edit($abate)
    {

        $abates = Abate::find($abate);

        $animais = Animal::where('estado','Activo')->pluck('tatuagem', 'id')->all(); 
            
        $engordas  = Engorda::whereNull('data_saida')
                    ->join('gaiolas', 'id_gaiola', '=', 'gaiolas.id')
                    ->pluck('gaiolas.descricao','engorda.id')->all();    
         
        return view('abates.edit',compact('abates','animais', 'engordas'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AbateRequest $request,  $abate)
    {
        
        $abates = Abate::find($abate);

        $abates->update($request->all());
        
        session()->flash('flash_message','Abate successfully updated.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $abates;
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
    public function destroy( $abate)
    {
        $abates = Abate::find($abate);
        //$Abate->deleted_at = new DateTime();
        $abates->delete();
        //$deleted= $Abate->delete();
        session()->flash('flash_message','Abate was removed with success');

        if (Request::wantsJson()){
            return (string) $abates;
        }else{
            return redirect('abates');
        }
    }
}
