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

  <?php 
  require 'database.php';
  require 'funciones.php';

  $objdatabase = new Database();

  $sql = $objdatabase->prepare("SELECT r.EVE,CONCAT(r.Ser_Fecha,' ',r.Ser_Hora) FH
                                FROM `gps`.`sudamericana_reportes` r
                                where (r.EVE = 04 or r.EVE = 07)
                                and r.Id_Movil=1012
                                ORDER BY  `FH` desc LIMIt 500;");
  $sql->execute();

  $result = $sql->fetchAll();
  ?> 


      <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
       
      }
  #mapa {
        height: 93%;
        width: 80%;
        float: left;
        position: relative;
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
 <div class="container"> 
  
  <table  class="table table-striped table-hover table-bordered">
  <thead>
  <tr>
    <th>Firstname</th>
    <th>Firstname</th>
    <th>Firstname</th>
  </tr>
  </thead>
  <tbody>
  <?php
  $auxE='07';

  foreach ($result as $key => $value) {

   //echo $value['EVE'].' ' .$value['FH'].'<br>';
   if ($value['EVE']=='04' and $auxE== '07'){
        
      $date1 = date_create($value['FH']); 
      $date = date_create($auxF); 
      echo '<tr>
                <td>'.  date_format($date1, 'd/m/Y H:i:s').'</td>
                <td> '. date_format($date, 'd/m/Y H:i:s').'</td><td>' ;
                $duracion= tiempoIntervalo($value['FH'],$auxF);
                echo $duracion.'</td></tr>';
     }
     $auxE=$value['EVE'];
     $auxF=$value['FH'];
  
  }

?>
  </tbody>
 </table>
 </div>
</body>
