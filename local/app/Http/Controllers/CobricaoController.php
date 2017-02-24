<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Animal;
use App\Dominio;

class CobricaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animais= Animal::all();

        $bandas = Dominio::all()->where('dominio','BANDA');     

        $reprodutores = Animal::all()->where('sexo','1')->where('tipo_uso','Reproducao');   
        $matrizes = Animal::all()->where('sexo','0')->where('tipo_uso','Reproducao');  
        
        //SELECT count(*) FROM animais WHERE sexo = 1 GROUP by(id_banda) order by 1 DESC LIMIT 1

        $max_reprodutores = Animal::where('sexo',1)
                            ->groupBy('id_banda')
                            ->orderBy(DB::raw("COUNT(*)"),'desc')
                            ->count();

        $max_matrizes = Animal::where('sexo',0)
                            ->groupBy('id_banda')
                            ->orderBy(DB::raw("COUNT(*)"),'desc')
                            ->count();
        /*$max_reprodutores = DB::select(DB::raw('select count(*) from animais where sexo = 1 and animais.deleted_at is null group by id_banda order by COUNT(*) desc limit 1'));*/

        if (Request::wantsJson()){
            return $animais;
        }else{
            return view('cobricoes.index',compact('animais','bandas','reprodutores','matrizes','max_reprodutores','max_matrizes'));
        }
    }


    public function getBanda(){
        $bandas = Dominio::all()->where('dominio','BANDA');  
        return $bandas;
    }

    public function getListTatuagem($sexo, $banda){
        $reprodutores = Animal::where('sexo',$sexo)
                      ->where('tipo_uso','Reproducao')
                      ->where('id_banda',$banda)
                      ->get();   
        return $reprodutores;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
