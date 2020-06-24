	<?php
	header('Access-Control-Allow-Origin: *'); 
	
include('../conexion.php');
	$IDCLIENTE=$_POST['id_cliente'];
	$UBICACIONLAT=$_POST['latitud_ubicacion'];
	$UBICACIONLONG=$_POST['longitud_ubicacion'];
	$DESTINOLAT=$_POST['latitud_destino'];
	$DESTINOLNG=$_POST['longitud_destino'];
	$IDPETICION="";

	$absCLIENTE=abs($UBICACIONLAT)+abs($UBICACIONLONG);

	$sqlquery="SELECT * FROM ubicacion_taxi WHERE estado='libre'";
	$resultado = $mysqli->query($sqlquery);
  while ($fila = $resultado->fetch_assoc()){
  	$ABSU=abs($fila['latitud'])+abs($fila['longitud']);
  	
		$arrayDatos[] = array(
			0 => $fila['matricula'], 
			1 => $fila['id_chofer'], 
			2 => $fila['latitud'], 
			3 => $fila['longitud'],
			4 => $fila['fecha_hora'],
			5 => $ABSU
		);
    
  }
	 
	foreach($arrayDatos as $clave=>$row){
	    $absolute[$clave]=$row[5];
	}
	array_multisort($absolute, SORT_ASC, $arrayDatos);

	for ($i=0; $i <3 ; $i++) { 
		$MATRICULA=$arrayDatos[$i][0];
		$IDCHOFER=$arrayDatos[$i][1];
		
		$sqlquery="INSERT INTO peticiones 
		(id_peticion,id_cliente,id_chofer,matricula,latitud_ubicacion,longitud_ubicacion,latitud_destino,longitud_destino,estado,hora_aceptada,hora_salida,hora_llegada) 
		VALUES (NULL,'$IDCLIENTE','$IDCHOFER','$MATRICULA','$UBICACIONLAT','$UBICACIONLONG','$DESTINOLAT','$DESTINOLNG','esperando',NOW(),NOW(),NOW())";
		
		if ($mysqli->query($sqlquery) === TRUE) {
				$IDPETICION=$mysqli->insert_id;
				$sqlquery="SELECT estado FROM peticiones WHERE id_peticion=$IDPETICION";
				$contador=0;
				while ($contador<15) {
				    // poll database for changes which is a bad idea.
					if($contador==14)
					{
	    				$mysqli->query("UPDATE peticiones SET estado='cancelada' WHERE id_peticion=$IDPETICION");
					    if($i==2){
					    	$estado="cancelada";
	    			    	$chofer=array($IDPETICION,$IDCHOFER,$MATRICULA,$estado);
							echo json_encode($chofer);
	    			    	$i=4;
	    			    	$contador=15;	    			    	
					    }else{
					    	$contador=15;	
					    }
					}else{
					    $resultado = $mysqli->query($sqlquery);
	    			    if($resultado->num_rows === 0)
	    			    {
	    			        //echo '<br>No results';
	    			        //$i=20;
	    			    }else{
	    			    		$fila = $resultado->fetch_assoc();
	    			    		if ($fila['estado']=="cancelada") {
	    			    			$estado="cancelada";
	    			    			$chofer=array($IDPETICION,$IDCHOFER,$MATRICULA,$estado);
									echo json_encode($chofer);
	    			    			$i=4;
	    			    			$contador=15;
	    			    		}
	    			    		if ($fila['estado']=="aceptada") {
	    			    			$estado="aceptada";
	    			    			$chofer=array($IDPETICION,$IDCHOFER,$MATRICULA,$estado,$ABSU,$absCLIENTE);
									echo json_encode($chofer);
	    			    			$i=4;
	    			    			$contador=15;
	    			    		}
	    			    }
					}					
					$contador=$contador+1;
				    sleep(1); // sleep 1 second
				}
				//echo "OK";
		} else {
		    echo "Error: " . $sqlquery . "<br>" . $mysqli->error;
		}
	}
	
?>
	  
