@extends('adminlte::page')

@section('title', 'Tablero Gerencial')

@section('content_header')
<div class="row">
        <div class="col-md-4">
              <img src="{{asset('img/CASTELLANO-Y-GURANI-min-de-la-vivienda.png')}}" class="imagencentro" width="230" height="70">
        </div>
        <div class="col-md-4">
              <img src="{{asset('img/gobierno-nacional.png')}}" class="imagencentro" style="margin-top:5px" width="250" height="60">
        </div>
        <div class="col-md-4">
              <img src="{{asset('img/slogan.png')}}" class="imagencentro" width="220" height="70">
        </div>
      </div>
<h2 class="center"><strong>INFORME GERENCIAL</strong></h2>        
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

@section('js')
<script src="{{asset('js/chartjs-plugin-labels.js')}}"></script>
@endsection
@section('css')
   <style>
.border{
    border-color: black;
}
   .imagencentro{
    margin-left: auto;
    margin-right: auto;
    display: block;
    max-width:100%;
    max-height:100%;
   }    
   .center{
       text-align: center;
   }

   .total{
    font-weight: bold;
    
}

   
   </style>
@stop