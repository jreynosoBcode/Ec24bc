<?php

require '../conexion.php';
$mysqli->query("SET NAMES 'UTF8'");

$km = $_POST['metros'] / 1000;

$sql = "Select precio_base, km_base, precio_x_km, comision_porcentaje from tarifas;";

$resultado = $mysqli->query($sql);

$fila = $resultado->fetch_assoc();

$respuesta;

if ($km <= $fila["km_base"]) {
    $respuesta[] = array("costo" => $fila["precio_base"]);
} else {
    $costo = $fila["precio_x_km"] * $km;
    $respuesta[] = array("costo" => $costo);
}

echo json_encode($respuesta);
