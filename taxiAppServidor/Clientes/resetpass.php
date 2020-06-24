<?php
  header('Access-Control-Allow-Origin: *'); 
  
  include('../conexion.php');

$CORREO=$_POST['correo'];
$PASSWORD=$_POST['pass'];

$CORREO=base64_decode($CORREO);

$sqlquery="SELECT correo from clientes WHERE correo='$CORREO'";
$resultado = $mysqli->query($sqlquery);
if ($resultado->num_rows > 0) {
	$sqlquery2="UPDATE clientes set contrasena='$PASSWORD'  WHERE correo='$CORREO'";
	$mysqli->query($sqlquery2);
	$datos=array("1");
  	
}else{
	$datos=array("0");
}

echo json_encode($datos);
?>
