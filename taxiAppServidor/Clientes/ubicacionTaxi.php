<?php

header('Access-Control-Allow-Origin: *'); 
		
	include('../conexion.php');
	$IDCHOFER=$_POST['id_chofer'];
	$LAT_TAX="";
	$LON_TAX="";


	$sqlquery="SELECT latitud,longitud FROM ubicacion_taxi WHERE id_chofer=$IDCHOFER";
	$resultado = $mysqli->query($sqlquery);
  	while ($fila = $resultado->fetch_assoc()){
		$arrayTaxi[] = array(
			0 => $fila['latitud'], 
			1 => $fila['longitud']
		);
    
  }  

  
  for ($i=0; $i <count($arrayTaxi) ; $i++) { 
  		$LAT_TAX=$arrayTaxi[$i][0];
  		$LON_TAX=$arrayTaxi[$i][1];
  }

  $ubicacion=array($LAT_TAX,$LON_TAX);
  echo json_encode($ubicacion);

?>