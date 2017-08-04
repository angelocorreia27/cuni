<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
//use Illuminate\Http\Request;

use App\Http\Requests\MaternidadeRequest;

use App\Reproducao;
use App\Maternidade;
use Request;
use Carbon\Carbon;
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
        //$maternidades = Maternidade::all();

         $maternidades =DB::table('maternidade as t1')
                ->join('reproducao as t2', 't1.id_reproducao', '=', 't2.id')
                ->join('animais as t3', 't2.id_matriz', '=', 't3.id')
                ->join('animais as t4', 't2.id_reprodutor', '=', 't4.id')
                ->join('gaiolas as t5', 't3.id_gaiola', '=', 't5.id')
                ->whereNull('t1.data_desmame')           
                ->orderBy('t1.data_prev_desmame', 'asc')
                -> select('t1.id','t1.id_reproducao', 't1.data_parto', 't1.n_vivos', 't1.n_mortos', 't1.data_prev_desmame', 't1.data_prev_cobertura','t2.id_matriz', 't3.tatuagem as tatuf', 't4.tatuagem as tatum', 't5.descricao', DB::raw('(select sum(quantidade) from obito where id_fase = t1.id and tipo_fase="Lactação") as qtd_obito') )->get();
       

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
       
      
      //  $id = magetEdit('2');
       $id_reproducao= Input::get('id_reproducao'); 

        $maternidade->id_reproducao = $id_reproducao;
       $reproducao =DB::table('reproducao as t')
                ->join('animais as t1', 't.id_matriz', '=', 't1.id')
                ->join('animais as t2', 't.id_reprodutor', '=', 't2.id')
                ->where('t.diagnostico', '=','P')
                ->whereNull('t.aborto')
                ->whereNull('t.data_parto')
                ->pluck(DB::raw('CONCAT("Fêmea: ", CONCAT(t1.tatuagem,";   Macho: ",t2.tatuagem)) AS tatu'),'t.id as id_reproducao')->all();

         return view('maternidades.create',compact('maternidade','reproducao')) //->with('id_reproducao',$id_reproducao)
         ;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaternidadeRequest $request)
    {
               
       $data_prev_desmame = Carbon::createFromFormat('Y-m-d', $request->data_parto); 
       $data_prev_desmame->addDays(25);
       
        $data_prev_cobertura = Carbon::createFromFormat('Y-m-d', $request->data_parto); 
        $data_prev_cobertura->addDays(14);
     
        $request->merge(array('data_prev_desmame' => $data_prev_desmame));
        $request->merge(array('data_prev_cobertura' => $data_prev_cobertura));

        $maternidade = Maternidade::create($request->all());
        $reproducao = Reproducao::find($request->id_reproducao);
        $reproducao->data_parto = $request->data_parto;
         $reproducao->update();

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
                ->where('t.diagnostico', '=','P')
                ->whereNull('aborto')
                ->pluck(DB::raw('CONCAT("Fêmea: ", CONCAT(t1.tatuagem,";   Macho: ",t2.tatuagem)) AS tatu'),'t.id as id_reproducao')->all();
         
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

        $data_prev_desmame = Carbon::createFromFormat('Y-m-d', $request->data_parto); 
        $data_prev_desmame->addDays(25);
       
        $data_prev_cobertura = Carbon::createFromFormat('Y-m-d', $request->data_parto); 
        $data_prev_cobertura->addDays(14);
     
        $request->merge(array('data_prev_desmame' => $data_prev_desmame));
        $request->merge(array('data_prev_cobertura' => $data_prev_cobertura));

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

    public function getEdit($id){
    return $id;
}


}
