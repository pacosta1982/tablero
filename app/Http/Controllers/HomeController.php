<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TABGER01;
use App\TABGER02;
use App\TABGER03;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //var_dump("abcdef");
        $tabger01 = TABGER01::orderBy('TabGer01Cod')->get();
        $tabger02 = TABGER02::orderBy('TabGer02Orden')->get();
        $tabger03 = TABGER03::orderBy('TabGer03Cod')->get();

        $tab04  = \DB::table('TABGER01')
        ->join('TABGER02', 'TABGER01.TabGer01Cod', '=', 'TABGER02.ProgCod')
        //->join('orders', 'users.id', '=', 'orders.user_id')
        ->select('*')
        ->orderBy('TabGer01Cod')
        ->get();
        //var_dump($tab04);
        $nombreplan = [];
        $presuplan = [];
        $viviculm2 = [];

        foreach ($tab04 as $key => $valueplan) {
            
            array_push($nombreplan,$valueplan->TabGer01Prog);
            array_push($presuplan,number_format( ($valueplan->TabGer02Oblig * 100) / $valueplan->TabGer02PlanFin));
            array_push($viviculm2,number_format(($valueplan->TabGer01VivCul * 100)/$valueplan->TabGer01VivPla));
            //var_dump($value->TabGer01Prog, $value->TabGer02Presup,
            //$value->TabGer01VivCul,$value->TabGer01VivPla,number_format( ($value->TabGer02Oblig * 100) / $value->TabGer02PlanFin) );
        }

        //var_dump($tab04);

        //$presupuestdatos = TABGER02::avg('star');

        $arr = [];
        $plan = [];
        $culm = [];
        $ejec = [];
        $ini = [];
        $len = count($tabger01);
        $totalplan = [];
        
        $dptos = [];
        $dptosplan = [];
        $dptoscul = [];
        $dptoseje = [];
        $dptosini = [];
        $avanceper = [];
        $avanceper50 = [];
        $avanceper75 = [];
        $avanceper100 = [];

        foreach ($tabger01 as $key => $value) {
                array_push($arr,$value->TabGer01Prog);
                array_push($plan,$value->TabGer01VivPla);
                array_push($culm,$value->TabGer01VivCul);
                array_push($ejec,$value->TabGer01VivEje);
                array_push($ini,$value->TabGer01VivIni);
                array_push($avanceper,$value->TabGer01Ava25);
                array_push($avanceper50,$value->TabGer01Ava50);
                array_push($avanceper75,$value->TabGer01Ava75);
                array_push($avanceper100,$value->TabGer01Ava100);
                //$planif+=$value->TabGer01VivPla;
        }

        foreach ($tabger03 as $key => $value3) {
            array_push($dptos,$value3->TabGer03DptoNom);
            array_push($dptosplan,$value3->TabGer03VivPla);
            array_push($dptoscul,$value3->TabGer03VivCul);
            array_push($dptoseje,$value3->Tabger03VivEje);
            array_push($dptosini,$value3->TabGer03VivIni);
        }
        //var_dump($dptosplan);
        array_pop($arr);
        array_pop($plan);
        array_pop($culm);
        array_pop($ejec);
        array_pop($ini);
        array_pop($dptosplan);
        array_pop($avanceper);
        array_pop($avanceper50);
        array_pop($avanceper75);
        array_pop($avanceper100);

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
        //->options([]);
        ->optionsRaw("{
            legend: {
                display:true,
                position: 'top',
                labels: {
                    fontColor:  '#000'
                }
            },
            plugins: {
                labels: {
                    render: 'value',
                    fontSize: 12,
                },
            }
        }");
  
        $chartjs_presupuesto = app()->chartjs
        ->name('presupuesto')
        ->type('bar')
        //->size(['width' => 400, 'height' => 200])
        ->labels(['Presup. Vigente 2018','Plan Financiero 2018','Obligado'])
        //->labels($arr)
        ->datasets([
            [
                "label" => "Presupuesto Vigente 2018",
                'backgroundColor' => "blue",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$tabger02->sum('TabGer02Presup'),$tabger02->sum('TabGer02PlanFin'),$tabger02->sum('TabGer02Oblig')],
            ],
            
        ])
        ->optionsRaw("{
            legend: {
                display:true,
                position: 'bottom',
                labels: {
                    fontColor:  '#000'
                }
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display:false
                    }  
                }],
                yAxes: [{
                    gridLines: {
                        display:true
                    },
                    ticks: {
                        beginAtZero: true,
                        steps: 9,
                        stepValue: 100000,
                        max: 900000
                    } 
                }]
            },
            plugins: {
                labels: {
                    render: 'value'
                },
            }
        }");
        //->options([]);

        $obligado= number_format(($tabger02->sum('TabGer02Oblig') * 100) / $tabger02->sum('TabGer02PlanFin'),0,'.','.');
        $plafin  = number_format((100 - ($tabger02->sum('TabGer02Oblig') * 100) / $tabger02->sum('TabGer02PlanFin')),0,'.','.');
        $chartjs_presupuestotorta = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Obligado','Plan Financiero'])
        ->datasets([
            [
                'backgroundColor' => ['#FF6384', '#36A2EB'],
                'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
                'data' => [$obligado,$plafin]
            ]
        ])
        ->optionsRaw("{
            legend: {
                display:true,
                position: 'bottom',
                labels: {
                    fontColor:  '#000'
                }
            },
            plugins: {
                labels: [
                    {
                      render: 'label',
                      position: 'outside'
                    },
                    {
                      render: 'percentage'
                    }
                  ]
            }
            
        }");
        //->options([]);

        $chartjs_resumeneje = app()->chartjs
        ->name('resumen')
        ->type('bar')
        //->size(['width' => 400, 'height' => 200])
        ->labels(['Total General'])
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
        //->options([]);
        ->optionsRaw("{
            legend: {
                display:true,
                position: 'bottom',
                labels: {
                    fontColor:  '#000'
                }
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display:false
                    }  
                }],
                yAxes: [{
                    gridLines: {
                        display:true
                    }  
                }]
            },
            plugins: {
                labels: {
                    render: 'value'
                },
            }
        }");
        

        $chartjs_porcentajeplan = app()->chartjs
        ->name('plan')
        ->type('bar')
        //->size(['width' => 400, 'height' => 200])
        ->labels(['Total %'])
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
                'data' => [100] ,
            ],
            [
                "label" => "Viviendas Culminadas",
                'backgroundColor' => "red",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [number_format(($culmi*100)/$planif)],
            ],
            [
                "label" => "Viviendas En Ejecución",
                'backgroundColor' => "grey",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [number_format(($eneje*100)/$planif)],
            ],
            [
                "label" => "Viviendas A Terminar",
                'backgroundColor' => "yellow",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [number_format(($aini*100)/$planif)],
            ],
         
        ])
        ->optionsRaw("{
            legend: {
                display:true,
                position: 'bottom',
                labels: {
                    fontColor:  '#000'
                }
            },

            plugins: {
                labels: {
                    render: function (args) {
                        // args will be something like:
                        // { label: 'Label', value: 123, percentage: 50, index: 0, dataset: {...} }
                        return args.value + '%';
                    
                        // return object if it is image
                        // return { src: 'image.png', width: 16, height: 16 };
                      }
                },
            },

            scales: {
                xAxes: [{
                    gridLines: {
                        display:false
                    }  
                }],
                yAxes: [{
                    gridLines: {
                        display:true
                    },
                    ticks: {
                        beginAtZero: true,
                        steps: 10,
                        stepValue: 5,
                        max: 120
                    } 
                }]
            },
        }");

        $chartjs_viviendas_eje = app()->chartjs
        ->name('vivieje')
        ->type('bar')
        //->size(['width' => 400, 'height' => 200])
        ->labels(['0 - 25%', '26% - 50%', '51% - 75%', '76% - 100%'])
        //->labels($arr)
        ->datasets([
            [
                "label" => "Viviendas en Ejecución",
                'backgroundColor' => "blue",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$tabger01->last()->TabGer01Ava100,
                           $tabger01->last()->TabGer01Ava75,
                           $tabger01->last()->TabGer01Ava50,
                           $tabger01->last()->TabGer01Ava25],
            ],
        ])
        ->optionsRaw("{
            legend: {
                display:true,
                position: 'bottom',
                labels: {
                    fontColor:  '#000'
                }
            },

            plugins: {
                labels: {
                    render: 'value'
                },
            },
        }");
        //->options([]);

        $chartjs_porcejefinac = app()->chartjs
        ->name('abcdef')
        ->type('bar')
        //->size(['width' => 400, 'height' => 200])
        ->labels(['Vya Renda', 'Originarios', 'V. Economicas', 'Fonavis', 'Sembrando', 'Foncoop', 'Focen','Che Tapyi', 'Mej. Vivienda'])
        //->labels($nombreplan)
        ->datasets([
            [
                "label" => "% Ejecución del Plan Financiero",
                'backgroundColor' => "blue",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $presuplan,
            ],
            [
                "label" => "Viviendas Culminadas",
                'backgroundColor' => "red",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $viviculm2,
            ],
         
        ])
        ->optionsRaw("{
            legend: {
                display:true,
                position: 'bottom',
                labels: {
                    fontColor:  '#000'
                }
            },

            plugins: {
                labels: {
                    render: function (args) {
                        // args will be something like:
                        // { label: 'Label', value: 123, percentage: 50, index: 0, dataset: {...} }
                        return args.value + '%';
                    
                        // return object if it is image
                        // return { src: 'image.png', width: 16, height: 16 };
                      }
                },
            },
        }");
        //->options([]);

        $chartjsdptos= app()->chartjs
        ->name('dptos')
        ->type('bar')
        //->size(['width' => 400, 'height' => 200])
        ->labels(['CONCEPCION', 'SAN PEDRO', 'CORDILLERA', 'GUAIRA', 'CAAGUAZU', 'CAAZAPA', 'ITAPUA','MISIONES',
        'PARAGUARI','ALTO PARANA','CENTRAL','ÑEEMBUCU','AMAMBAY','CANINDEYU','P. HAYES','BOQUERON','A. PARAGUAY'])
        //->labels($dptos)
        ->datasets([
            [
                "label" => "Viviendas Planificadas",
                'backgroundColor' => "blue",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $dptosplan ,
            ],
            [
                "label" => "Viviendas Culminadas",
                'backgroundColor' => "red",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $dptoscul,
            ],
            [
                "label" => "Viviendas En Ejecución",
                'backgroundColor' => "grey",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $dptoseje,
            ],
            [
                "label" => "Viviendas A Terminar",
                'backgroundColor' => "yellow",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $dptosini,
            ],
         
        ])
        ->optionsRaw("{
            legend: {
                display:true,
                position: 'bottom',
                labels: {
                    fontColor:  '#000'
                }
            },

            plugins: {
                labels: {
                    render: 'value',
                    fontSize: 10,
                },
            },
        }");
        //->options([]);
        /*->optionsRaw("{
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
        }");*/

        $chartjsavance= app()->chartjs
        ->name('avancechart')
        ->type('bar')
        //->size(['width' => 400, 'height' => 200])
        //->labels(['CONCEPCION', 'SAN PEDRO', 'CORDILLERA', 'GUAIRA', 'CAAGUAZU', 'CAAZAPA', 'ITAPUA','MISIONES',
        //'PARAGUARI','ALTO PARANA','CENTRAL','ÑEEMBUCU','AMAMBAY','CANINDEYU','P. HAYES','BOQUERON','A. PARAGUAY'])
        //->labels($arr)
        ->labels(['Vya Renda', 'Originarios', 'V. Economicas', 'Fonavis', 'Sembrando', 'Foncoop', 'Focen','Che Tapyi', 'Mej. Vivienda'])
        ->datasets([
            [
                "label" => "0% - 25%",
                'backgroundColor' => "blue",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $avanceper ,
            ],
            [
                "label" => "26% - 50%",
                'backgroundColor' => "red",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $avanceper50,
            ],
            [
                "label" => "51% - 75%",
                'backgroundColor' => "grey",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $avanceper75,
            ],
            [
                "label" => "76% - 100%",
                'backgroundColor' => "yellow",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $avanceper100,
            ],
         
        ])
        //->options([]);
        ->optionsRaw("{
            plugins: {
                labels: {
                    render: function (args) {
                        // args will be something like:
                        // { label: 'Label', value: 123, percentage: 50, index: 0, dataset: {...} }
                        return '';
                    
                        // return object if it is image
                        // return { src: 'image.png', width: 16, height: 16 };
                      }
                },
            },
            
            scales: {
            xAxes: [{
                stacked: true
            }],
            yAxes: [{
                stacked: true
            }]
        }
        }");

        return view('home',compact('tabger01','tabger02','chartjs','chartjs_presupuestotorta',
        'arr','chartjs_resumeneje','chartjs_viviendas_eje','chartjs_porcentajeplan','chartjs_presupuesto',
    'chartjs_porcejefinac','tabger03','chartjsdptos','chartjsavance'));
    }
}
