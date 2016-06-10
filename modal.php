<!doctype html>
<html lang="en">
<head>
  <?php require_once 'database.php';?>
  <meta charset="utf-8">
  <title>jQuery UI Dialog - Modal confirmation</title>
  <link rel="stylesheet" href="js/jquery-ui/jquery-ui.css">
  <script src="js/jquery-1.12.0.min.js"></script>
  <script src="js/jquery-ui/jquery-ui.js"></script>
  <style type="text/css">
  body {
  font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
  font-size: 70%;
  }
  </style>
  

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
</head>
<body>

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
<!-- <a class="btn btn-default" href="#" id='opener'>Reportes Históricos</a> -->
</body>
</html>