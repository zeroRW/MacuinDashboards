<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pdf</title>
</head>
<body>
    <H1>Macuins Dashboards</H1>
    <H2>Reporte de tickets</H2>


    <div>
        <div>
            <label><strong>Generado por: </strong></label>
            <p>_______________________________________________</p>
        </div>
        <div>
            <label><strong>Tickets: </strong></label>  
        @foreach ($tickets as $item)
              <div>

               <label>Clasificación</label> 
               <br>
               <label>Detalle: </label>
               <br>
               <label>Estatus: </label>
               <br>
            </div>
            
            <p>_______________________________________________</p>
        @endforeach    
        </div>
       
        <div>
            <label> <strong> ...: </strong></label>
            <br>
               <label>...: </label>
            <p>_______________________________________________</p>
        </div>
    </div>
    
</body>
</html>