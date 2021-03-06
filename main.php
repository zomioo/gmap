<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <?php require 'database.php';?>
  <!-- <link rel="shortcut icon" href=""> -->
  <title>Monitoreo de niveles de agua</title>

  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/estilos.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- modal -->
 <link rel="stylesheet" href="js/jquery-ui/jquery-ui.css">
 <script src="js/jquery-ui/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#dialog" ).dialog({
        resizable: true,
        modal: true,

      autoOpen: false,
      show: {
        effect: "fade",
        duration: 1000
      },
      hide: {
        effect: "slide",
        duration: 1000
      }
    });
 
    $( "#opener" ).click(function() {
      $( "#dialog" ).dialog( "open" );
    });
  });
  </script>
  <!-- /modal-->

  <script type="text/javascript">
    $(document).ready(function() {
      $("#recargable").load('cargar2.php');
      function cargando(){
       $("#recargable").load('cargar2.php');
       
      }
      setInterval(cargando, <?php echo $timer; ?>);
     
    });
  </script>
</head>
<body>
    <br>
    <div class="panel panel-primary">
    <div class="panel-heading">
      <div class="row">
        <div  class="col-md-12"><h3 style="color:white;" class="text-center"><strong>Panel de Control</strong></h3></div>
      </div>
    </div>

<!--  <datapicker>  --> 
    <div id="dialog" title="Seleccionar Estación y Período" >
     <?php
     $objdatabase = new Database();
     $sql = $objdatabase->prepare('SELECT Id, Id_Movil, EVE, Ser_Fecha, Ser_Hora, Latitud, Longitud
                                FROM  `sudamericana_monitoreo`
                                ORDER BY Id DESC '
                                );
      $sql->execute();
      $result = $sql->fetchAll();
    ?> 
    <form action="informe.php" method="post">
                    <b>Seleccione la Estación</b><br>
                    <select name="mov" >
                    <?php
                        foreach ($result as $key => $value) 
                            {?>
                          <option value="<?php echo $value['Id_Movil'];?>"><?php echo $value['Id_Movil'];?></option>
                      <?php }?>
                    </select><br><br>
                                            <b>Seleccione el Período</b><br>
                        <select name="mes" >
                        <?php

                                          $date = new DateTime();
                                          $anio= $date->format('Y');
                                          $anio2=$anio-1;
                                          $mes= $date->format('m'); echo $mes; 
                                          switch ($mes) {
                                            case '01':
                                              $ant1='12-'.$anio2;
                                              $ant2='11-'.$anio2;
                                              $ant3='10-'.$anio2;
                                              break;
                                           case '02':
                                              $ant1='01-'.$anio;
                                              $ant2='12-'.$anio2;
                                              $ant3='11-'.$anio2;
                                              break;
                                           case '03':
                                              $ant1='02-'.$anio;
                                              $ant2='01-'.$anio;
                                              $ant3='12-'.$anio2;
                                              # code...
                                              break;
                                           default:
                                              $ant1=$mes-1;
                                              $ant1=$ant1.'-'.$anio;
                                              $ant2=$mes-2;
                                              $ant2=$ant2.'-'.$anio;
                                              $ant3=$mes-3;
                                              $ant3=$ant3.'-'.$anio;
                                              break;
                                          }

                                            $ar= array('0' => $mes.'-'.$anio,
                                                    '1' => $ant1,
                                                    '2'=>$ant2,
                                                    '3'=>$ant3 );
                                  foreach ($ar as $key => $value) 
                                  {?>


                                         <option value="<?php echo $value;?>"><?php 
                                         if((strlen($value))==6){
                                            echo '0'.$value;
                                         }else{echo $value;}?>
                                       </option>


                                   <?php }?>




                          </select><br><br>
<input class="btn" type="submit" value="enviar" >
                        </form>


</div>

<a class="btn btn-primary btn-xs" href="#" id='opener'>Reportes Históricos</a>

<!--  </datapicker>  --> 

<br>
  <div class="row">
    <div class="panel-body col-md-6">
      <div id="recargable"></div>
    </div>
    <div  class="img-thumbnail col-md-6" >
      <object data="map.php" style="width: 100%; height: 400px;"></object>
    </div>
  </div>
</div>
  

</body>
</html>