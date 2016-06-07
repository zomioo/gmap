<?php 
  require 'database.php';

  $objdatabase = new Database();

  $sql = $objdatabase->prepare('SELECT Id, Id_Movil, EVE, Ser_Fecha, Ser_Hora, Latitud, Longitud
                                FROM  `sudamericana_monitoreo`
                                ORDER BY Id DESC '
                                );
  $sql->execute();

  $result = $sql->fetchAll();
  ?> 
  <div id="tiempo"><?php 
                    $date = new DateTime();
                    echo "<strong>Última actualización: </strong>" . $date->format('d-m-Y H:i:s');
                    ?>
  </div> 
  <br>
  
  <?php
  foreach ($result as $key => $value) {
    ?>
        <div style="/*border: solid 1px green;*/" class="text-center col-md-4">
          <div style="text-align: center;" >
            <h2 style="font-weight:bold;"><?php echo $value['Id_Movil'];?></h2>
            <p style="font-size: 12px;"><?php $fec = explode('-', ($value['Ser_Fecha']));
                                              echo($fec[2].'-'.$fec[1].'-'.$fec[0]);?>
            <?php echo ' ' . $value['Ser_Hora'];?></p>
          </div>
        </div>
        
        <div style="" class="text-center col-md-2">
          <div style="color: #fff;border-radius: 10px; height: 80%; width: 50%; padding:5px; margin:5px; box-shadow: 0px 3px 3px 3px rgba(0, 0, 0, 0.3);
            <?php if ($value['EVE'] == (07)) {
              echo "background-color: green;";
            } else echo "background-color: red"; 
            ?>"
            ><h2 ><?php echo $value['EVE'];?></h2>    
          </div>
        </div>
     
    <?php
  }
  
?>
