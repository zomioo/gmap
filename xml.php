<?xml version="1.0" encoding="UTF-8"?>
<markers>
<?php 
  require 'database.php';
  $objdatabase = new Database();
  $sql = $objdatabase->prepare("SELECT Id, Id_Movil, EVE, CONCAT(Ser_Fecha,' ',Ser_Hora) FH, Latitud la, Longitud lo
                                FROM  sudamericana_monitoreo 
                                ORDER BY Id DESC");
  $sql->execute();
  $result = $sql->fetchAll();
  foreach ($result as $key => $value) {
    ?>
    <marker status="<?php 
    if( $value['EVE']=='07'){
      echo 'free';
    }else{
      echo 'busy';
    }
    ?>" EVE="<?php echo $value['EVE'];?>" id="<?php echo $value['Id_Movil'];?>"lat="<?php echo $value['la'];?>" lng="<?php echo $value['lo'];?>" FH="<?php 
                                                                                   $date1 = date_create($value['FH']); 
                                                                                   echo date_format($date1, 'd/m/Y H:i:s');
                                                                                   ?>"/>
  <?php
  }
?>
</markers>
