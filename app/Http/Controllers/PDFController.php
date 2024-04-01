<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\User;
use Illuminate\Support\Facades\View;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $mpdf = new Mpdf();
        $mpdf->WriteHTML('<h1>Hello world!</h1>');
        $mpdf->Output();
    }
}
