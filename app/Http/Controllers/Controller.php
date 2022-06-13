<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\OrdenesServicio;
use Barryvdh\DomPDF\Facade\Pdf;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function imprimePDF($id){
        $orden = OrdenesServicio::find($id);

       $pdf =  PDF::loadView('ordenPDF', ['orden' => $orden])->stream('orden'.$orden->varConsecutivo.'.pdf');
       return response()->stream(function() use ($pdf) {
            echo $pdf;
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="ordenPDF_'.$orden->varConsecutivo.'.pdf"',
            'Content-Transfer-Encoding' => 'binary',
        ]);
    }

    public function imprimePDFProveedor($id){
        $orden = OrdenesServicio::find($id);

       $pdf =  PDF::loadView('PDFProveedor', ['orden' => $orden])->stream('orden'.$orden->varConsecutivo.'.pdf');
       return response()->stream(function() use ($pdf) {
            echo $pdf;
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="ordenPDF_'.$orden->varConsecutivo.'.pdf"',
            'Content-Transfer-Encoding' => 'binary',
        ]);
    }

}
