<?php 
	header('Access-Control-Allow-Origin: *'); 
		
	include('../conexion.php');
	$IDCHOFER=$_POST['id_chofer'];
	$IDPETICION=$_POST['id_peticion'];
	$LAT_TAX="";
	$LON_TAX="";
	$LAT_CLI="";
	$LON_CLI="";


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

  	$sqlquery="SELECT latitud_ubicacion,longitud_ubicacion FROM peticiones WHERE id_peticion=$IDPETICION";
    $resultado = $mysqli->query($sqlquery);
	  while ($fila = $resultado->fetch_assoc()){
			$arrayCliente[] = array(
				0 => $fila['latitud_ubicacion'], 
				1 => $fila['longitud_ubicacion']
			);
	    
	  }  

  for ($i=0; $i <count($arrayCliente) ; $i++) { 
  		$LAT_CLI=$arrayCliente[$i][0];
  		$LON_CLI=$arrayCliente[$i][1];
  }

  $ubicacion=array($LAT_TAX,$LON_TAX,$LAT_CLI,$LON_CLI);
  echo json_encode($ubicacion);
?>