<?php
	header('Access-Control-Allow-Origin: *');


	include('../conexion.php');
	$IDPETICION=$_POST['id_peticion'];
	$LAT_UBI="";
	$LON_UBI="";
	$LAT_DES="";
	$LON_DES="";

	$sqlquery="SELECT latitud_ubicacion,longitud_ubicacion,latitud_destino,longitud_destino FROM peticiones WHERE id_peticion=$IDPETICION";
	$resultado = $mysqli->query($sqlquery);
  	while ($fila = $resultado->fetch_assoc()){
		$arrayDatos[] = array(
			0 => $fila['latitud_ubicacion'], 
			1 => $fila['longitud_ubicacion'],
			2 => $fila['latitud_destino'], 
			3 => $fila['longitud_destino']
		);
    
  }  

  
  for ($i=0; $i <count($arrayDatos) ; $i++) { 
  		$LAT_UBI=$arrayDatos[$i][0];
  		$LON_UBI=$arrayDatos[$i][1];
  		$LAT_DES=$arrayDatos[$i][2];
  		$LON_DES=$arrayDatos[$i][3];
  }

  $ubicacion=array($LAT_UBI,$LON_UBI,$LAT_DES,$LON_DES);
  echo json_encode($ubicacion);
?>