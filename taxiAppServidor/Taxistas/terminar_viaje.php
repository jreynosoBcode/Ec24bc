<?php

require '../conexion.php';
$mysqli->query("SET NAMES 'UTF8'");

$id_peticion = $_POST['id_peticion'];
$latitud_destino = $_POST['lat_destino'];
$longitud_destino = $_POST['lng_destino'];

$sql = "UPDATE peticiones SET latitud_destino='" . $latitud_destino . "', "
        . " longitud_destino='" . $longitud_destino . "' "
        . " WHERE id_peticion='" . $id_peticion . "';";

$mysqli->query($sql);
