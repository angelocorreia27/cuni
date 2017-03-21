<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests\MaternidadeRequest;

use App\Reproducao;
use App\Maternidade;
use Request;

use DateTime;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class MaternidadeController extends Controller
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
        $maternidades = Maternidade::all();

        /*
        $maternidades =DB::table('maternidade as t1')
                ->join('reproducao as t2', 't1.id_reproducao', '=', 't2.id')
                ->join('animais as t3', 't2.id_matriz', '=', 't3.id')
                ->join('animais as t4', 't2.id_reprodutor', '=', 't4.id')

                ->pluck(DB::raw('CONCAT("Fêmea: ", CONCAT(t3.tatuagem,";   Macho: ",t4.tatuagem)) AS tatu'),
                    't1.id')->all();
        */

        /*
        ->pluck(DB::raw('CONCAT("Fêmea: ", CONCAT(t3.tatuagem,";   Macho: ",t4.tatuagem)) AS tatu'),
                    't1.id', 't1.data_parto', 't1.n_vivos', 't1.n_mortos', 't1.data_prev_desmame', 't1.data_prev_cobertura')->all();

        $gaiola =DB::table('reproducao as t')
                ->join('animais as t1', 't.id_matriz', '=', 't1.id')
                ->join('gaiola as t2', 't1.id_gaiola', '=', 't2.id')
                ->select('t2.id')->get();
        */

        if (Request::wantsJson()){
            return $maternidaes;
        }else{
            return view('maternidades.index',compact('maternidades'));
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
       

       $reproducao =DB::table('reproducao as t')
                ->join('animais as t1', 't.id_matriz', '=', 't1.id')
                ->join('animais as t2', 't.id_reprodutor', '=', 't2.id')
                ->pluck(DB::raw('CONCAT("Fêmea: ", CONCAT(t1.tatuagem,";   Macho: ",t2.tatuagem)) AS tatu'),'t.id_reprodutor')->all();

         return view('maternidades.create',compact('maternidade','reproducao'));
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

       $reproducao =DB::table('reproducao as t')
                ->join('animais as t1', 't.id_matriz', '=', 't1.id')
                ->join('animais as t2', 't.id_reprodutor', '=', 't2.id')
                ->pluck(DB::raw('CONCAT("Fêmea: ", CONCAT(t1.tatuagem,";   Macho: ",t2.tatuagem)) AS tatu'),'t.id_reprodutor')->all();
         
        return view('maternidades.edit',compact('maternidade','reproducao'));  
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

    public function tatu( int $rep){

             $tatuagem =DB::table('reproducao as t')
                ->join('animais as t1', 't.id_matriz', '=', 't1.id')
                ->join('animais as t2', 't.id_reprodutor', '=', 't2.id')
                ->where('t.id', '=', 'rep')
                ->select(DB::raw('CONCAT("Fêmea: ", CONCAT(t1.tatuagem,";   Macho: ",t2.tatuagem)) AS tatu'))->get();
                
            return $tatuagem;
    }

}
