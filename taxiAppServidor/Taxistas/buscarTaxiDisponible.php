	<?php
	header('Access-Control-Allow-Origin: *'); 
	
        require '../conexion.php';
	
	$IDCLIENTE=$_POST['id_cliente'];
	$UBICACIONLAT=$_POST['latitud_ubicacion'];
	$UBICACIONLONG=$_POST['longitud_ubicacion'];
	$DESTINOLAT=$_POST['latitud_destino'];
	$DESTINOLONG=$_POST['longitud_destino'];
	$NOUNIDADES=$_POST['no_unidades'];
	$IDPETICION="";

	$sqlquery="INSERT INTO peticiones 
		(id_peticion,id_cliente,latitud_ubicacion,longitud_ubicacion,latitud_destino,longitud_destino,fecha_hora,no_unidades) 
		VALUES (NULL,$IDCLIENTE,'$UBICACIONLAT','$UBICACIONLONG','$DESTINOLAT','$DESTINOLONG',NOW(),$NOUNIDADES)";
	
	if ($mysqli->query($sqlquery) === TRUE) {
			$IDPETICION=mysql_insert_id();
			echo $IDPETICION;
	} else {
	    echo "Error: " . $sqlquery . "<br>" . $mysqli->error;
	}

	$sqlquery="SELECT id_chofer,matricula FROM ubicacion_taxi WHERE ";
?>
	  
