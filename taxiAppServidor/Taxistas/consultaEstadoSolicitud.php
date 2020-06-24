<?php
require '../conexion.php';

$id_peticion=$_POST['id_peticion'];

$sql="select estado from peticiones where id_peticion='".$id_peticion."';";

$resultado=$mysqli->query($sql);

$fila=$resultado->fetch_assoc();

echo $fila["estado"];