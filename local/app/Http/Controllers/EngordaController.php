<?php

namespace App\Http\Controllers;
use App\Http\Requests\EngordaRequest;
use Illuminate\Support\Facades\Input;
use App\Engorda;
use App\Maternidade;
use App\Gaiola;
use Request;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EngordaController extends Controller
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
        //$engordas  = Engorda::whereNull('data_saida')->get();

        $engordas =DB::table('engorda as t')
                ->join('maternidade as t1', 't.id_maternidade', '=', 't1.id')
                ->join('reproducao as t2', 't1.id_reproducao', '=', 't2.id')
                ->join('animais as t3', 't2.id_matriz', '=', 't3.id')
                ->join('animais as t4', 't2.id_reprodutor', '=', 't4.id')
                ->join('gaiolas as t5', 't.id_gaiola','=', 't5.id')
                ->whereNull('t.data_saida')  
                ->where('t.quantidade','>', 0)         
                ->orderBy('t.data_entrada', 'asc', 't5.codigo', 'asc')
                -> select('t.data_entrada', 't.quantidade', 't.prev_saida', 't5.descricao', 't.id', 't3.tatuagem as tatuf', 't4.tatuagem as tatum',
                DB::raw('(select sum(quantidade) from obito where id_fase = t.id and tipo_fase="Engorda") as qtd_obito')
                )->get();
       
        return view('engordas.index',compact('engordas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $engorda = new Engorda();
        
        $maternidade =DB::table('maternidade as t1')
                ->join('reproducao as t2', 't1.id_reproducao', '=', 't2.id')
                ->join('animais as t3', 't2.id_matriz', '=', 't3.id')
                ->join('animais as t4', 't2.id_reprodutor', '=', 't4.id')
                ->whereNull('t1.data_desmame')
                
                ->pluck(DB::raw('CONCAT("Fêmea: ", CONCAT(t3.tatuagem,";   Macho: ",t4.tatuagem)) AS tatu'),'t1.id')->all();

        $gaiola = Gaiola::pluck('descricao','id')->all();
     
        $engorda->id_maternidade = Input::get('id_maternidade'); 
        return view('engordas.create', compact('engorda', 'maternidade', 'gaiola'));
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
        $maternidade = Maternidade::find($request->id_maternidade);
        $maternidade->data_desmame = Carbon::createFromFormat('Y-m-d', $request->data_entrada); 
        //$maternidade->data_desmame = $request->data_desmame;
         $maternidade->update();

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
    public function edit($engorda)
    {
        $engorda = Engorda::find($engorda);
        
        $maternidade =DB::table('maternidade as t1')
                ->join('reproducao as t2', 't1.id_reproducao', '=', 't2.id')
                ->join('animais as t3', 't2.id_matriz', '=', 't3.id')
                ->join('animais as t4', 't2.id_reprodutor', '=', 't4.id')
                ->whereNull('t1.data_desmame')
                
                ->pluck(DB::raw('CONCAT("Fêmea: ", CONCAT(t3.tatuagem,";   Macho: ",t4.tatuagem)) AS tatu'),'t1.id')->all();

        $gaiola = Gaiola::pluck('descricao','id')->all();

        return view('engordas.edit',compact('engorda', 'maternidade', 'gaiola'));
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

    public function get_qtdObito(int $id){

        $qtd = DB::table('obito as t')
                        ->select(DB::raw('sum(t.quantidade) as total'))
                        ->join('engorda as t2', 't.id_fase', '=','t2.id')
                        ->where('t2.tipo_fase', '=', 'Engorda')
                        ->where('t2.id', '=', $id);

        return $qtd;
    }
}
