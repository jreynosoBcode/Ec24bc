<?php

require '../conexion.php';

$id_chofer = $_POST['id_chofer'];

$sql = "SELECT foto FROM choferes WHERE id_chofer= '" . $id_chofer . "';";

$resultado = $mysqli->query($sql);

$fila = $resultado->fetch_assoc();

if ($fila["foto"] !== "") {
    $img = '<img src="data:image/jpg;base64,' . base64_encode($fila['foto']) . '" style="width:100%; border:3px solid #a2a2a2;"/>';

    header("Content-type: image/jpg");
    print $img;
} else {
    echo "<div style='border:3px solid #a2a2a2;'>Sin foto</div>";
}