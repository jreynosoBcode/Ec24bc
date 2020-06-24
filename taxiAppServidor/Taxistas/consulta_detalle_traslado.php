<?php

require '../conexion.php';
$mysqli->query("SET NAMES 'UTF8'");

$id_traslado = $_POST['id_traslado'];

$sql = "SELECT t.fecha, t.hora_salida, t.hora_llegada, t.ubicacion, t.destino, 
CONCAT(ch.nombre, ' ', ch.apellidopaterno, ' ', ch.apellidomaterno) as chofer, 
CONCAT(cli.nombre, ' ', cli.apellidopaterno, ' ', cli.apellidomaterno) as cliente, 
t.matricula, t.costo  
from traslados t inner join choferes ch on ch.id_chofer=t.id_chofer 
inner join clientes cli on cli.id_cliente=t.id_cliente where t.id_traslado='" . $id_traslado . "';";

$resultado = $mysqli->query($sql);

$fila = $resultado->fetch_assoc();

$respuesta[] = array("fecha" => $fila['fecha'],
    "salida" => $fila['hora_salida'],
    "llegada" => $fila['hora_llegada'],
    "ubicacion" => $fila['ubicacion'],
    "destino" => $fila['destino'],
    "chofer" => $fila['chofer'],
    "cliente" => $fila['cliente'],
    "matricula" => $fila['matricula'],
    "costo" => "$ " . $fila['costo']);

echo json_encode($respuesta);
