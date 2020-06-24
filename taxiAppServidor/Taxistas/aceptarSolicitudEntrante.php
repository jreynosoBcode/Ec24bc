<?php

require '../conexion.php';

$id_peticion = $_POST['id_peticion'];

$sql = "update peticiones set estado='aceptada', hora_aceptada=now() where id_peticion='" . $id_peticion . "';";
$mysqli->query($sql);

$sql = "update ubicacion_taxi set estado='ocupado' where id_chofer=(select id_chofer from peticiones where id_peticion='" . $id_peticion . "');";
$mysqli->query($sql);
