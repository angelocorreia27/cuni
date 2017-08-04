<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests\AnimalRequest;
use Illuminate\Support\Facades\Input;
use App\Animal;
use App\Fornecedor;
use App\Raca;
use App\Gaiola;
use App\Dominio;
use App\Reposicao;
use App\Reproducao;
use App\Maternidade;
use Request;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
class AnimalController extends Controller
{
		// use SoftDeletes;
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
       // $animais= Animal::all();

       
        $sexo = Input::get('sexo'); 
        if($sexo ==null){
         $sexo="0";
        }
        $animais = Animal::wherein('estado', array('Activo', 'MAbate'))
        ->where('sexo', '=', $sexo)
        ->get();

        if (Request::wantsJson()){
            return $animais;
        }else{
            return view('animais.index',compact('animais'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $animal = new Animal();
         $gaiolas = Gaiola::pluck('descricao','id')->all();
         $racas = Raca::pluck('descricao','id')->all();
         $bandas = Dominio::where('dominio','BANDA')->pluck('significado','id')->all();  
         $estados = Dominio::where('dominio','Estado')->pluck('significado','codigo')->all();
             
            
         $reposicoes =DB::table('reposicao as t1')
                ->join('maternidade as t2', 't1.id_maternidade', '=','t2.id')
                ->join('reproducao as t3', 't2.id_reproducao', '=','t3.id')
                ->join('animais as t4', 't3.id_matriz', '=', 't4.id')
                ->join('animais as t5', 't3.id_reprodutor', '=', 't5.id')
                ->join('gaiolas as t6', 't4.id_gaiola', '=', 't6.id')
                ->where('t1.quantidade', '>', 0)
                ->pluck(DB::raw('CONCAT("Fêmea: ", CONCAT(t4.tatuagem,";   Macho: ",t5.tatuagem)) AS tatu'),'t1.id')->all();

         return view('animais.create',compact('animal','racas','gaiolas', 'bandas', 'estados', 'reposicoes'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimalRequest $request)
    {   
         $input = Input::all();
         $request->merge(array('estado' => "Activo"));
         
         //$animal = Animal::create($request->all());

        $messages = ['tatuagem.unique' => 'Animal já registado!',];
        $validation = Validator::make($input, Animal::rolesTatuagem($request->id, $request->sexo), $messages);
        
        if ($validation->passes())
        {
            $animal = Animal::create($request->all()); 
        }else{
        
        return redirect('animais/create')->withInput()->withErrors($validation); 
        }

        if(isset($request->id_reposicao) && $request->id_reposicao !='0'){
        $reposicao = Reposicao::find($request->id_reposicao);
        $reposicao->prev_saida = $request->data_entrada; // se nulo preencher com carbodate
        if ($reposicao->quantidade > 0) {
            $reposicao->quantidade = $reposicao->quantidade-1; 
        }
            $reposicao->update();
        }
        
        session()->flash('flash_message','Animal successfully added.'); //<--FLASH MESSAGE
            
        if (Request::wantsJson()){
            return $animal;
        }
        else{             
             return redirect('animais');            
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
    public function edit($animal)
    {
        
         $animal = Animal::find($animal);

         $gaiolas = Gaiola::pluck('descricao','id')->all();
         $racas = Raca::pluck('descricao','id')->all();
         $bandas = Dominio::where('dominio','BANDA')->pluck('significado','id')->all();  
         $estados = Dominio::where('dominio','Estado')->pluck('significado','codigo')->all();  

          $reposicoes =DB::table('reposicao as t1')
                ->join('maternidade as t2', 't1.id_maternidade', '=','t2.id')
                ->join('reproducao as t3', 't2.id_reproducao', '=','t3.id')
                ->join('animais as t4', 't3.id_matriz', '=', 't4.id')
                ->join('animais as t5', 't3.id_reprodutor', '=', 't5.id')
                ->join('gaiolas as t6', 't4.id_gaiola', '=', 't6.id')
                ->pluck(DB::raw('CONCAT("Fêmea: ", CONCAT(t4.tatuagem,";   Macho: ",t5.tatuagem)) AS tatu'),'t1.id')->all();
   
        return view('animais.edit',compact('animal','racas','gaiolas', 'bandas', 'estados', 'reposicoes'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnimalRequest $request,  $animal)
    {
       
        $animal = Animal::find($animal);
        $animal->updated_at = new DateTime();
        
        $animal->update($request->all());
        session()->flash('flash_message','Animal was update with success');

        if (Request::wantsJson()){
            return $animal;
        }else{             
             return redirect('v_femeas');            
        }
      
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $animal)
    {
        $animal = Animal::find($animal);
        $animal->deleted_at = new DateTime();
        $animal->save();
        //$deleted= $animal->delete();
        session()->flash('flash_message','Animal was removed with success');

        if (Request::wantsJson()){
            return (string) $animal;
        }else{
            return redirect('animais');
        }
    }

    public function ficha($id){

       $animal = Animal::find($id);

       /*
       $reproducoes = Reproducao::where('reproducao.id_matriz', '=', $animal->id)
                    ->join('maternidade as t','t.id_reproducao', '=', 'reproducao.id', 'left outer')
                    ->select('reproducao.*', 't.n_vivos', 't.n_mortos')
                    ->orderBy('reproducao.data_cobertura', 'asc')
                    ->get();
        */

        if($animal->sexo == '1'){
            $reproducoes = Reproducao::where('reproducao.id_reprodutor', '=', $animal->id)
                    ->join('maternidade as t','t.id_reproducao', '=', 'reproducao.id', 'left outer')
                    ->join('engorda as e','t.id', '=', 'e.id_maternidade', 'left outer')
                    ->select('reproducao.*', 't.n_vivos', 't.n_mortos', 'e.quantidade')
                    ->orderBy('reproducao.data_cobertura', 'asc')
                    ->get();
        }
        else{
                    $reproducoes = Reproducao::where('reproducao.id_matriz', '=', $animal->id)
                    ->join('maternidade as t','t.id_reproducao', '=', 'reproducao.id', 'left outer')
                    ->join('engorda as e','t.id', '=', 'e.id_maternidade', 'left outer')
                    ->select('reproducao.*', 't.n_vivos', 't.n_mortos', 'e.quantidade')
                    ->orderBy('reproducao.data_cobertura', 'asc')
                    ->get();
        }

        return view('animais.ficha', compact('animal', 'reproducoes'));
    }

    public function marcados_abate()
    {

        $animais = Animal::where('estado', 'MAbate')->get();

        if (Request::wantsJson()){
            return $animais;
        }else{
            return view('animais.marcados_abate',compact('animais'));
        }
    }

    public function m_activo()
    {
       
        $dt1 = Carbon::now()->subDays(150);
        $animais = Animal::wherein('estado', array('Activo', 'MAbate'))
        ->where('sexo', '=', '1')
        ->where('data_nascimento', '<=', $dt1)
        ->get();

        if (Request::wantsJson()){
            return $animais;
        }else{
            return view('animais.index',compact('animais'));
        }
    }

    public function v_femeas()
    {
     
        $animais = Animal::wherein('estado', array('Activo', 'MAbate'))
        ->where('sexo', '=', '0')
        ->wherenull('updated_at')
        ->get();

        if (Request::wantsJson()){
            return $animais;
        }else{
            return view('animais.index',compact('animais'));
        }
    }



}
