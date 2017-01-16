<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReposicaoRequest;
use Request;
use App\Gaiola;
use App\Maternidade;
use App\Reposicao;
//use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReposicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reposicoes= Reposicao::all();
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
        $reposicao = new Reposicao();
        $gaiolas = Gaiola::pluck('descricao','id')->all(); 
        $maternidades = Maternidade::pluck('id','id')->all();         

         return view('reposicoes.create',compact('reposicao','gaiolas','maternidades'));
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
        $maternidades = Maternidade::pluck('id','id')->all();         
         
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
