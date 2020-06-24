<?php
	header('Access-Control-Allow-Origin: *'); 
		
	include('../conexion.php');
	$mysqli->query("SET CHARSET 'utf8'");
	$IDPETICION = $_POST['id_peticion'];
	$CALIFICACION = $_POST['calificacion'];	

	$mysqli->query("UPDATE traslados SET calificacion_chofer='$CALIFICACION' WHERE id_peticion=$IDPETICION");
?>