<?php
  header('Access-Control-Allow-Origin: *'); 
  
include('../../conexion.php');

$IDCLIENTE=$_POST['id_cliente'];
$myarray = array();
$sqlquery="SELECT id_lugar,nombre,icon,direccion,latitud,longitud FROM lugares_favoritos WHERE id_cliente=$IDCLIENTE";
$resultado = $mysqli->query($sqlquery);
while ($fila = $resultado->fetch_assoc()) {
	$myarray[] = array(
			0 => $fila['id_lugar'], 
			1 => $fila['nombre'], 
			2 => $fila['icon'],
			3 => $fila['direccion'],
			4 => $fila['latitud'], 
			5 => $fila['longitud']
	);
	
}
echo json_encode($myarray);

?>