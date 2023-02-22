<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Ticket;
use DB;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;

class controladorMacuin extends Controller
{


    //FUNCIONES LOGIN
    public function loginInicio(){
        return view('login');
    }

    public function login_v(Request $r){
        $r->validate([
            'txtemail' =>'required|email',
            'txtpass'=>'required|min:4',
        ]);

        if(Auth::attempt(['email'=>$r->txtemail,'password'=>$r->txtpass])){
            return redirect()->route('cliente');
        }
        
        return back()->withErrors(['invalid_credentials'=>'usuario o contraseña no coinciden'])->withInput();
    }

    public function registrarUsu(){
        return view('registrarUsuario');
    }

    //REGISTRO DE USUARIO
    public function registrar_v(Request $r)  
    {
        $r->validate([
            'txtusu' =>'required|string',
            'txtemail' =>'required|email|unique:users,email',
            'txtpass'=>'required|min:4',
            'txtpass_v' => 'required|same:txtpass'
        ]);

        User::create([
            'name' => $r->txtusu,
            'email' => $r->txtemail,
            'password' => bcrypt($r->txtpass),
        ]);

    return redirect()->route('login')->with('success', 'Registrado');
    }

    //FUNCIONES INDEX (CLIENTE, J-SOPORTE Y AUXILIAR)
    public function indexCliente()
    {
        $deptos = DB::table('tb_departamentos')->get();
        $tickets = DB::table('tb_tickets')->get();
        return view('macuinCliente',compact('deptos','tickets'));
    }

    public function insertTicket(Ticket $request)
    {
        if ($request->input('txtClasificacion') !== "Otro:"){
            DB::table('tb_tickets')->insert([
                "id_usu"=>1,
                "id_dpto"=>$request->input('txtDepartamento'),
                "clasificacion"=>$request->input('txtClasificacion'),
                "detalle"=>$request->input('txtDescripcion'),
                "estatus"=>"Solicitado",
                "created_at"=>Carbon::now(),
                "updated_at"=>Carbon::now()
            ]);
            return "se manda el select";
        } else{
            DB::table('tb_tickets')->insert([
                "id_usu"=>1,
                "id_dpto"=>$request->input('txtDepartamento'),
                "clasificacion"=>$request->input('txtCual'),
                "detalle"=>$request->input('txtDescripcion'),
                "estatus"=>"Solicitado",
                "created_at"=>Carbon::now(),
                "updated_at"=>Carbon::now()
            ]);
            return "se manda otro";
        }
    }


    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
