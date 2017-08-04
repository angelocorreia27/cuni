<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObitoRequest;

use App\Obito;
use App\Animal;
use App\Maternidade;
use App\Reproducao;
use App\Engorda;
use App\Gaiola;
use Request;
use Illuminate\Support\Facades\DB;
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
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $obitos= Obito::orderBy('obito.data', 'desc')
                ->get();

        foreach ($obitos as $key => $obito) {
            if ($obito->tipo_fase =='Reprodução') {
                $animal = Animal::find($obito->id_fase);
                $obitos[$key]['id_fase'] = $animal->tatuagem;
            }
            if ($obito->tipo_fase =='Lactação') {
                $maternidade = Maternidade::find($obito->id_fase);
                if($maternidade) {
                    $reproducao = Reproducao::find($maternidade->id_reproducao);
                    if($reproducao){
                        $animal = Animal::find($reproducao->id_matriz);
                        if ($animal){
                            $obitos[$key]['id_fase'] = $animal->tatuagem;
                        }
                    }
                
                }


            }
            if ($obito->tipo_fase =='Engorda') {
                $engorda = Engorda::find($obito->id_fase);
                if($engorda) {
                    $gaiola = Gaiola::find($engorda->id_gaiola);                   
                    $obitos[$key]['id_fase'] = $gaiola->descricao; 
                }

            }
        }

        
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
        /**

        $animal = DB::table('animais')
                        ->wherein('animais.estado', array('Activo', 'MAbate'))
                        ->orderby('animais.tatuagem', 'asc')
                 ->pluck(DB::raw('CONCAT("Sexo: ", " ", animais.sexo, animais.tatuagem) AS tatuagem'), 'animais.id')
                 ->all();
        **/
         $animal = Animal::wherein('estado', array('Activo', 'MAbate'))
                        ->orderby('tatuagem', 'asc')
                 ->pluck('tatuagem','id')
                 ->all();
             
        $maternidades =Maternidade::whereNull('data_desmame') 
                ->join('reproducao as t2', 'id_reproducao', '=', 't2.id')
                ->join('animais as t3', 't2.id_matriz', '=', 't3.id')
                ->pluck('t3.tatuagem','maternidade.id')->all();

         $engordas  = DB::table('engorda as e')
                    ->whereNull('e.data_saida')
                    ->join('gaiolas as g', 'e.id_gaiola', '=', 'g.id')
                    ->orderBy('e.data_entrada', 'asc')
                    ->pluck(DB::raw('CONCAT(g.descricao,"  -  ", e.data_entrada) as descricao','e.id'))

                    ->all();

         return view('obitos.create',compact('obitos','animal', 'maternidades', 'engordas'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ObitoRequest $request)
    {
        

         if (isset($request->id_animal) && $request->id_animal != null){
            $id_fase = $request->id_animal;
            $tipo_fase = 'Reprodução';

        }elseif (isset($request->id_maternidade) && $request->id_maternidade != null) {
             $id_fase = $request->id_maternidade;
             $tipo_fase = 'Lactação';
        }elseif (isset($request->id_engorda) && $request->id_engorda != null) {
            $id_fase = $request->id_engorda;
            $tipo_fase = 'Engorda';
        }

        $request->merge(array('id_fase' => $id_fase));
         $request->merge(array('tipo_fase' => $tipo_fase));
         $obitos = Obito::create($request->all());

        if (isset($request->id_animal) && $request->id_animal != null){
            // update animal
            $animal= Animal::find($request->id_animal);

            if($animal) {
                $animal->estado = 'Obito';
                $animal->save();
            }

        }

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
          $animal = Animal::where('estado', 'Activo')
                        ->orderby('tatuagem', 'asc')
                 ->pluck('tatuagem','id')
                 ->all();
             
        $maternidades =Maternidade::whereNull('data_desmame') 
                ->join('reproducao as t2', 'id_reproducao', '=', 't2.id')
                ->join('animais as t3', 't2.id_matriz', '=', 't3.id')
                ->pluck('t3.tatuagem','maternidade.id')->all();

        $engordas  = Engorda::whereNull('data_saida')
                    ->join('gaiolas', 'id_gaiola', '=', 'gaiolas.id')
                    ->pluck('gaiolas.descricao','engorda.id')
                    ->all();
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
