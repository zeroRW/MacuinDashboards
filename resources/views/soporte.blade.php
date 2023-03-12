<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/658c27c3ed.js" crossorigin="anonymous"></script>   
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <title>Macuin Dashboards</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/626/626610.png">
        <link rel="stylesheet" href="css/estilosForms.css">
        <link rel="stylesheet" href="css/estilos.css">


</head>
<body>

    @if (session()->has('successUsuario')) 
        <script type="text/javascript">          
            Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: 'Usuario creado en la BD',
            showConfirmButton: false,
            timer: 1500
            })
        </script> 
    @endif

    @if (session()->has('regis')) 
        <script type="text/javascript">          
            Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: 'Departamento creado en la BD',
            showConfirmButton: false,
            timer: 1500
            })
        </script> 
    @endif

    @if (session()->has('editado')) 
        <script type="text/javascript">          
            Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: 'Departamento editado',
            showConfirmButton: false,
            timer: 1500
            })
        </script> 
    @endif

<!-- LOGIN  -->

    <div class="sidebar">
        <h3 class="mt-3 mb-4"><strong>Macuin<br/></strong>Dashboards</h3>
        <h4>{{ Auth::user()->name }}</h4>

        <h5 class="mt-2">Jefe de Soporte</h5>

        <h5 class="mt-2">{{ Auth::user()->email }}</h5>

        <br>
        <a href="" data-bs-toggle="modal" data-bs-target="#modalColab"><i class="bi bi-person-fill-gear"> Editar Perfil</i></a>
        <a href="" data-bs-toggle="modal" data-bs-target="#RegistrarDpto"><i class="bi bi-person-fill-gear"> Registrar Departamento</i></a>
        

        {{-- <form action="{{route('logout')}}" method="POST">
            @csrf
            <a><i class="bi bi-box-arrow-left"><strong> Cerrar Sesion</strong></i></a>
        </form> 
        
        ESTO ESTA COMENTADO POR UN DETALLITO DE POST entonces puse tipo get la ruta y quedo el de abajo
        --}}

        <a href="{{route('logout')}}"><i class="bi bi-box-arrow-left"><strong> Cerrar Sesion</strong></i></a>
        
        <div class="card" style="max-width: 18rem;">
            <div class="card mb-3" style="max-width: 18rem;">
                <div class="card-header">Departamentos</div>

                    <div class="tablita overflow-auto" style="max-height: 230px; overflow-y: scroll;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Ubicacion</th>
                                </tr>
                            </thead>
                            <tbody style="max-height: 50px; overflow-y: auto;">
                                @foreach ($depa as $item)
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#Detalle{{$item->id_dpto}}">
                                            {{$item->nombre}}
                                        </button>
                                    </td>
                                    <td>
                                        {{$item->ubicacion}}
                                    </td>
                                </tr>
                            </tbody>                                                                                                        
                            @endforeach                                                                           
                        </table>
                    </div>

            </div>
        </div>
    </div>

    @foreach ($depa as $item)
    <!-- Modal Detalle Departamento -->
    <div class="modal fade" id="Detalle{{$item->id_dpto}}" tabindex="-1" aria-labelledby="Detalle" aria-hidden="true">
        <div class="modal-dialog modal-modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detalles de Departamento</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <label hidden>id de Departamento {{$item->id_dpto}}</label>   
             <div class="container-fluid">
                <form action="{{route('editDpto',$item->id_dpto)}}" method="POST">  
                    @csrf                  
                    @method('PUT')
                    </select>                    
                    <div class="row mb-3">
                        <span>Nombre</span>
                        <input type="text" name="txtNombre" class="form-control" value="{{$item->nombre}}" placeholder="" required>
                    </div>
                    <div class="row mb-3">
                        <span>Telefono</span>
                        <input type="text" name="txtTel" class="form-control" placeholder="" value="{{$item->telefono}}" required>
                    </div>
                    <div class="row mb-3">
                        <span>Ubicación</span>
                        <input type="text" name="txtUbi" class="form-control" value="{{$item->ubicacion}}" placeholder="" required>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Editar Datos</button>
                    </div>
                </form>                   
            </div>   
            </div>
        </div>
        </div>
    </div>
    @endforeach

    <!-- Modal Registrar Departamento -->
    <div class="modal fade" id="RegistrarDpto" tabindex="-1" aria-labelledby="Detalle" aria-hidden="true">
        <div class="modal-dialog modal-modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Departamento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <div class="container-fluid">
            <form action="{{route('regisDpto')}}" method="POST">  
                @csrf                  
                </select>                    
                <div class="row mb-3">
                    <span>Nombre</span>
                    <input type="text" name="txtNombre" class="form-control" value="" placeholder="" required>
                </div>
                <div class="row mb-3">
                    <span>Telefono</span>
                    <input type="text" name="txtTel" class="form-control" placeholder="" value="" required>
                </div>
                <div class="row mb-3">
                    <span>Ubicación</span>
                    <input type="text" name="txtUbi" class="form-control" value="" placeholder="" required>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>                   
        </div>   
        </div>
    </div>
    </div>
