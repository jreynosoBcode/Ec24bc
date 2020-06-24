<?php
	header('Access-Control-Allow-Origin: *'); 
		
	include('../conexion.php');
	$mysqli->query("SET CHARSET 'utf8'");
	$IDCLIENTE=$_POST['id_cliente'];
	$EFECTIVO=$_POST['metodo1'];
	$PAYPAL=$_POST['metodo2'];

	$sqlquery="SELECT id_cliente FROM metodo_pago WHERE id_cliente=$IDCLIENTE ";
	$resultado = $mysqli->query($sqlquery);

if ($resultado -> num_rows > 0) {
	$mysqli->query("UPDATE metodo_pago SET forma_pago='$EFECTIVO',forma_pago2='$PAYPAL' WHERE id_cliente=$IDCLIENTE");
}
else{
	$mysqli->query("INSERT INTO metodo_pago (id_formapago, id_cliente, forma_pago, forma_pago2) VALUES (NULL,'$IDCLIENTE','$EFECTIVO','$PAYPAL')");
}
?>