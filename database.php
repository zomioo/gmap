<?php 
//$timer=10000;
$timer=60000;
	class Database extends PDO{
		
		public function __construct(){
			try {
				parent::__construct('mysql:host=200.61.152.103;dbname=gps','gpssuda','w70mjj');
				//parent::__construct('mysql:host=localhost;dbname=gps','root','');
				parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
			} catch (Exception $e) {

				die('<div class="alert alert-danger" role="alert">Hubo un problema con la base de datos</div>');	
			}
		}
	}
?>