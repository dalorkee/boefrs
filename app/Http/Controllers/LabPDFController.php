<?php

namespace App\Http\Controllers;
use PDF;
use Illuminate\Http\Request;

class LabPDFController extends Controller
{
    //
    public function pdf_index(){
      $data = [ ];
      $pdf = PDF::loadView('printpdf.test_pdf',$data);
      return $pdf->stream(rand().'.pdf'); //แบบนี้จะ stream มา preview
      //return $pdf->download('test.pdf'); //แบบนี้จะดาวโหลดเลย
    }
}
