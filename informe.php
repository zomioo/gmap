<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

  <!-- <link rel="shortcut icon" href=""> -->
  <title>Monitoreo de niveles de agua</title>

  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/Bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="css/estilos.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://localhost/gmaps/bootstrap/js/bootstrap.min.js"></script>

      <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
       
      }

  .table .table-hover: hover{
            color: red;
            background-color: yellow;
            font-family: "Lucida Grande", "Arial", sans-serif;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            width: 40px;     
            border: 2px solid black;
            white-space: nowrap;
       }
       .table-hover tbody tr:hover td {
        background-color: #ccc;
        font-size:105%; 
        font-weight: bold;
}
</style>
</head>
<body>
  <br>

 <div class="panel panel-primary"> 
  <div  class="panel-heading ">
      <div class="row">
        <div  class="col-md-12"><h3 style="color:white;" class="text-center"><strong>Panel de Control</strong></h3></div>
      </div>
  </div>
    
<div style="width: 100%; margin-top:1%;" class="img-thumbnail" >
<strong> Informe de la Estación: <?php echo $_POST['mov'];?>   en el    Período: <?php echo $_POST['mes'];?></strong></h3>
  
<br><br>
  <table style="width: 95%; margin:1% 2.5%;" class="table table-striped table-hover table-bordered">
  <thead>
  <tr>
    <th class="text-center">Inicio</th>
    <th class="text-center">Fin</th>
    <th class="text-center">Duración</th>
  </tr>
  </thead>
  <tbody>
  <?php 
  require 'database.php';
  require 'funciones.php';

  if (isset($_POST['mes'])){
  $mov= $_POST['mov'];
  $mes= $_POST['mes'];    




  $objdatabase = new Database();
  $query="select r.Latitud as lat ,r.Longitud as lon, r.EVE ,CONCAT(r.Fecha,' ',r.Hora)as dt,DATE_FORMAT(r.Fecha,'%m-%Y') ma,r.Id_Movil 
        from gps.sudamericana_reportes r 
        where r.Id_Movil = '".$mov."' and r.EVE in (04,07) 
        having ma='".$mes."'
        order by dt";



  $sql = $objdatabase->prepare($query);
  $sql->execute();

  $result = $sql->fetchAll();
  $auxE='07';

  foreach ($result as $key => $value) {

  // echo $value['EVE'].' ' .$value['dt'].'<br>';

   if ($value['EVE']=='07' and $auxE== '04'){
        
      $date1 = date_create($value['dt']); 
      $date = date_create($auxF); 
      echo '<tr>
                <td class="text-center">'. date_format($date, 'd/m/Y H:i:s').'</td>
                <td class="text-center"> '. date_format($date1, 'd/m/Y H:i:s').'</td><td class="text-center">' ;
                $duracion= tiempoIntervalo($auxF,$value['dt']);
                echo $duracion.'</td></tr>';
    
     
   }
     $auxE=$value['EVE'];
     $auxF=$value['dt'];
  }}else{
    ?> <tr><td colspan="3" class="default">No hay registros para mostrar</td></tr> 
  <?php } 

?>
  </tbody>
 </table>
 <?php
//Echo $query;
?>
 </div>

 </div>
</body>
