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

    @if(session()->has('save'))
    <script type="text/javascript">          
        Swal.fire(
        '¡Todo correcto!',
        'Se ha editado su perfil',
        'success'
        )
    </script> 
    @endif

@if (session()->has('mail')) 
    <script type="text/javascript">          
        Swal.fire({
        position: 'top-center',
        icon: 'success',
        title: 'Bienvenido: {{ Auth::user()->name }}',
        showConfirmButton: false,
        timer: 1500
        })
    </script> 
@endif

@if (session()->has('hecho')) 
    <script type="text/javascript">          
        Swal.fire(
        '¡Se ha generado su ticket!',
        'Pronto tendra alguna respuesta',
        'success'
        )
    </script> 
@endif

@if(session()->has('cancelacion'))
        
    {!!" <script>Swal.fire(
      'Cancelacion exitosa!',
      '¡Se ha cancelado su ticket!',
      'success'
    )</script>"!!}
@endif

@if(session()->has('no se puede'))

<script type="text/javascript">          
    Swal.fire({
    position: 'top-center',
    icon: 'error',
    title: 'No tienes acceso',
    showConfirmButton: false,
    timer: 1700
    })
</script> 

@endif


<!-- LOGIN  -->

    <div class="sidebar">
        <h3 class="mt-3 mb-4"><strong>Macuin<br/></strong>Dashboards</h3>
        <h4>{{ Auth::user()->name }}</h4>

        <h5 class="mt-2">Cliente</h5>
        @if (Auth::user()->perfil == null)
            <h5>Artur </h5>
        @endif

        <h5 class="mt-2">{{ Auth::user()->email }}</h5>

        <br>
        <a href="" data-bs-toggle="modal" data-bs-target="#modalColab"><i class="bi bi-person-fill-gear"> Editar Perfil</i></a>
        

        {{-- <form action="{{route('logout')}}" method="POST">
            @csrf
            <a><i class="bi bi-box-arrow-left"><strong> Cerrar Sesion</strong></i></a>
        </form> 
        
        ESTO ESTA COMENTADO POR UN DETALLITO DE POST entonces puse tipo get la ruta y quedo el de abajo
        --}}

        <a href="{{route('logout')}}"><i class="bi bi-box-arrow-left"><strong> Cerrar Sesion</strong></i></a>
        
        <div class="card" style="max-width: 18rem;">
            <div class="card mb-3" style="max-width: 18rem;">
                <div class="card-header">Solicitudes</div>
               
                    <div class="tablita overflow-auto" style="max-height: 230px; overflow-y: scroll;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Problema</th>
                                    <th scope="col">Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $item)
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#Detalle{{$item->id_ticket}}">
                                            {{$item->clasificacion}}
                                        </button>
                                    </td>
                                    <td>
                                        {{$item->estatus}}
                                    </td>
                                </tr>
                            </tbody>                                                                                                        
                            @endforeach                                                                           
                        </table>
                    </div>
                
            </div>
        </div>
    </div>

    @foreach ($tickets as $item)
    <!-- Modal Detalle Ticket -->
    <div class="modal fade" id="Detalle{{$item->id_ticket}}" tabindex="-1" aria-labelledby="Detalle" aria-hidden="true">
        <div class="modal-dialog modal-modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detalles de Seguimiento</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <span>Clasifiación</span><br>
                    <input type="text" class="form-control" value="{{$item->clasificacion}}" disabled>    
                </div>
                <div>
                    <span>Detalle</span><br>
                    <input type="text" class="form-control" value="{{$item->detalle}}" disabled>
                </div>
                <div>
                    <span>Seguimiento por:</span>
                    <input type="text" class="form-control" value="auxiliar" disabled>
                </div>
                <div>
                    <span>Comentarios del auxiliar</span>
                    <textarea cols="30" rows="3" class="form-control" disabled>...</textarea>
                </div>
                <div>
                    <span>Fecha de solicitud</span>
                    <input type="text" class="form-control" value="{{$item->created_at}}" disabled>
                </div>
            
            {{-- id de ticket {{$item->id_ticket}}  --}}
            </div>
            <div class="modal-footer">
            </div>
        </div>
        </div>
    </div>
    @endforeach

    <!-- CARD DE CLIENTES  -->

    <div class="container-cliente">
        <div class="card">
            <!-- Separación de la pagina en 2  -->
            <div class="row mt-4">
        
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-transparent"><h3>Solicitud de Tickets</h3></div>
                        <div class="cardbody">
        
                            <!-- Creacion del Formulario  -->
                            <div class="container">
                                <div class="card-body">
                                    <form action="/ticket" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="hidden" value="{{Auth::user()->name}}">
                                            <label class="form-label">Departamento</label>                                        
                                            <select name="txtDepartamento" class="form-select" aria-label="Default select example">
                                                <option selected disabled>Seleccione el departamento...</option>
                                                @foreach ($deptos as $dpto)
                                                    <option value="{{$dpto->id_dpto}}">{{$dpto->nombre}}</option>
                                                @endforeach                                                                                           
                                            </select>
                                        </div>

                                        <div class="contenedor-flexbox">
                                            <div class="mb-3">
                                                <label class="form-label">Clasificación</label>                                        
                                                <select name="txtClasificacion" class="form-select"  id="txtClasificacion" aria-label="Default select example">
                                                    <option selected disabled>Seleccione el problema que tiene...</option>
                                                    <option value="Falla de office">Falla de office</option>
                                                    <option value="Fallas en la red">Fallas en la red</option>
                                                    <option value="Errores de software">Errores de software</option>
                                                    <option value="Errores de hardware">Errores de hardware</option>
                                                    <option value="Mantenientos Preventivos">Mantenientos Preventivos</option>
                                                    <option value="Otro:">Otro:</option>                                                             
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">¿Cual?</label>
                                                <input name="txtCual" type="text" id="txtCual" class="form-control"  disabled>
                                            </div>                                                                                                                                    
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Descripcion:</label>
                                            <div>
                                                <textarea name="txtDescripcion" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-green">Enviar Ticket</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                <div class="col-md-6">
                    <!--Agregar tabla  -->
                    <div class="card ">
                        <div class="card-header bg-transparent mb-3"><h3>Consulta de Tickets</h3></div>
                        @foreach($tickets as $tick)
                        <div class="cardbody">                            
                            <div class="container">                    
                                <div class="card mb-2">
                                    <div class="contenedor-flexbox" style="margin-left: 20px">
                                        <label class="form-label mb-2 mt-2">{{$tick->clasificacion}}: {{$tick->detalle}} . . .</label>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Cancel{{$tick->id_ticket}}">Cancelar Ticket</button>
                                    </div>                                                                                     
                                </div>                    
                            </div>

                            <!-- Modal Confirmar Cancelar ticket-->
                            <div class="modal fade" id="Cancel{{$tick->id_ticket}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Cancel" aria-hidden="true">
                                <div class="modal-dialog modal-Center">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">¡Cuidado!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    ¿Seguro que quieres cancelar el ticket: {{$tick->clasificacion}}?
                                    </div>
                                    <form action="{{route('cancel',$tick->id_ticket)}}" method="POST" id="Cancel" name="Cancel">
                                    @csrf
                                    {!!method_field('PUT')!!}
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, regresa</button>
                                    <button type="submit" class="btn btn-primary">Si, cancelalo</button>
                                    </form>    
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
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

<script>    
    const select = document.getElementById('txtClasificacion');
    const input = document.getElementById('txtCual');

    select.addEventListener('change', function() {
        if (select.value === 'Otro:') {
            input.disabled = false;
        } else {
            input.disabled = true;
        }
    });

</script>

    @yield('codigo')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>