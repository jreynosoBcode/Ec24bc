<?php 
	header('Access-Control-Allow-Origin: *'); 
		
	include('../conexion.php');
	$IDPETICION=$_POST['id_peticion'];
	$mysqli->query("UPDATE peticiones SET estado='cancelada' WHERE id_peticion=$IDPETICION");

?>