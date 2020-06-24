<?php
	header('Access-Control-Allow-Origin: *'); 
		
	include('../conexion.php');
	$mysqli->query("SET CHARSET 'utf8'");
	$IDCLIENTE=$_POST['id_cliente'];
	$NOMBRE=$_POST['nombre'];
	$APP=$_POST['apellidop'];
	$APM=$_POST['apellidom'];
	$TEL=$_POST['tel'];
	$CEL=$_POST['cel'];
	$CALLE=$_POST['calle'];
	$NUM=$_POST['num'];
	$COL=$_POST['col'];
	$CP=$_POST['cp'];
	$GENERO=$_POST['genero'];

	$mysqli->query("UPDATE clientes SET nombre='$NOMBRE',apellidopaterno='$APP', apellidomaterno='$APM', calle='$CALLE',colonia='$COL',numero='$NUM',cp='$CP',genero='$GENERO', telefono='$TEL', celular='$CEL' WHERE id_cliente=$IDCLIENTE");
?>