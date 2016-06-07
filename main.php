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
  <link href="http://localhost/gmaps/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="http://localhost/gmaps/css/estilos.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://localhost/gmaps/bootstrap/js/bootstrap.min.js"></script>
  <!-- Data Picker -->
   <script src="js/moment.min.js" type="text/javascript"></script> 
   <script src="js/daterangepicker.js" type="text/javascript"></script>
   <link href="js/daterangepicker.css" rel="stylesheet" type="text/css"/>
   <link href="osx/css/demo.css" rel="stylesheet" type="text/css"/>
   <link href="osx/css/osx.css" rel="stylesheet" type="text/css"/>






  
  <script type="text/javascript">

    $(document).ready(function() {
      $("#recargable").load('cargar2.php');
      function cargando(){
       $("#recargable").load('cargar2.php');
       
      }

      setInterval(cargando, <?php echo $timer; ?>);

      // $("btn-mapa").click(function(){
      //   $("p").toggle();
      // });
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
    <?php
     $objdatabase = new Database();
    $sql = $objdatabase->prepare('SELECT Id, Id_Movil, EVE, Ser_Fecha, Ser_Hora, Latitud, Longitud
                                FROM  `sudamericana_monitoreo`
                                ORDER BY Id DESC '
                                );
      $sql->execute();

       $result = $sql->fetchAll();



    ?> 
  <div id="modal">
    <div id='scontainer'>
      <div id='cxontent'>
        <div id='osx-modal'>
           <a href='#' class='osx'>Reportes Historicos</a>
        </div>
        <div id="osx-modal-content">
            <div id="osx-modal-title">Selecciones Movil y Rango de fecha
            </div>
                <div class="close"><a href="#" class="simplemodal-close">x</a>
                </div>
                    <div id="osx-modal-data">
                       <form action="informe.php" method="post">
                          <b>Seleccione el movil</b><br>
                          <select name="mov" >
                          <?php
                              foreach ($result as $key => $value) 
                                  {?>
                                <option value="<?php echo $value['Id_Movil'];?>"><?php echo $value['Id_Movil'];?></option>
                            <?php }?>
                          </select><br><br>
                          <b>Seleccione Rango Fecha</b><br>
                          <input type="text" name="daterange"  />
                          <input type="submit" value="enviar">
                        </form> 
                        <p> </p><span>(ESC o click fuera del modal para cancelar)</span>
                    </div>
                </div>
            </div>
        </div>  
    
    <script src="osx/js/osx.js" type="text/javascript"></script>
<script src="osx/js/jquery.simplemodal.js" type="text/javascript"></script>
   
</div>
<script type="text/javascript">
$(function() {
    $('input[name="daterange"]').daterangepicker({
        timePicker: true,
        timePickerIncrement: 10,
        timePicker24Hour: true,
        locale: {
            format: 'YYYY-MM-DD HH:mm '
        }
    });
});
</script>

<!--  </datapicker>  --> 

    <div class="panel-body">
      <div id="recargable"></div>
    </div>
    <div  class="img-thumbnail" style="width: 950px; height: 400px;">
  <object data="map.php" style="width: 100%; height: 400px;"></object>
</div>
  </div>
  

</body>
</html>

