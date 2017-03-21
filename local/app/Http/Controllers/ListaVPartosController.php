<?php

namespace App\Http\Controllers;


//use Illuminate\Http\Request;

use App\Http\Requests\ReproducaoRequest;

use App\Reproducao;
use App\Gaiola;
use App\Animal;
use Request;

use DateTime;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Dominio;

class ListaVPartosController extends Controller
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
     // $date = date('Y-m-d');
        /*
        $reprodutores = Reproducao::where('diagnostico','P')->whereNull('data_parto')->whereNull('aborto')->where('prev_parto','<=', Carbon::now()->subDays(1))->orderBy('data_cobertura', 'asc')->get();
        */

        $reprodutores =DB::table('reproducao as t1')
                ->join('animais as t3', 't1.id_matriz', '=', 't3.id')
                ->join('animais as t4', 't1.id_reprodutor', '=', 't4.id')
                ->where('diagnostico','P')->whereNull('data_parto')->whereNull('aborto')->where('prev_parto','<=', Carbon::now()->subDays(1))->orderBy('data_cobertura', 'asc')
                ->select('t1.id', 't1.data_cobertura', 't1.prev_parto', 't3.tatuagem as tatuf',
                 't4.tatuagem as tatum')->get();
        
        if (Request::wantsJson()){
            return $reprodutores;
        }else{
            return view('lista_vpartos.index',compact('reprodutores'));
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
         $gaiolas = Gaiola::pluck('descricao','id')->all();
         $reprodutor = Animal::where('sexo','1')->where('tipo_uso','Reproducao')->pluck('tatuagem','id')->all();   
         $matrizes = Animal::where('sexo','0')->where('tipo_uso','Reproducao')->pluck('tatuagem','id')->all();     

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
       $reproducao->id_gaiola    =$request->id_gaiola;
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

        $gaiolas = Gaiola::pluck('descricao','id')->all();
        $reprodutor = Animal::where('sexo','1')->where('tipo_uso','Reproducao')->pluck('tatuagem','id')->all();   
        $matrizes = Animal::where('sexo','0')->where('tipo_uso','Reproducao')->pluck('tatuagem','id')->all();   
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
       $reproducao->id_gaiola    =$request->id_gaiola;
       $reproducao->id_matriz    =$request->id_matriz; 
       $reproducao->id_reprodutor    =$request->id_reprodutor;
       
       $prev_parto = Carbon::createFromFormat('Y-m-d', $request->data_cobertura); 
       // considerar todos com ciclo de 31 dias
       $prev_parto->addDays(31);
       $reproducao->prev_parto = $prev_parto; 
       $reproducao->aborto = $request->aborto;
       $reproducao->data_parto =$request->data_parto;
       //$reproducao->prev_parto =$request->diagnostico;

        
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
