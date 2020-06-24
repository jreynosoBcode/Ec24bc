<?php
	header('Access-Control-Allow-Origin: *'); 
		
	include('../conexion.php');
	$mysqli->query("SET CHARSET 'utf8'");
	
	$IDPETICION=$_POST['id_peticion'];
	$UBICACION="";
	$DESTINO="";
	$FECHA="";
	$HR_SALIDA="";
	$HR_LLEGADA="";
	$COSTO="";
	
	$mysqli->query("UPDATE peticiones SET estado='terminada' WHERE id_peticion=$IDPETICION");
	$sqlquery="SELECT ubicacion,destino,fecha,hora_salida,hora_llegada,costo FROM traslados WHERE id_peticion=$IDPETICION";
	$resultado = $mysqli->query($sqlquery);
	  while ($fila = $resultado->fetch_assoc()){
			$arrayDatos[] = array(
				0 => $fila['ubicacion'], 
				1 => $fila['destino'], 
				2 => $fila['fecha'], 
				3 => $fila['hora_salida'],
				4 => $fila['hora_llegada'],
				5 => $fila['costo']
			);
	    
	  }  
  
	  for ($i=0; $i <count($arrayDatos) ; $i++) { 
	  		$UBICACION=$arrayDatos[$i][0];
	  		$DESTINO=$arrayDatos[$i][1];
	  		$FECHA=$arrayDatos[$i][2];
	  		$HR_SALIDA=$arrayDatos[$i][3];
	  		$HR_LLEGADA=$arrayDatos[$i][4];
	  		$COSTO=$arrayDatos[$i][5];
	  }

	 $datos=array($UBICACION,$DESTINO,$FECHA,$HR_SALIDA,$HR_LLEGADA,$COSTO);
  	 echo json_encode($datos);
?>