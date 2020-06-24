<?php
header('Access-Control-Allow-Origin: *');

require '../conexion.php';

$IDPETICION = $_POST['id_peticion'];
$ESTADO=$_POST['estado'];

$sqlquery = "update peticiones set estado='".$ESTADO."' WHERE id_peticion=$IDPETICION";
$resultado = $mysqli->query($sqlquery);

if ($resultado->affected_rows) {
    echo "successful";
} else {
    echo "something went wrong";
}
?>
	  
