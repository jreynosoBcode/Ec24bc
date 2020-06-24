<?php
  header('Access-Control-Allow-Origin: *'); 
  
include('../../conexion.php');
$IDLUGAR=$_POST['id_lugar'];
$myarray = array();
$sqlquery="SELECT nombre,icon,direccion,latitud,longitud FROM lugares_favoritos WHERE id_lugar=$IDLUGAR";
$resultado = $mysqli->query($sqlquery);
if($fila = $resultado->fetch_assoc()){
		$lugar = array(utf8_encode($fila['nombre']),$fila['icon'],utf8_encode($fila['direccion']),$fila['latitud'],$fila['longitud']);
		echo json_encode($lugar);
}else{

}



?>