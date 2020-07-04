<?php

namespace App\Http\Controllers;
use PDF;
use Illuminate\Http\Request;

class LabPDFController extends Controller
{
    //
    public function pdf_index(){
      $data = [ ];
       return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('printpdf.test_pdf',$data)->stream();
      //return $pdf->stream(rand().'.pdf'); //แบบนี้จะ stream มา preview
      //return $pdf->download('test.pdf'); //แบบนี้จะดาวโหลดเลย
    }
}
