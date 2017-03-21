<?php

namespace App\Http\Controllers;


//use Illuminate\Http\Request;

use App\Http\Requests\ReproducaoRequest;

use App\Reproducao;
use App\Animal;
use Request;

use DateTime;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Dominio;

class ReproducaoController extends Controller
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
       // $reprodutores= Reproducao::paginate(10);
        $reprodutores = Reproducao::whereNull('aborto')->whereNull('data_parto')->orderBy('prev_parto', 'asc')->get();

        
        if (Request::wantsJson()){
            return $reprodutores;
        }else{
            return view('reproducao.index',compact('reprodutores'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $reproducao = new Reproducao();
         $reprodutor = Animal::where('sexo','1')->pluck('tatuagem','id')->all();   
         $matrizes = Animal::where('sexo','0')->pluck('tatuagem','id')->all();     

         return view('reproducao.create',compact('reproducao','reprodutor','gaiolas', 'matrizes'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReproducaoRequest $request)
    {
        
       $reproducao = new Reproducao();
       
       $reproducao->data_cobertura    =$request->data_cobertura;
       $reproducao->id_matriz    =$request->id_matriz; 
       $reproducao->id_reprodutor    =$request->id_reprodutor;
       
       $prev_parto = Carbon::createFromFormat('Y-m-d', $request->data_cobertura); 
       // considerar todos com ciclo de 31 dias
       $prev_parto->addDays(31);
       $reproducao->prev_parto = $prev_parto; 

        
       if ( $reproducao->save() ){          
           session()->flash('flash_message','Cobrição successfully added.'); //<--FLASH MESSAGE
           return redirect('reproducao'); 
       }
       else{

            session()->flash('flash_message','Failed saved the Cobrição.'); //<--FLASH MESSAGE
            return redirect('reproducao'); 
       }

       /* 
        $Reproducao = Reproducao::create($reproducao->all());
        session()->flash('flash_message','Cobrição successfully added.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $Reproducao;
        }else{             
             return redirect('reproducao');            
        }
        */
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
          //$matrizes = Animal::find($id);
          //$this->layout->content = View::make('animal.show')->with('matrizes', $matrizes);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($reproducao)
    {
        $reproducao = Reproducao::find($reproducao);

        $reprodutor = Animal::where('sexo','1')->pluck('tatuagem','id')->all();   
        $matrizes = Animal::where('sexo','0')->pluck('tatuagem','id')->all();   
        $abortos = Dominio::where('dominio','SimNao')->pluck('significado','id')->all();   
        return view('reproducao.edit',compact('reproducao','reprodutor','gaiolas', 'matrizes', 'abortos'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReproducaoRequest $request,  $reproducao)
    {
        $reproducao = Reproducao::find($reproducao);

        
       $reproducao->data_cobertura    =$request->data_cobertura;
       $reproducao->id_matriz    =$request->id_matriz; 
       $reproducao->id_reprodutor    =$request->id_reprodutor;
       
       $prev_parto = Carbon::createFromFormat('Y-m-d', $request->data_cobertura); 
       // considerar todos com ciclo de 31 dias
       $prev_parto->addDays(31);
       $reproducao->prev_parto = $prev_parto; 
       $reproducao->aborto = $request->aborto;
       if ($request->data_parto !=null){
          $reproducao->data_parto =$request->data_parto;
        }
       $reproducao->diagnostico =$request->diagnostico;
       
        
       if ( $reproducao->update() ){          
           session()->flash('flash_message','Cobrição successfully updated.'); //<--FLASH MESSAGE
           return redirect('reproducao'); 
       }
       else{

            session()->flash('flash_message','Failed updated the Cobrição.'); //<--FLASH MESSAGE
            return redirect('reproducao'); 
       }

        /*
        $reproducao->update($request->all());
        session()->flash('flash_message','Reproducao successfully updated.'); //<--FLASH MESSAGE

        if (Request::wantsJson()){
            return $reproducao;
        }else{
            return redirect('reproducao');
        }*/

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $reproducao)
    {
        $reproducao = Reproducao::find($reproducao);
        //$Reproducao->deleted_at = new DateTime();
        $reproducao->delete();
        //$deleted= $Reproducao->delete();
        session()->flash('flash_message','Reproducao was removed with success');

        if (Request::wantsJson()){
            return (string) $reproducao;
        }else{
            return redirect('reproducao');
        }
    }
}
