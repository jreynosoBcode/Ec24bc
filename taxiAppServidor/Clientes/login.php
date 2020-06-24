<?php
  header('Access-Control-Allow-Origin: *'); 
  
  include('../conexion.php');


$CORREO=$_POST['correo'];
$PASSWORD=$_POST['password'];

$sqlquery="SELECT id_cliente,correo,contrasena FROM clientes WHERE correo='$CORREO' AND contrasena='$PASSWORD'";
$resultado = $mysqli->query($sqlquery);
if (mysqli_num_rows($resultado)>0) {
		$fila = $resultado->fetch_assoc();	
		$IDCLIENTE=$fila['id_cliente'];
		$datos=array($fila['id_cliente']);
		echo json_encode($datos);
}else{
		$datos=array("UNSUCCESSFUL");
		echo json_encode($datos);
}



?>
