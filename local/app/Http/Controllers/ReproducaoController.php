<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;

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
use Illuminate\Support\Facades\Validator;

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
       //$animais = Animais::All();
        
        //$reprodutores = Reproducao::whereNull('aborto')->whereNull('data_parto')->orderBy('prev_parto', 'asc')->get();
        $dt = Carbon::now()->subDays(50); 
        $reprodutores =DB::table('reproducao as t1')
                ->join('animais as t3', 't1.id_matriz', '=', 't3.id')
                ->join('animais as t4', 't1.id_reprodutor', '=', 't4.id')
                ->where('t3.estado', '=', 'Activo')
                ->whereNull('t1.aborto')
                ->whereNull('t1.data_parto')
                ->where('t1.data_cobertura', '>=', $dt)
                ->select('t1.id','t1.id_matriz', 't1.diagnostico','t1.data_parto', 't1.data_cobertura', 't1.prev_parto', 't3.tatuagem as tatuf',
                 't4.tatuagem as tatum')
                ->orderBy('data_cobertura', 'desc')
                ->get();

        
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
         $dt1 = Carbon::now()->subDays(150);
         $reproducao = new Reproducao();
         $reprodutor = Animal::where('sexo','1')
         ->where('data_nascimento', '<=', $dt1)
         ->pluck('tatuagem','id')->all();   
         $matrizes = Animal::where('sexo','0')->pluck('tatuagem','id')->all();     

        $id_matriz= Input::get('id_matriz'); 

         $reproducao->id_matriz= $id_matriz;
         
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
       $input = Input::all();
       $reproducao = new Reproducao();
       
       $reproducao->data_cobertura    =$request->data_cobertura;
       $reproducao->id_matriz    =$request->id_matriz; 
       $reproducao->id_reprodutor    =$request->id_reprodutor;
       
       $prev_parto = Carbon::createFromFormat('Y-m-d', $request->data_cobertura); 
       // considerar todos com ciclo de 31 dias
       $prev_parto->addDays(32);
       $reproducao->prev_parto = $prev_parto; 

      $messages = [
    'data_cobertura.unique' => 'Cobertura já realizada!',
];
      $validation = Validator::make($input, Reproducao::rolesReproducao($reproducao->id, $reproducao->id_matriz), $messages);
        
        if ($validation->passes())
        {
            if ( $reproducao->save() ){          
               session()->flash('flash_message','Cobrição successfully added.'); //<--FLASH MESSAGE
               return redirect('reproducao'); 
            }
        }
        
        return redirect('reproducao/create')->withInput()->withErrors($validation); 
                
      
       /*
       if ( $reproducao->save() ){          
           session()->flash('flash_message','Cobrição successfully added.'); //<--FLASH MESSAGE
           return redirect('reproducao'); 
       }
       else{

            session()->flash('flash_message','Failed saved the Cobrição.'); //<--FLASH MESSAGE
            return redirect('reproducao'); 
       }
       */

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
          $reproducao = Reproducao::find($id);
          $this->layout->content = View::make('reproducao.show')->with('reproducao', $reproducao);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($reproducao)
    {
        //print_r(expression)
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
       // Os marcados para abate, se o ultimo diagnostico for positivo coloca activo de novo

       $matriz= Animal::find($request->id_matriz);
       $reprodutor = Animal::find($request->id_reprodutor);
       
       if($request->diagnostico =='P'){
        $matriz->estado = 'Activo';
        $matriz->update();
       }else{

        $data_cobertura = Carbon::now()->subDays(33);
        // Femeas
        $repCount =DB::table('reproducao as t1')
                    ->where('id_matriz', '=', $request->id_matriz)
                    ->where('diagnostico', '=', 'N')
                    ->where('data_cobertura', '>=',$data_cobertura)
                    ->get()->count();
                    
      if($repCount >=3){
        $matriz->estado = 'MAbate';
        $matriz->update();
      }
      //Machos

      $repCount =DB::table('reproducao as t1')
                    ->where('id_matriz', '=', $request->id_reprodutor)
                    ->where('diagnostico', '=', 'N')
                    ->where('data_cobertura', '>=',$data_cobertura)
                    ->get()->count();
                    
      if($repCount >=4){
        $reprodutor->estado = 'MAbate';
        $reprodutor->update();
      }

       }
        
       if ( $reproducao->update() ){          
           session()->flash('flash_message','Cobrição successfully updated.'); //<--FLASH MESSAGE
           return redirect('reproducao'); 
       }
       else{

            session()->flash('flash_message','Failed updated the Cobrição.'); //<--FLASH MESSAGE
            return redirect('reproducao'); 
       }
      

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