</div>

    <!-- CARD DE TICKETS  -->

    <div class="container-soporte">
      
        <div class="card" style="height: 19rem;">
            <div class="card-header bg-transparent mb-1"><h3>Consulta de Tickets</h3></div>
                <div class="card-body overflow-auto" style="max-height: 230px; overflow-y: scroll;">
                    <div class="container">
                        <div class="contenedor-flexbox">
                            <form action="/search" method="get" id="search-form">
                                @csrf
                                <select class="form-select" aria-label="Default select example" name="filtro" id="search-form">  
                                    <option disabled selected>Estatus ...</option>
                                    @foreach ($estatus as $esta)
                                        <option value="{{$esta->estatus}}">{{$esta->estatus}}</option>
                                    @endforeach                                
                                </select>                            
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </form>    
                        </div>                                            
                    </div>
                    <table class="table" >
                        <thead>
                        <tr>
                            <th scope="col">Id:</th>
                            <th scope="col">Usuario:</th>
                            <th scope="col">Departamento</th>
                            <th scope="col">Fecha:</th>
                            <th scope="col">Clasificación:</th>
                            <th scope="col">Detalle:</th>
                            <th scope="col">Estatus:</th>
                            <th scope="col">Opciones:</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($tick as $tick)
                            <tr>
                                <th scope="row">{{$tick->id_ticket}}</th>
                                <td>{{$tick->name}}</td>
                                <td>{{$tick->nombre}}</td>
                                <td>{{$tick->created_at}}</td>
                                <td>{{$tick->clasificacion}}</td>
                                <td>{{$tick->detalle}}</td>
                                <td>{{$tick->estatus}}</td>
                                <td>
                                    @unless ($tick->estatus == "Solicitado")
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"disabled>Asignar</button>
                                    @else
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Asignar{{$tick->id_ticket}}">Asignar</button>
                                    @endunless                                                                          
                                </td>
                            </tr>   
                                <!-- Modal Asignar Ticket -->

                                <div class="modal fade" id="Asignar{{$tick->id_ticket}}" tabindex="-1" aria-labelledby="Detalle" aria-hidden="true">
                                    <div class="modal-dialog modal-modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Registrar Departamento</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="container-fluid">
                                        <form action="{{route('compartir')}}" method="POST">  
                                        @csrf                  
                                            </select>                 
                                            <div class="row mb-3">
                                                <span>Buscar Auxiliar</span>
                                                <input hidden type="text" name="txtTicket" class="form-control" value="1" placeholder="" required>
                                                <select class="form-select form-select-lg" name="txtAuxiliar" id="">
                                                    <option selected disabled>Selecciona un auxiliar</option>

                                                    
                                                    @foreach ($auxs as $aux)
                                                    <option value="{{$aux->id}}">{{$aux->name}} {{$aux->apellido}}</option>
                                                    @endforeach  
                                                        


                                                </select>
                                            </div>

                                            <div class="row mb-3">
                                                <span>Observaciones</span>
                                                <textarea name="txtObservacion" class="form-control" placeholder="" value="" required></textarea>
                                            </div>
                                            
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Registrar</button>
                                            </div>
                                        </form>                   
                                    </div>   
                                    </div>
                                    </div>
                                </div>

                            </div>
                            @endforeach                                                                                                         
                        </tbody>
                    </table>
                    <a href="/soporte_bo"><button class="btn btn-primary">Ver todos</button></a>
                </div>
        </div>


            <div class="card">
                <div class="card-header bg-transparent mb-3"><h4>Registrar Usuarios</h4></div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                                <form action="/usuarioNew" method="post">
                                    @csrf
                                    <div class="input-group mb-4">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Nombre Usuario</span>
                                        <input type="text" name="txtNameUsu" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>

                                    <div class="input-group mb-4">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Correo</span>
                                        <input type="email" name="txtemailUsu" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>

                                    <div class="input-group mb-4
                                    ">
                                        <label class="input-group-text" for="inputGroupSelect01">Perfil</label>
                                        <select class="form-select" name="txtPerfil" id="inputGroupSelect01">
                                          <option selected>Selecciona una opcion...</option>
                                          <option value="jefe">Jefe de Soporte</option>
                                          <option value="auxiliar">Auxiliar</option>
                                        </select>
                                    </div>

                                    <div class="input-group mb-5">
                                        <label class="input-group-text" for="inputGroupSelect01">Departamento</label>
                                        <select class="form-select" name="txtDeparta" id="inputGroupSelect01">
                                          <option selected>Selecciona una opcion...</option>
                                        @foreach ($depa as $dpto)
                                                <option value="{{$dpto->id_dpto}}">{{$dpto->nombre}}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Guardar Usuario</button>

                                    <button class="btn btn-primary consulta" style="margin-left: 15%" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Consultar Usuarios</button>

                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title" id="offcanvasRightLabel">Consultar Usuarios</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        
                                        <table class="table">
                                            <thead>
                                              <tr>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Departamento</th>
                                                <th scope="col">Opciones</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($usu as $usu)
                                                <tr>
                                                    <th scope="row">{{$usu->name}}</th>
                                                    <td>{{$usu->nombre}}</td>
                                                    <td>
                                                        <div class="mb-2">
                                                            <a class="btn btn-success" href="#" role="button">Editar</a>
                                                        </div>
                                                        <div>
                                                            <a class="btn btn-danger" href="#" role="button">Eliminar</a>
                                                        </div>
                                                    </td>
                                                  </tr>
                                                @endforeach                                              
                                            </tbody>
                                          </table>

                                    </div>
                                    </div>                                    
                                </form>
                    </blockquote>
                </div>
            </div>
        <br>
    </div>  

 <!-- Modal de Colaboradores -->
 <div class="modal fade" id="modalColab">
    <div class="modal-dialog modal-modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Datos de usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <form action="{{route('cliente_edit',Auth::user()->id)}}" method="POST">  
                    @csrf                  
                    @method('PUT')
                    </select>                    
                    <div class="row mb-3">
                        <span>Nombre</span>
                        <input type="text" name="txtNombre" class="form-control" value="{{ Auth::user()->name }}" placeholder="" required>
                    </div>
                    <div class="row mb-3">
                        <span>Apellidos</span>
                        <input type="text" name="txtApellido" class="form-control" placeholder="" value="{{ Auth::user()->apellido }}" required>
                    </div>
                    <div class="row mb-3">
                        <span>Correo</span>
                        <input type="text" name="txtEmail" class="form-control" value="{{ Auth::user()->email }}" placeholder="" required>
                    </div>
                    <div class="row mb-3">
                        <span>Perfil</span>
                        <input type="text" name="txtPerfil" class="form-control" placeholder="Pendiente" value="" disabled>
                    </div>
                    <div class="row mb-3">
                        <span>Contraseña</span>
                        <input type="password" name="txtPass" class="form-control" placeholder="Solicitar cambio" disabled>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Editar Datos</button>
                    </div>
                </form>                   
            </div>        
        </div>
      </div>
    </div>
</div>

<!--Javacript-->

    @yield('codigo')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>