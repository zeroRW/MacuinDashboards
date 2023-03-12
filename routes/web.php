<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controladorMacuin;
use App\Http\Controllers\ControladorMacuin_Vistas;
use App\Http\Controllers\ControladorPDF;

//RUTAS LOGIN
Route::get('/',[ControladorMacuin_Vistas::class,'loginInicio'])->name('login');
Route::post('/', [controladorMacuin::class, 'login_v'])->name("login.v");
Route::get('logout', [ControladorMacuin::class, 'salir'])->name('logout');

//RUTAS REGISTRAR USUARIO
Route::get('registro', [ControladorMacuin_Vistas::class, 'registrarUsu'])->name('apo.regisCli');
Route::post('registro', [controladorMacuin::class, 'registrar_v']);

//RUTAS CLIENTE
Route::get('cliente', [ControladorMacuin_Vistas::class, 'indexCliente'])->name('cliente');
Route::post('ticket', [controladorMacuin::class, 'insertTicket']);
Route::put('cancelar/{id}', [controladorMacuin::class, 'cancelTicket'])->name('cancel');
Route::put('cliente_edit/{id}', [controladorMacuin::class, 'editarPerfil'])->name('cliente_edit');


//RUTAS JEFE DE SOPORTE
Route::get('soporte', [ControladorMacuin_Vistas::class, 'consultaDepa'])->name('soporte');
Route::post('usuarioNew',[controladorMacuin::class, 'registrarUsuario']);
Route::get('search',[controladorMacuin::class, 'search'])->name('search');
Route::post('departamentoNew',[controladorMacuin::class, 'insertDpto'])->name('regisDpto');
Route::put('dpto_edit/{id}',[controladorMacuin::class, 'editarDpto'])->name('editDpto');
Route::post('asignarTicket',[controladorMacuin::class, 'asignarTicket'])->name('compartir');



//RUTAS PROTEGIDAS
Route::middleware('auth')->group(function(){
    Route::get('cliente_rs', [ControladorMacuin_Vistas::class, 'indexCliente'])->name('cliente_rs');
    Route::get('soporte_bo', [ControladorMacuin_Vistas::class, 'consultaDepa'])->name('soporte_bo');
});

// RUTAS PDFS
Route::get('pdf', [ControladorPDF::class, 'pdf'])->name('d_pdf');
?>





