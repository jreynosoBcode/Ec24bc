<?php
header('Access-Control-Allow-Origin: *'); 

require '../conexion.php';

$myarray = array();
$sqlquery="SELECT matricula,id_chofer,latitud,longitud,estado FROM ubicacion_taxi";
$resultado = $mysqli->query($sqlquery);
while ($fila = $resultado->fetch_assoc()) {
	$LATLONG=abs($fila['latitud'])+abs($fila['longitud']);
	$myarray[] = array(
			0 => $fila['matricula'], 
			1 => $fila['id_chofer'], 
			2 => $fila['latitud'],
			3 => $fila['longitud'],
			4 => $fila['estado']
	);
	
}
echo json_encode($myarray);

?>