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

class ControladorMacuin_Vistas extends Controller
{
    //VISTA LOGIN
    public function loginInicio(){
        return view('login');
    }

    //VISTA REGISTRO USUARIO
    public function registrarUsu(){
        return view('registrarUsuario');
    }

    //VISTA CLIENTE Y JEFE DE SOPORTE
    public function indexCliente()
    {
        $deptos = DB::table('tb_departamentos')->get();
        $tickets = DB::table('tb_tickets')->where('estatus','<>','Cancelado')->where('id_usu','=',Auth::user()->id)->get();
        $d_ticket = DB::table('tb_tickets')->where('estatus','<>','Cancelado')->where('id_usu','=',Auth::user()->id)->get();
        return view('cliente',compact('deptos','tickets','d_ticket'));
    }

     //VISTA JEFE SOPORTE
     public function consultaDepa(){

        

        $tick = DB::table('tb_tickets')
        ->crossJoin('users')
        ->crossJoin('tb_departamentos')
        ->select('tb_tickets.id_ticket', 'users.name', 'tb_departamentos.nombre', 'tb_tickets.created_at', 'tb_tickets.clasificacion', 'tb_tickets.detalle', 'tb_tickets.estatus')
        ->where('tb_tickets.id_usu','=',DB::raw('users.id'))
        ->where('tb_tickets.id_dpto','=',DB::raw('tb_departamentos.id_dpto'))
        ->get();

        $usu = DB::table('users')
        ->crossJoin('tb_departamentos')
        ->select('users.name', 'tb_departamentos.nombre')
        ->where('users.id_dpto','=',DB::raw('tb_departamentos.id_dpto'))
        ->get();

        $estatus = DB::table('tb_tickets')
        ->select('estatus')
        ->groupBy('estatus')
        ->get();

        
        if(Auth::user()->perfil == null||Auth::user()->perfil == 'auxiliar'){
            return redirect()->route('cliente_rs')->with('no se puede','cancel');
        }

        $depa = DB::table('tb_departamentos')->get();

        $auxs = DB::table('users')->where('perfil','=','auxiliar')->get();
        
        return view('soporte', compact('depa','tick','usu','estatus','auxs'));
     }

}
?>
