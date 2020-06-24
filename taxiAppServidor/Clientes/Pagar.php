<?php
	header('Access-Control-Allow-Origin: *'); 
		
	include('../conexion.php');
	$IDPETICION=$_POST['id_peticion'];

	$mysqli->query("UPDATE traslados SET status_pago='pagado' WHERE id_peticion=$IDPETICION");
?>