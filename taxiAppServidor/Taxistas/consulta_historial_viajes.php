<?php

require '../conexion.php';
$mysqli->query("SET NAMES 'UTF8'");

$id_chofer = $_POST['id_chofer'];
$fecha_inicial = $_POST['fecha1'];
$fecha_final = $_POST['fecha2'];

$sql = "select id_traslado, fecha, hora_salida, hora_llegada, costo from traslados WHERE id_chofer='" . $id_chofer . "' and fecha>='" . $fecha_inicial . "' and fecha<='" . $fecha_final . "';";

$resultado = $mysqli->query($sql);

$num_res = $resultado->num_rows;

if ($num_res > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila["fecha"] . "</td>";
        echo "<td>" . $fila["hora_salida"] . "</td>";
        echo "<td>" . $fila["hora_llegada"] . "</td>";
        echo "<td>" . $fila["costo"] . "</td>";
        echo "<td><a onclick='consulta_detalle(" . $fila["id_traslado"] . ")'><i class='icon f7-icons'>eye</i></a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr>";
    echo "<td colspan='5'>Ningun registro</td>";
    echo "</tr>";
}

echo "<input type='hidden' id='txt_numero_traslados' value='" . $num_res . "'>";



