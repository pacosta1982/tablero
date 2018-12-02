<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TABGER01;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //var_dump("abcdef");
        $tabger01 = TABGER01::all();
        $arr = [];
        $plan = [];
        $culm = [];
        $ejec = [];
        $ini = [];
        $len = count($tabger01);
        $totalplan = [];

        foreach ($tabger01 as $key => $value) {
                array_push($arr,$value->TabGer01Prog);
                array_push($plan,$value->TabGer01VivPla);
                array_push($culm,$value->TabGer01VivCul);
                array_push($ejec,$value->TabGer01VivEje);
                array_push($ini,$value->TabGer01VivIni);
                //$planif+=$value->TabGer01VivPla;
        }
        //var_dump($planif);
        array_pop($arr);
        array_pop($plan);
        array_pop($culm);
        array_pop($ejec);
        array_pop($ini);

        $planif=array_sum($plan);
        $culmi=array_sum($culm);
        $eneje=array_sum($ejec);
        $aini=array_sum($ini);
        //var_dump($planif);
        $chartjs = app()->chartjs
        ->name('abc')
        ->type('bar')
        //->size(['width' => 400, 'height' => 200])
        ->labels(['Vya Renda', 'Originarios', 'V. Economicas', 'Fonavis', 'Sembrando', 'Foncoop', 'Focen','Che Tapyi', 'Mej. Vivienda'])
        //->labels($arr)
        ->datasets([
            [
                "label" => "Viviendas Planificadas",
                'backgroundColor' => "blue",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $plan,
            ],
            [
                "label" => "Viviendas Culminadas",
                'backgroundColor' => "red",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $culm,
            ],
            [
                "label" => "Viviendas En Ejecución",
                'backgroundColor' => "grey",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $ejec,
            ],
         
        ])
        ->options([]);

        $chartjs_resumeneje = app()->chartjs
        ->name('resumen')
        ->type('bar')
        //->size(['width' => 400, 'height' => 200])
        //->labels(['Vya Renda', 'Originarios', 'V. Economicas', 'Fonavis', 'Sembrando', 'Foncoop', 'Focen','Che Tapyi', 'Mej. Vivienda'])
        //->labels($arr)
        ->datasets([
            [
                "label" => "Viviendas Planificadas",
                'backgroundColor' => "blue",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$planif] ,
            ],
            [
                "label" => "Viviendas Culminadas",
                'backgroundColor' => "red",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$culmi],
            ],
            [
                "label" => "Viviendas En Ejecución",
                'backgroundColor' => "grey",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$eneje],
            ],
            [
                "label" => "Viviendas A Terminar",
                'backgroundColor' => "yellow",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$aini],
            ],
         
        ])
        ->options([]);

        $chartjs_porcentajeplan = app()->chartjs
        ->name('plan')
        ->type('bar')
        //->size(['width' => 400, 'height' => 200])
        //->labels(['Vya Renda', 'Originarios', 'V. Economicas', 'Fonavis', 'Sembrando', 'Foncoop', 'Focen','Che Tapyi', 'Mej. Vivienda'])
        //->labels($arr)
        ->datasets([
            [
                "label" => "Viviendas Planificadas",
                'backgroundColor' => "blue",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$planif] ,
            ],
            [
                "label" => "Viviendas Culminadas",
                'backgroundColor' => "red",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$culmi],
            ],
            [
                "label" => "Viviendas En Ejecución",
                'backgroundColor' => "grey",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$eneje],
            ],
            [
                "label" => "Viviendas A Terminar",
                'backgroundColor' => "yellow",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$aini],
            ],
         
        ])
        ->optionsRaw("{
            legend: {
                display:false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display:false
                    }  
                }]
            }
        }");
        //->options([]);

        return view('home',compact('tabger01','chartjs','arr','chartjs_resumeneje','chartjs_porcentajeplan'));
    }
}
