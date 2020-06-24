<?php
  header('Access-Control-Allow-Origin: *'); 
  
  include('../conexion.php');

$IDTRASLADO=$_POST['id_traslado'];


$sqlquery="SELECT choferes.nombre, choferes.apellidopaterno,choferes.apellidomaterno, traslados.fecha,traslados.hora_salida,traslados.hora_llegada,traslados.ubicacion,traslados.destino,traslados.matricula,traslados.costo, traslados.matricula FROM traslados,choferes WHERE id_traslado=$IDTRASLADO AND traslados.id_chofer=choferes.id_chofer";
$resultado = $mysqli->query($sqlquery);
$fila = $resultado->fetch_assoc();
$NOMBRECHOFER=utf8_encode($fila['nombre'])." ".utf8_encode($fila['apellidopaterno'])." ".utf8_encode($fila['apellidomaterno']);
$detalles = array($fila['fecha'],$fila['hora_salida'],$fila['hora_llegada'],utf8_encode($fila['ubicacion']),utf8_encode($fila['destino']),$NOMBRECHOFER,$fila['matricula'],$fila['costo']);
echo json_encode($detalles);

?>
