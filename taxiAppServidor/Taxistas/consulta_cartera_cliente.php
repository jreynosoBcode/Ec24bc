<?php

require '../conexion.php';
$mysqli->query("SET NAMES 'UTF8'");

$id_chofer = $_POST['id_chofer'];

$fecha_inicial = $_POST['fecha1'];
$fecha_final = $_POST['fecha2'];


$monto_total_viajes;
$comision_porcentaje;
$comisiones;
$restante;

$respuesta;

$sql = "select ifnull(sum(costo), 0) as monto_total_viajes from traslados where id_chofer='" . $id_chofer . "' and fecha>='" . $fecha_inicial . "' and fecha<='" . $fecha_final . "';";
$resultado = $mysqli->query($sql);
$fila = $resultado->fetch_assoc();
$monto_total_viajes = $fila['monto_total_viajes'];

$sql = "select comision_porcentaje from tarifas;";
$resultado = $mysqli->query($sql);
$fila = $resultado->fetch_assoc();
$comision_porcentaje = $fila['comision_porcentaje'];

$comisiones = $monto_total_viajes * ($comision_porcentaje * .01);
$restante = $monto_total_viajes - $comisiones;

$respuesta[] = array("monto_total_viajes" => $monto_total_viajes,
    "comision_porcentaje" => $comision_porcentaje,
    "comisiones" => $comisiones,
    "restante" => $restante);

echo json_encode($respuesta);
