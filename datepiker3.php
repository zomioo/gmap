<head>
<script src="jquery-1.9.0.js" type="text/javascript"></script>
<script src="js/moment.min.js" type="text/javascript"></script>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
<script src="js/daterangepicker.js" type="text/javascript"></script>
<link href="js/daterangepicker.css" rel="stylesheet" type="text/css"/>

<!--<link href="osx/css/demo.css" rel="stylesheet" type="text/css"/>
<link href="osx/css/osx.css" rel="stylesheet" type="text/css"/>
<script src="osx/js/m.js" type="text/javascript"></script>-->
<link href="osx/css/demo.css" rel="stylesheet" type="text/css"/>
<link href="osx/css/osx.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php 
require_once 'funciones.php';
conexion();
          
                  $result=mysql_query("select m.Id_movil as id, m.Alias as m 
from gps.sudamericana_ultpos as  u         
join gps.sudamericana_moviles as m on  u.Id_Movil = m.Id_movil
where u.Latitud <0 and u.Longitud <0 and u.Ser_Fecha >  '2016-01-01'");
?>  

    
    
<div id="modal">

  <div id='scontainer'>
	
	<div id='cxontent'>
		<div id='osx-modal'>

			 <a href='#' class='osx'>Reportes Historicos</a>
		</div>
	
		<!-- modal content -->
		<div id="osx-modal-content">
			<div id="osx-modal-title">Selecciones Movil y Rango de fecha</div>
			<div class="close"><a href="#" class="simplemodal-close">x</a></div>
			<div id="osx-modal-data">
			
                        <form action="linea4.php" method="post">
                                                  <b>Seleccione el movil</b><br>
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
                                          $mes= $date->format('m');
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


                                         <option value="<?php echo $value;?>"><?php echo $value;?></option>


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
</body> 