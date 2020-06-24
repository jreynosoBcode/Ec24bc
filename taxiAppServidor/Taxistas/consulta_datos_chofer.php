<?php

require '../conexion.php';

$mysqli->query("SET NAMES 'UTF8'");

$id_chofer = $_POST['id_chofer'];

$array_respuesta;

$sql = "SELECT id_chofer, apodo, nombre, apellidopaterno, apellidomaterno, fechanacimiento, "
        . " sexo, celular, telefono, calle, numero, colonia, "
        . " cp, fecha_ingreso, promedio_calificacion, email "
        . " FROM choferes WHERE id_chofer='" . $id_chofer . "';";


$resultado = $mysqli->query($sql);


$num_res = $resultado->num_rows;

if ($num_res > 0) {

    $fila = $resultado->fetch_assoc();

    $array_respuesta[] = array("correcto" => "si",
        "id_chofer" => $fila['id_chofer'],
        "apodo" => $fila['apodo'],
        "nombre" => $fila['nombre'],
        "appat" => $fila['apellidopaterno'],
        "apmat" => $fila['apellidomaterno'],
        "fecha_nac" => $fila['fechanacimiento'],
        "sexo" => $fila['sexo'],
        "celular" => $fila['celular'],
        "telefono" => $fila['telefono'],
        "calle" => $fila['calle'],
        "numero" => $fila['numero'],
        "colonia" => $fila['colonia'],
        "cp" => $fila['cp'],
        "fecha_ingreso" => $fila['fecha_ingreso'],
        "promedio_calificacion" => $fila['promedio_calificacion'],
        "email" => $fila['email']);
} else {
    $array_respuesta[] = array("correcto" => "no");
}

echo json_encode($array_respuesta);