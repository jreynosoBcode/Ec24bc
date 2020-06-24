<?php

require '../conexion.php';

$mysqli->query("SET NAMES 'UTF8'");

$sql = "select id_central, nombre from centrales;";

$resultado = $mysqli->query($sql);

echo '<option value="">Seleccione</option>';
while ($fila = $resultado->fetch_assoc()) {
    echo '<option value="' . $fila['id_central'] . '">' . $fila['nombre'] . '</option>';
}