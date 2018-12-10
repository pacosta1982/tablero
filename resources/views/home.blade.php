@extends('adminlte::page')

@section('title', 'Tablero Gerencial')

@section('content_header')
    <h3 class="center"><strong>INFORME DE LA DIRECCIÓN DE INVESTIGACIÓN, EVALUACION Y MONITOREO
        Informe de Avances de Obras</strong>
        </h3>
        <h3 class="center"><strong>Informe N° 31/18 DIEM</strong></h3>
        <h4 class="center"><strong>Avances de Obras al mes de Octubre del 2018</strong></h4>
@stop

@section('content')


@include('uno')
@include('dos')
@include('cuatro')
@include('tres')
@include('cinco')
@include('seis')
@include('siete')


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