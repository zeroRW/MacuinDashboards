<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Ticket;
use App\Http\Requests\RegisUsu;
use App\Http\Requests\Login;
use DB;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;

class controladorMacuin extends Controller
{
    //AUTENTIFICACION
    public function login_v(Login $r){

        if(Auth::attempt(['email'=>$r->txtemail,'password'=>$r->txtpass])){
            //Enviar el email
            $mail = $r->txtemail;
            return redirect()->route('cliente_rs')->with('mail',$mail);
        }
        
        return back()->withErrors(['invalid_credentials'=>'Usuario y/o contraseña no coinciden'])->withInput();
    }

    //LOGOUT
    public function salir(){
        Auth::logout();
        return redirect()->route('login');
    }

    //REGISTRO DE USUARIO
    public function  registrar_v(RegisUsu $r){  

        User::create([
            'name' => $r->txtusu,
            'email' => $r->txtemail,
            'password' => bcrypt($r->txtpass),
        ]);

    return redirect()->route('login')->with('success', 'Registrado');
    }

    //FUNCION EDITAR PERFIL
    public function editarPerfil(RegisUsu $r, $id){

            $usu = User::findOrFail($id); // Buscar el usuario en la base de datos
    
            $usu->name = $r->input('txtNombre');
            $usu->apellido = $r->input('txtApellido');
            $usu->email = $r->input('txtEmail');
    
            $usu->save(); //Actualizar
            
            return redirect()->route('cliente_rs')->with('save','editado');

    }

    //FUNCION INSERTAR TICKET CLIENTE
    public function insertTicket(Ticket $request)
    {

        if ($request->input('txtClasificacion') !== "Otro:"){
            DB::table('tb_tickets')->insert([
                "id_usu"=>Auth::user()->id,
                "id_dpto"=>$request->input('txtDepartamento'),
                "clasificacion"=>$request->input('txtClasificacion'),
                "detalle"=>$request->input('txtDescripcion'),
                "estatus"=>"Solicitado",
                "created_at"=>Carbon::now(),
                "updated_at"=>Carbon::now()
            ]);

            return redirect()->route('cliente_rs')->with('hecho','no hecho');

        return redirect()->route('cliente_rs')->with('firado','no hecho');

        } else{
            DB::table('tb_tickets')->insert([
                "id_usu"=>Auth::user()->id,
                "id_dpto"=>$request->input('txtDepartamento'),
                "clasificacion"=>$request->input('txtCual'),
                "detalle"=>$request->input('txtDescripcion'),
                "estatus"=>"Solicitado",
                "created_at"=>Carbon::now(),
                "updated_at"=>Carbon::now()
            ]);


            return redirect()->route('cliente_rs')->with('hecho','no hecho');

            return redirect()->route('cliente_rs')->with('hecho','no hecho');



        }
    }

    //FUNCION CANCELAR TICKET
    public function cancelTicket (Request $req, $id){
        
        DB::table('tb_tickets')->where('id_ticket',$id)->update([
            "estatus"=>"Cancelado",
            "updated_at"=>Carbon::now(),
        ]);
        return redirect()->route('cliente_rs')->with('cancelacion','cancel');
        
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



