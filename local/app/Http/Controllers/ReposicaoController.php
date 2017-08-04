<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReposicaoRequest;
use Request;
use App\Gaiola;
use App\Maternidade;
use App\Reposicao;
//use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReposicaoController extends Controller
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
        //$reposicoes= Reposicao::all();
       // $ani= Reposicao::all();
        
        $reposicoes =DB::table('reposicao as t1')
                ->join('maternidade as t2', 't1.id_maternidade', '=','t2.id')
                ->join('reproducao as t3', 't2.id_reproducao', '=','t3.id')
                ->join('animais as t4', 't3.id_matriz', '=', 't4.id')
                ->join('animais as t5', 't3.id_reprodutor', '=', 't5.id')
                ->join('gaiolas as t6', 't4.id_gaiola', '=', 't6.id')
                ->where('t1.quantidade', '>', 0)
                //->where('estado', '=', 'Activo')
                ->select('t1.id', 't4.tatuagem as tatuf',
                 't5.tatuagem as tatum', 't1.data_entrada','t1.quantidade', 't6.descricao as gaiola_desc')->get();
        $gaiolas= Gaiola::all();


        if (Request::wantsJson()){
            return $reposicoes;
        }else{
            return view('reposicoes.index',compact('reposicoes','gaiolas'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reposicao = new Reposicao;
        $gaiolas = Gaiola::pluck('descricao','id')->all(); 

         $maternidades =DB::table('maternidade as t1')
                ->join('reproducao as t2', 't1.id_reproducao', '=', 't2.id')
                ->join('animais as t3', 't2.id_matriz', '=', 't3.id')
                ->join('animais as t4', 't2.id_reprodutor', '=', 't4.id')
                //->where('t3.tipo_uso', '=','Reposicao')
                //->where('t4.tipo_uso', '=','Reposicao')
                ->whereNull('t1.data_desmame')
                ->orderBy('t1.data_desmame', 'desc')
                ->pluck(DB::raw('CONCAT("Fêmea: ", CONCAT(t3.tatuagem,";   Macho: ",t4.tatuagem)) AS tatu'),'t1.id')->all();


         return view('reposicoes.create',compact('reposicao', 'gaiolas','maternidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReposicaoRequest $request)
    {
        $reposicao = Reposicao::create($request->all());
         $maternidade = Maternidade::find($request->id_maternidade);
        $maternidade->data_desmame = $request->data_entrada;
         $maternidade->update();
        session()->flash('flash_message','Reposicao successfully added.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $reposicao;
        }else{             
             return redirect('reposicoes');            
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
   public function edit($reposicao)
    {
         $reposicao = Reposicao::find($reposicao);

        $gaiolas = Gaiola::pluck('descricao','id')->all(); 
        $maternidades =DB::table('maternidade as t1')
                ->join('reproducao as t2', 't1.id_reproducao', '=', 't2.id')
                ->join('animais as t3', 't2.id_matriz', '=', 't3.id')
                ->join('animais as t4', 't2.id_reprodutor', '=', 't4.id')
                //->where('t3.tipo_uso', '=','Reposicao')
                //->where('t4.tipo_uso', '=','Reposicao')
                //->whereNull('t1.data_desmame')
                ->orderBy('t1.data_desmame', 'desc')
                ->pluck(DB::raw('CONCAT("Fêmea: ", CONCAT(t3.tatuagem,";   Macho: ",t4.tatuagem)) AS tatu'),'t1.id')->all();
         
        return view('reposicoes.edit',compact('reposicao','gaiolas','maternidades'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReposicaoRequest $request,  $reposicao)
    {
        $reposicao = Reposicao::find($reposicao);
        $reposicao->update($request->all());
        session()->flash('flash_message','Reposicao successfully updated.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $reposicao;
        }else{
            return redirect('reposicoes');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($reposicao)
    {
        $reposicao = Reposicao::find($reposicao);
        $deleted= $reposicao->delete();
        session()->flash('flash_message','Maternidade was removed with success');

        if (Request::wantsJson()){
            return (string) $deleted;
        }else{
            return redirect('reposicoes');
        }
    }
}
