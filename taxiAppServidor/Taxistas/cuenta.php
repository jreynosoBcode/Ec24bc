<?php

require '../conexion.php';
$mysqli->query("SET NAMES 'UTF8'");

$nombre = $_POST["txt_nombre_cuenta"];
$appat = $_POST["txt_appat_cuenta"];
$apmat = $_POST["txt_apmat_cuenta"];
$fecha_nac = $_POST["txt_fecha_nac_cuenta"];
$sexo = $_POST["txt_sexo_cuenta"];
$telefono = $_POST["txt_tel_cuenta"];
$celular = $_POST["txt_cel_cuenta"];

$calle = $_POST["txt_calle_cuenta"];
$numero = $_POST["txt_no_cuenta"];
$colonia = $_POST["txt_colonia_cuenta"];
$cp = $_POST["txt_cp_cuenta"];

$mail = $_POST['txt_correo_cuenta'];
$usuario = $_POST['txt_usuario_cuenta'];
$password = $_POST['txt_pass_cuenta'];
$central = $_POST['txt_central_cuenta'];

$password_encript = sha1($password);

$archivo = $_FILES["img_cuenta"]["tmp_name"];
$tamanio_archivo = $_FILES["img_cuenta"]["size"];
$tipo_archivo = $_FILES["img_cuenta"]["type"];
$nombre_archivo = $_FILES["img_cuenta"]["name"];

$contenido_archivo = "";

if ($tamanio_archivo != 0) {
    $fp = fopen($archivo, "rb");
    $contenido_archivo = fread($fp, $tamanio_archivo);
    $contenido_archivo = addslashes($contenido_archivo);
    fclose($fp);
}

$sql = "INSERT INTO choferes (apodo, nombre, apellidopaterno, apellidomaterno, fechanacimiento, sexo, celular, telefono, "
        . " calle, numero, colonia, cp, fecha_ingreso, promedio_calificacion, usuario, contrasena, email, estatus, id_central, forma_registro, foto) "
        . " VALUES ('" . $nombre . "', '" . $nombre . "', '" . $appat . "', '" . $apmat . "', '" . $fecha_nac . "', '" . $sexo . "', '" . $celular . "', '" . $telefono . "', "
        . " '" . $calle . "', '" . $numero . "', '" . $colonia . "', '" . $cp . "', curdate(), 0, '" . $usuario . "', '" . $password_encript . "', '" . $mail . "', 'Registro', '" . $central . "', 1, '".$contenido_archivo."');";

echo $mysqli->query($sql);






