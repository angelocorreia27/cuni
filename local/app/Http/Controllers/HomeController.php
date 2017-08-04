<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;
use App\Animal;
use Illuminate\Support\Facades\Input;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
       
        $dtF = Carbon::now();
        $dtI = Carbon::now()->subdays(30);
        $dt1 = Carbon::now()->subDays(120);
       // print_r($dtI);
       // print_r($dtI->format('Y-m-d'));
        $charts = Input::get('charts');   
        if ($charts ==null)     {
            $charts='PG';
        }

        if ($charts =='PD'){
            $engordas = DB::table('engorda')
                         ->select(DB::raw('sum(engorda.quantidade) as total, engorda.data_entrada'))
                         ->whereNull('engorda.data_saida')
                         ->groupBy('engorda.data_entrada')
                         ->get();

            // Declarações
                         
            $lava = new Lavacharts; // See note below for Laravel
            $population = $lava->DataTable();
            
            // Atribuições de valores
            $population->addDateColumn('Date')
                       ->addNumberColumn('Número de desmame');

                       
            foreach ($engordas as $key) {
                $population->addRow([$key->data_entrada, $key->total]);
            }

            $lava->AreaChart('Population', $population, [
                'title' => 'Performance de desmame',
                'legend' => [
                    'position' => 'in'
                ]
            ]);
        }
          // Performance diagnostico gestão
        if ($charts =='PG'){
        $lavaDiag = new Lavacharts; // See note below for Laravel

        $diagnosticos = $lavaDiag->DataTable();

        $reproducao= DB::table('reproducao as t')
                  ->select('t.data_cobertura', 
                          DB::raw('(select count(*) from reproducao t1 where t1.diagnostico = "P" and t.data_cobertura =t1.data_cobertura ) as totalP, 
                            (select count(*) from reproducao t2 where t2.diagnostico = "N" and t.data_cobertura =t2.data_cobertura ) as totalN'))

                  ->whereNotNull('t.diagnostico')
                  ->where('t.data_cobertura', '<', $dtF)
                  ->where('t.data_cobertura', '>=', $dtI)
                  ->groupby('t.data_cobertura')
                  
            ->get();

        //echo $reproducao->toSql();
        //print_r($reproducao);
        $diagnosticos-> addDateColumn('Date')
         ->addNumberColumn('Positivo')
         ->addNumberColumn('Negativo')
         ;
          
         foreach ($reproducao as $key => $value) {
            $data = Carbon::createFromFormat('Y-m-d', $value->data_cobertura);
            $diagnosticos->addRow([$data, $value->totalP, $value->totalN]);

         }
          
         $lavaDiag->ColumnChart('Diagnosticos', $diagnosticos, [
                  'title' => 'Performance diagnostico de gestação',
                  'titleTextStyle' => [
                      'color'    => '#eb6b2c',
                      'fontSize' => 14
                  ]
                  ]);
       }

       // Performance fases
       if ($charts =='PF'){
        $lavaFases = new Lavacharts;
        $fases  = $lavaFases->DataTable();
        
        //Matrizez activos
        $mActivo = DB::table('animais')
                     ->where('animais.data_nascimento', '<=', $dt1)
                     ->where('animais.estado', '=', 'Activo')
                     ->where('animais.sexo', '=', '0')
                     ->count();

        // Reprodutores activos
        $rActivo = DB::table('animais')
                     ->where('animais.data_nascimento', '<=', $dt1)
                     ->where('animais.estado', '=', 'Activo')
                     ->where('animais.sexo', '=', '1')
                     ->count();

        // Cobertos
        $dt_cob = Carbon::now()->subDays(17);
        $mCobertos = DB::table('animais')
                    ->where('animais.estado', 'Activo')
                    ->where('animais.sexo', '0')
                    //->where('animais.data_nascimento', '<=', $dt1)
                    ->join('reproducao', 'reproducao.id_matriz', '=', 'animais.id')
                    ->where('reproducao.data_cobertura','>=', $dt_cob)
                    ->whereNull('reproducao.diagnostico')                   
                    ->count();

        // Gestantes
        $dt_cob = Carbon::now()->subDays(47);
        $mGestantes = DB::table('animais')
                    ->where('animais.estado', 'Activo')
                    ->where('animais.sexo', '0')
                    //->where('animais.data_nascimento', '<=', $dt1)
                    ->join('reproducao', 'reproducao.id_matriz', '=', 'animais.id')
                    ->where('reproducao.data_cobertura','>=', $dt_cob)
                    ->where('reproducao.diagnostico', '=', 'P')
                    ->whereNull('reproducao.data_parto')          ->whereNull('reproducao.aborto')
                    ->count();

        // Total engorda

        $tObitos = DB::table('obito')                           
                ->where('obito.tipo_fase', '=', 'Engorda')
                ->join('engorda', 'obito.id_fase', '=', 'engorda.id')
                //->whereNull('engorda.data_saida')
                ->sum('obito.quantidade');

        
        $tEngorda = DB::table('engorda')
                     ->whereNull('engorda.data_saida')
                     ->sum('engorda.quantidade');
        if ($tEngorda == NULL){
            $tEngorda=0;
        }
        if ($tObitos == NULL){
            $tObitos=0;
        }
        $tEngorda = $tEngorda - $tObitos;
        $tLactantes = DB::table('maternidade')
                     ->whereNull('maternidade.data_desmame') 
                     ->count();

        $fases->addStringColumn('Performance fases')
              ->addNumberColumn('Na fase')
              ->addRow(['M activos',  $mActivo])
              ->addRow(['R activos',  $rActivo])
              ->addRow(['Cobertos',  $mCobertos])
              ->addRow(['Gestantes',  $mGestantes])
              ->addRow(['Lactantes', $tLactantes])
              ->addRow(['Engorda',   $tEngorda]);

        $lavaFases->BarChart('fases', $fases);
    }

        // Performance produção ultimos 30 dias

    if ($charts =='PP'){
        $lavaProd = new Lavacharts; // See note below for Laravel

        $prod = $lavaProd->DataTable();

        $total= DB::table('obito as t')
                  ->select('t.tipo_fase', DB::raw('sum(t.quantidade) as totalObito, 
                            (select count(*) from animais t1 where t1.estado = "Activo"
                            and t1.data_nascimento >= "'.$dtI->format('Y-m-d').'"
                            ) as totalAnimais, 
                            (select sum(t2.n_vivos) from maternidade t2 
                             where  t2.data_desmame is null
                             and t2.data_parto >= "'.$dtI->format('Y-m-d'). '"
                            ) as totalVivo,
                            (select sum(quantidade) from engorda as t3
                             where t3.data_saida is null
                             and t3.data_entrada >= "'.$dtI->format('Y-m-d'). '"
                             ) as totalEngorda')
                            )
                  ->where('t.data', '>=', $dtI->format('Y-m-d'))
                  ->groupby('t.tipo_fase')
                  
            ->get();

        //echo $total->toSql();
        //print_r($total);
        $prod-> addStringColumn('String')
         ->addNumberColumn('Produção')
         ->addNumberColumn('Obitos');
          
         foreach ($total as $key => $value) {
         	if ($value->totalObito == null){
            	$value->totalObito=0;
            }

            if ($value->tipo_fase == 'Lactação'){
                $valor= $value->totalVivo;
                $valor= $valor - $value->totalObito;
            }
            if ($value->tipo_fase == 'Engorda'){
                $valor= $value->totalEngorda;
                $valor= $valor - $value->totalObito;

            }
            if ($value->tipo_fase == 'Reprodução'){
                $valor= $value->totalAnimais;
            }

            $prod->addRow([$value->tipo_fase, $valor, $value->totalObito]);

         }
          
         $lavaProd->ColumnChart('prod', $prod, [
                  'title' => 'Performance produção último mês',
                  'titleTextStyle' => [
                      'color'    => '#eb6b2c',
                      'fontSize' => 14
                  ]
                  ]);

     }
        
        return view('home',compact('Population', 'lava', 'Diagnosticos' , 'lavaDiag' ,'fases', 'lavaFases', 'prod', 'lavaProd'))
        ->with('charts',$charts )
        ;
    }
}