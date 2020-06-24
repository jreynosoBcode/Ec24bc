	<?php
	header('Access-Control-Allow-Origin: *'); 
	
	include('../../conexion.php');

	$IDCLIENTE=$_POST['id_cliente'];
	$NOMBRE=$_POST['nombre'];
	$LAT=$_POST['latitud'];
	$LNG=$_POST['longitud'];
	$DIRECCION=$_POST['direccion'];
	$ICON=$_POST['icon'];

	$sqlquery="INSERT INTO lugares_favoritos 
		(id_lugar,id_cliente,latitud,longitud,direccion,nombre,icon) 
		VALUES (NULL,$IDCLIENTE,'$LAT','$LNG','$DIRECCION','$NOMBRE','$ICON');";
	
	if ($mysqli->query($sqlquery) === TRUE) {
			
	} else {
	    echo "Error: " . $sqlquery . "<br>" . $mysqli->error;
	}
	

	
?>
	  
