	<?php
	header('Access-Control-Allow-Origin: *'); 
	
	include('../conexion.php');
	$CORREO=$_POST['correo'];
	$PASS=$_POST['password'];
	$NOMBRE=$_POST['nombre'];
	$APELLIDOP=$_POST['apellidop'];
	$APELLIDOM=$_POST['apellidom'];
	//$TEL=$_POST['tel'];
	$CEL=$_POST['cel'];
	$CALLE=$_POST['calle'];
	$NUMERO=$_POST['numero'];
	$COLONIA=$_POST['colonia'];
	$CP=$_POST['cp'];
	$FECHANAC=$_POST['fechanac'];
	

	$sqlquery="INSERT INTO clientes
			(nombre,contrasena,apellidopaterno,apellidomaterno,fechanacimiento,genero,celular,telefono,calle,colonia,numero,cp,foto,fecha_registro,id_cliente,correo,forma_registro)
			VALUES
			('$NOMBRE','$PASS','$APELLIDOP','$APELLIDOM','$FECHANAC','M','$CEL','0','$CALLE','$COLONIA','$NUMERO','$CP',NULL,NOW(),NULL,'$CORREO','1')";
	
	if ($mysqli->query($sqlquery) === TRUE) {
			

	} else {
	    echo "Error: " . $sqlquery . "<br>" . $mysqli->error;
	}
	

	
?>
	  
