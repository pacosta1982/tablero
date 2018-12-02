<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\TABGER01;

class PdfController extends Controller
{
    public function github (){
        //return \PDF::loadFile('http://www.github.com')->stream('github.pdf');
        //$data=[];
        //$pdf = PDF::loadView('pdf.pdfview');
        //return $pdf->download('invoice.pdf');
        return PDF::loadFile('http://www.github.com')->inline('github.pdf');
        //$tabger01 = TABGER01::all();
        //view()->share('tabger01',$tabger01);
        //$pdf = PDF::loadView('pdf.pdfview');
        //return $pdf->download('invoice.pdf');
    }
}
