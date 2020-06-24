<?php

require '../conexion.php';

$mysqli->query("SET NAMES 'UTF8'");

$id_chofer = $_POST['id_chofer'];
$id_cuenta = $_POST['txt_id_cuenta_b'];
$sucursal = $_POST['txt_sucursal_cuenta_b'];
$clave = $_POST['txt_clave_cuenta_b'];
$titular = $_POST['txt_titular_cuenta_b'];

$sql = "";

if ($id_cuenta === "") {
    $sql = "insert into cuenta_bancaria(id_chofer, sucursal_bancaria, clave_interbancaria, titular_cuenta) "
            . " values('" . $id_chofer . "', '" . $sucursal . "', '" . $clave . "', '" . $titular . "');";
} else {
    $sql = "update cuenta_bancaria set sucursal_bancaria='" . $sucursal . "', clave_interbancaria='" . $clave . "', titular_cuenta='" . $titular . "' "
            . " where id_cuenta='" . $id_cuenta . "';";
}

echo $mysqli->query($sql);
