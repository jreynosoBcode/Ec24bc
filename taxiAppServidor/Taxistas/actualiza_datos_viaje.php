<?php

require '../conexion.php';
$mysqli->query("SET NAMES 'UTF8'");

$ESTADO = $_POST['estado'];
$IDPETICION = $_POST['id_peticion'];

$sql = "";

if ($ESTADO === "servicio") {
    $sql = "update peticiones set estado='" . $ESTADO . "', hora_salida=NOW() where id_peticion='$IDPETICION';";
    echo $mysqli->query($sql);
} else {
    $sql = "update peticiones set estado='" . $ESTADO . "', hora_llegada=NOW() where id_peticion='$IDPETICION';";
    echo $mysqli->query($sql);


    $ubicacion = $_POST['ubicacion'];
    $destino = $_POST['destino'];
    $costo = $_POST['costo'];

    //insertar en traslados
    $sql2 = "select id_cliente, id_chofer, matricula, date(hora_aceptada) as fecha, time(hora_salida) as salida, time(hora_llegada) as llegada from peticiones WHERE id_peticion='" . $IDPETICION . "';";

    $resultado = $mysqli->query($sql2);
    $fila = $resultado->fetch_assoc();

    $sql2 = "insert into traslados(id_cliente, id_chofer, matricula, ubicacion, destino, fecha, hora_llegada, hora_salida, costo, id_peticion) "
            . " values('" . $fila["id_cliente"] . "', '" . $fila["id_chofer"] . "', '" . $fila["matricula"] . "', '" . $ubicacion . "', '" . $destino . "', "
            . " '" . $fila["fecha"] . "', '" . $fila["llegada"] . "', '" . $fila["salida"] . "', '" . $costo . "', '".$IDPETICION."')";

    $mysqli->query($sql2);
}
