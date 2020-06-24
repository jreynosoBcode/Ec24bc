	<?php
	header('Access-Control-Allow-Origin: *'); 
	
	require '../conexion.php';
        
	$IDCHOFER=$_POST['id_chofer'];

	$sqlquery="SELECT * FROM peticiones WHERE id_chofer=$IDCHOFER AND estado='esperando'";
	$resultado = $mysqli->query($sqlquery);

        if($resultado->num_rows>0) { 
			$fila = $resultado->fetch_assoc();

			$DATOS_PETICION = array("id_peticion"=>$fila['id_peticion'],
				"id_cliente"=>$fila['id_cliente'],
				"latitud_ubicacion"=>$fila['latitud_ubicacion'],
				"longitud_ubicacion"=>$fila['longitud_ubicacion'],
				"latitud_destino"=>$fila['latitud_destino'],
				"longitud_destino"=>$fila['longitud_destino'],
				"texto_direccion"=>$fila['mensaje']
			);
			echo json_encode($DATOS_PETICION);
	}else{

	}


//	$sqlquery="SELECT id_chofer,matricula FROM ubicacion_taxi WHERE ";
?>
	  
