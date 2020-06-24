<?php

require '../conexion.php';

$mysqli->query("SET NAMES 'UTF8'");

$id_peticion = $_POST['id_peticion'];
$calificacion = $_POST['calificacion'];

$sql = "update traslados SET calificacion_cliente='" . $calificacion . "' WHERE id_peticion='" . $id_peticion . "';";

$mysqli->query($sql);
