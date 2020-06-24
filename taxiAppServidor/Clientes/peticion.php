	<?php
	header('Access-Control-Allow-Origin: *'); 
	
	include('../conexion.php');
	
$IDPETICION=$_POST['id_peticion'];
$sqlquery="SELECT estado FROM peticiones WHERE id_peticion=$IDPETICION";
$resultado = $mysqli->query($sqlquery);
$fila = $resultado->fetch_assoc();
echo $fila['estado'];
?>
	  
