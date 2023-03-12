<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Ticket;
use App\Http\Requests\validadorCliente;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;
use PDF;
use Exception;
use FontLib\Table\Type\name;

class ControladorPDF extends Controller
{

    /*          Funciones de PDF            */
    
    public function pdf(){
        
        //Consultas para el PDF
        $tickets = DB::table('tb_tickets')->where('estatus','<>','Cancelado')->where('id_usu','=',Auth::user()->id)->get();

        
        //Generar PDF
        $pdf = PDF::loadView('pdf.pdf_reporte_tickets',compact('tickets'));
        // return $pdf->download();
        return $pdf->stream();

     }
}
?>