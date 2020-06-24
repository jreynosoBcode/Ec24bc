<?php

header('Access-Control-Allow-Origin: *');
require '../conexion.php';

$IDCHOFER = "";
$MATRICULA = "";
$LATITUD = "";
$LONGITUD = "";
$ESTADO_TAXI = "";

if (isset($_POST['id_chofer']) && $_POST['id_chofer'] !== "") {
    $IDCHOFER = $_POST['id_chofer'];
}
if (isset($_POST['matricula']) && $_POST['matricula'] !== "") {
    $MATRICULA = $_POST['matricula'];
}
if (isset($_POST['latitud']) && $_POST['latitud'] !== "") {
    $LATITUD = $_POST['latitud'];
}
if (isset($_POST['longitud']) && $_POST['longitud'] !== "") {
    $LONGITUD = $_POST['longitud'];
}
if (isset($_POST['estado_taxi']) && $_POST['estado_taxi'] !== "") {
    $ESTADO_TAXI = $_POST['estado_taxi'];
}

$sqlquery = "DELETE FROM ubicacion_taxi WHERE matricula='$MATRICULA' AND id_chofer=$IDCHOFER";

if ($mysqli->query($sqlquery) === TRUE) {
    
} else {
    echo "Error: " . $sqlquery . "<br>" . $mysqli->error;
}
$sqlquery = "INSERT INTO ubicacion_taxi (matricula,id_chofer,latitud,longitud,fecha_hora,estado) VALUES ('$MATRICULA',$IDCHOFER,'$LATITUD','$LONGITUD',NOW(),'$ESTADO_TAXI');";


if ($mysqli->query($sqlquery) === TRUE) {
    
} else {
    echo "Error: " . $sqlquery . "<br>" . $mysqli->error;
}
?>
