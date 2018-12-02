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

   
   </style>
@stop