@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>INFORME DE LA DIRECCIÓN DE INVESTIGACIÓN, EVALUACION Y MONITOREO
        Informe de Avances de Obras
        </h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Presupuesto, Plan Financiero y Obligado en Gs a Oct. 2018</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="">
            {!! $chartjs_presupuesto->render() !!}
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <div class="col-md-6">
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Porcent. del Plan Financiero Ejecutado segun Obligado a Oct. 2018</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="">
            {!! $chartjs_presupuestotorta->render() !!}
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Ejecución por Proyecto en base al Plan Financiero a Oct. 2018</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="">
            <table class="table">
                <tbody><tr>
                <th>Programa</th>
                <th class="center">Presupuesto Vigente 2018</th>
                <th class="center">Plan financiero 2018</th>
                <th class="center">Obligado</th>
                <th class="center">%</th>
                </tr>
                @foreach($tabger02 as $tab)  
                    <tr>
                        <td>{{ $tab->TabGer02PrgPry }}</td>
                        <td class="center">{{ number_format($tab->TabGer02Presup,0,'.','.') }}</td>
                        <td class="center">{{ number_format($tab->TabGer02PlanFin,0,'.','.') }}</td>
                        <td class="center">{{ number_format($tab->TabGer02Oblig,0,'.','.') }}</td>
                        <td class="center">{{ number_format( ($tab->TabGer02Oblig * 100) / $tab->TabGer02PlanFin) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td class="total">Total</td>
                    <td class="center total">{{ number_format($tabger02->sum('TabGer02Presup'),0,'.','.') }}</td>
                    <td class="center total">{{ number_format($tabger02->sum('TabGer02PlanFin'),0,'.','.') }}</td>
                    <td class="center total">{{ number_format($tabger02->sum('TabGer02Oblig'),0,'.','.') }}</td>
                    <td class="center total">{{ number_format( ($tabger02->sum('TabGer02Oblig') * 100) / $tabger02->sum('TabGer02PlanFin')) }}</td>
                </tr>
            </tbody></table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="box box-success">
                <div class="box-header" >
                <h3 class="box-title">Resumen por Programas/Proyectos</h3>
                </div>    
                {!! $chartjs->render() !!}
        </div>
        <div class="box box-success">
                <div class="box-header" >
                <h3 class="box-title">Resumen de Ejecución de Viviendas</h3>
                </div>    
                {!! $chartjs_resumeneje->render() !!}
        </div>

        <div class="box box-success">
                <div class="box-header" >
                <h3 class="box-title">Porcentaje en relacion al total Planificado.</h3>
                </div>    
                {!! $chartjs_porcentajeplan->render() !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="box box-success">
            <div class="box-header" >
            <h3 class="box-title">Resumen por Programas/Proyectos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table class="table">
                <tbody><tr>
                <th>Programa</th>
                <th class="center">Viviendas Planificadas</th>
                <th class="center">Viviendas Culminadas</th>
                <th class="center">Viviendas En Ejecución</th>
                <th class="center">Viviendas A Iniciar</th>
                </tr>
                @foreach($tabger01 as $tab)  
                
                    @if(!$loop->last)
                    <tr>
                        <td>{{ $tab->TabGer01Prog }}</td>
                        <td class="center">{{ $tab->TabGer01VivPla }}</td>
                        <td class="center">{{ $tab->TabGer01VivCul }}</td>
                        <td class="center">{{ $tab->TabGer01VivIni }}</td>
                        <td class="center">{{ $tab->TabGer01VivEje }}</td>
                    </tr>
                    @else
                    <tfoot>
                        <tr>
                                <th>{{ $tab->TabGer01Prog }}</th>
                                <th class="center">{{ $tab->TabGer01VivPla }}</th>
                                <th class="center">{{ $tab->TabGer01VivCul }}</th>
                                <th class="center">{{ $tab->TabGer01VivIni }}</th>
                                <th class="center">{{ $tab->TabGer01VivEje }}</th>
                    </tfoot>
                    @endif
                @endforeach
            </tbody></table>
            </div>

        </div>
    </div>
</div>

@stop
@section('css')
   <style>
   .center{
       text-align: center;
   }

   .total{
    font-weight: bold;
    
}

   
   </style>
@stop