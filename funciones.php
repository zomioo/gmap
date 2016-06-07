<?php

function  conexion(){
	global $conexion;
	$conexion = mysql_connect("200.61.152.103","gpssuda","w70mjj");
	mysql_select_db("gps",$conexion) OR die ("error". mysql_errno());
	mysql_query("SET NAMES 'utf8'");
	if(!$conexion)
	{
		echo "Error en la conexion";
	}
}

function  conexion1(){
	global $conexion;
	$conexion = mysql_connect("200.61.152.103","gpsmpc","xfy81");
	mysql_select_db("gps",$conexion) OR die ("error". mysql_errno());
	mysql_query("SET NAMES 'utf8'");
	if(!$conexion)
	{
		echo "Error en la conexion";
	}
}

      function centros($array)
           {
          $minlon=99;
          $maxlon=-99;
          $minlat=99;
          $maxlat=-99;
               while($row=mysql_fetch_array($array))
                          
                {
                    if ($row['lat']<$minlat){
                        $minlat=$row['lat'];
                    }
                     if ($row['lat']>$maxlat){
                        $maxlat=$row['lat'];
                    }

                     if ($row['lon']<$minlon){
                        $minlon=$row['lon'];
                    }
                     if ($row['lon']>$maxlon){
                        $maxlon=$row['lon'];
                    }
                 }
           
            echo "var clat =". $minlat+(($maxlat-$minlat)/2).";\n";
            echo "var clon =".$minlon+(($maxlon-$minlon)/2).";\n";
           
           
           }



 function distancia($lat2,$lon2,$lat1,$lon1){
  $lat1=M_PI/180*$lat1;
  $lon1=M_PI/180*$lon1;
  $lat2=M_PI/180*$lat2;
  $lon2=M_PI/180*$lon2;


    $zt1=sin($lat1) * sin($lat2);
   
    $zt2 = cos($lat1)* cos($lat2)*cos($lon2-$lon1);
   
    $zt3= $zt1 + $zt2;

   
    $zt4=acos($zt3);
    //$dis = $t4*6378137
    return $zt4*6378137;
  }




function distHav2 ($lat2,$lon2,$lat1,$lon1){
  
  $lat1=M_PI/180*$lat1;
  $lon1=M_PI/180*$lon1;
  $lat2=M_PI/180*$lat2;
  $lon2=M_PI/180*$lon2;
        $radiusOfEarth = 6378137;// Earth's radius in meters.
        $diffLatitude = abs($lat2 - $lat1);
        $diffLongitude = abs($lon2 - $lon1);
        $a = sin($diffLatitude / 2) * sin($diffLatitude / 2) +
            cos($lat1) * cos($lat2) *
            sin($diffLongitude / 2) * sin($diffLongitude / 2);
        $c = 2 * asin(sqrt($a));
        $distance = $radiusOfEarth * $c;
        return $distance;
    }


    function tiempoIntervalo($strStart,$strEnd){

  //Echo'hola';
   $dteStart = new DateTime($strStart); 
   $dteEnd   = new DateTime($strEnd); 
   $dteDiff  = $dteStart->diff($dteEnd); 
   //echo $dteDiff;
   $a =strval($dteDiff->format("%H:%I:%S")); 
   //echo$a;
    
    return $a;
}
    function velocidad($di,$tiem){
    list($h, $m, $s) = explode(':', $tiem); 
    $ma=$m/60;
    $sa= $s/3600;
    $ha=$h+$ma+$sa;
    if ($ha>0){
        $vel=($di/1000)/$ha;
    }else{$vel=0;}
    
    return  $vel;
    }
?>
