<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\TABGER01;

class ReporteController extends Controller
{
    public function pdfview(Request $request)
    {
        //$items = DB::table("users")->get();
       /* $items = DB::table('registers')
          ->where('registers.id', '=', $id)
          ->select('registers.*')
          ->get();
        view()->share('items',$items);
        */
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
        array_pop($arr);
        array_pop($plan);
        array_pop($culm);
        array_pop($ejec);
        array_pop($ini);

        $planif=array_sum($plan);
        $culmi=array_sum($culm);
        $eneje=array_sum($ejec);
        $aini=array_sum($ini);

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
        //view()->share('tabger01',$tabger01);
        //view()->share('chartjs',$chartjs);
        /*if($request->has('download')){
            $pdf = PDF::loadView('pdf.pdfview');
            //$pdf->setOption('footer-html','http://localhost:8000/footer');
            return $pdf->download('pdfview.pdf');
        }*/

        return view('pdf.pdfview');
    }
}
