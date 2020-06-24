<?php

require '../conexion.php';
$mysqli->query("SET NAMES 'UTF8'");

$marca = $_POST["txt_marca"];
$modelo = $_POST["txt_modelo"];
$matricula = $_POST["txt_matricula"];
$id_chofer = $_POST["hdn_id_chofer"];

$sql = "insert INTO unidades(matricula, id_chofer, compania, modelo, promedio_calificacion) "
        . "values('".$matricula."', '".$id_chofer."', '".$marca."', '".$modelo."', '0')";

echo $mysqli->query($sql);






