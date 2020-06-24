<?php

require '../conexion.php';
$mysqli->query("SET NAMES 'UTF8'");

$id_peticion = $_POST['id_peticion'];
$latitud_ubicacion = $_POST['lat_ubicacion'];
$longitud_ubicacion = $_POST['lng_ubicacion'];

$sql = "UPDATE peticiones SET latitud_ubicacion='" . $latitud_ubicacion . "', "
        . " longitud_ubicacion='" . $longitud_ubicacion . "' "
        . " WHERE id_peticion='" . $id_peticion . "';";

$mysqli->query($sql);
