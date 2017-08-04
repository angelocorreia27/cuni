<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests\MaternidadeRequest;

use App\Gaiola;
use App\Maternidade;
use Request;
use Carbon\Carbon;
use DateTime;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ListaDesmameController extends Controller
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
      
        $gaiolas= Gaiola::all();
        $dt = Carbon::now();
        $maternidades =DB::table('maternidade as t1')
                ->join('reproducao as t2', 't1.id_reproducao', '=', 't2.id')
                ->join('animais as t3', 't2.id_matriz', '=', 't3.id')
                ->join('animais as t4', 't2.id_reprodutor', '=', 't4.id')
                ->join('gaiolas as t5', 't3.id_gaiola', '=', 't5.id')
                ->whereNull('t1.data_desmame') 
                ->where('t1.data_prev_desmame', '<=', $dt) 
                -> select('t1.id','t1.data_parto', 't1.n_vivos', 't1.n_mortos', 't1.data_prev_desmame', 't1.data_prev_cobertura', 't2.id_matriz', 't3.tatuagem as tatuf', 't4.tatuagem as tatum' ,'t5.descricao', DB::raw('(select sum(quantidade) from obito where id_fase = t1.id and tipo_fase="Lactação") as qtd_obito'))
                ->orderBy('data_prev_desmame', 'asc')->get();

        if (Request::wantsJson()){
            return $maternidaes;
        }else{
            return view('lista_desmame.index',compact('maternidades','gaiolas'));
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
         $gaiolas = Gaiola::pluck('descricao','id')->all();         

         return view('maternidades.create',compact('maternidade','gaiolas'));
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

        $gaiolas = Gaiola::pluck('descricao','id')->all();
         
        return view('maternidades.edit',compact('maternidade','gaiolas'));  
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
}
