<?php

require '../conexion.php';

$mysqli->query("SET NAMES 'UTF8'");

$id_chofer = $_POST['id_chofer'];

$sql = "select id_cuenta, sucursal_bancaria, clave_interbancaria, titular_cuenta from cuenta_bancaria where id_chofer='" . $id_chofer . "';";

$resultado = $mysqli->query($sql);
$num_res = $resultado->num_rows;

$respuesta;

if ($num_res > 0) {
    $fila = $resultado->fetch_assoc();

    $respuesta[] = array("existe" => "si",
        "id_cuenta" => $fila['id_cuenta'],
        "sucursal" => $fila['sucursal_bancaria'],
        "clave" => $fila['clave_interbancaria'],
        "titular" => $fila['titular_cuenta']);
} else {
    $respuesta[] = array("existe" => "no");
}

echo json_encode($respuesta);
