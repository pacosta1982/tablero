<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadsController extends Controller
{
  public function downloadFile($file)
    {
    	$myFile = public_path('images').'\\'. $file;
    	$headers = ['Content-Type: application/pdf'];
    	$newName = pathinfo($file, PATHINFO_FILENAME ).'-'.time().'.pdf';

    	return response()->download($myFile, $newName, $headers);
    }
}
