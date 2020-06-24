<?php

require '../conexion.php';

$mysqli->query("SET NAMES 'UTF8'");

$usuario = $_POST['user'];
$password = sha1($_POST['pass']);

$sql = "SELECT c.id_chofer, c.nombre, c.apellidopaterno, c.apellidomaterno, "
        . " u.matricula, c.estatus, cen.nombre as central FROM choferes c left join unidades u on u.id_chofer=c.id_chofer "
        . " inner join centrales cen on cen.id_central=c.id_central "
        . " WHERE usuario='" . $usuario . "' and contrasena='" . $password . "';";

$resultado = $mysqli->query($sql);

$num_res = $resultado->num_rows;

$array_respuesta;

if ($num_res > 0) {
    $fila = $resultado->fetch_assoc();

    $array_respuesta[] = array("existe" => "si",
        "id_chofer" => $fila['id_chofer'],
        "nombre" => $fila['nombre'],
        "appat" => $fila['apellidopaterno'],
        "apmat" => $fila['apellidomaterno'],
        "matricula" => $fila['matricula'],
        "estatus" => $fila['estatus'],
        "central" => $fila['central']);


    $sql_promedio = "UPDATE choferes set promedio_calificacion=(SELECT avg(calificacion_chofer) from traslados where id_chofer='" . $fila['id_chofer'] . "') where id_chofer='" . $fila['id_chofer'] . "';";
    $mysqli->query($sql_promedio);
} else {
    $array_respuesta[] = array("existe" => "no");
}

echo json_encode($array_respuesta);
