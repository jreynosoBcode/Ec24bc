<?php

require '../conexion.php';
$mysqli->query("SET NAMES 'UTF8'");

$id_chofer = $_POST['id_chofer'];
$apodo = $_POST["frm_perfil_apodo"];
$nombre = $_POST["frm_perfil_nombre"];
$appat = $_POST["frm_perfil_appat"];
$apmat = $_POST["frm_perfil_apmat"];
$fecha_nac = $_POST["frm_perfil_fechanac"];
$sexo = $_POST["frm_perfil_sexo"];
$telefono = $_POST["frm_perfil_tel"];
$celular = $_POST["frm_perfil_cel"];
$calle = $_POST["frm_perfil_calle"];
$numero = $_POST["frm_perfil_numero"];
$colonia = $_POST["frm_perfil_colonia"];
$cp = $_POST["frm_perfil_cp"];

$sql = "UPDATE choferes SET apodo='" . $apodo . "', nombre='" . $nombre . "', apellidopaterno='" . $appat . "', apellidomaterno='" . $apmat . "', "
        . " fechanacimiento='" . $fecha_nac . "', sexo='" . $sexo . "', celular='" . $celular . "', telefono='" . $telefono . "', calle='" . $calle . "', "
        . " numero='" . $numero . "', colonia='" . $colonia . "', cp='" . $cp . "' WHERE id_chofer='" . $id_chofer . "'; ";

echo $mysqli->query($sql);

$archivo = $_FILES["frm_perfil_foto"]["tmp_name"];
$tamanio_archivo = $_FILES["frm_perfil_foto"]["size"];
$tipo_archivo = $_FILES["frm_perfil_foto"]["type"];
$nombre_archivo = $_FILES["frm_perfil_foto"]["name"];

$contenido_archivo = "";

if ($tamanio_archivo != 0) {
    
    $fp = fopen($archivo, "rb");
    $contenido_archivo = fread($fp, $tamanio_archivo);
    $contenido_archivo = addslashes($contenido_archivo);
    fclose($fp);

    $sql = "UPDATE choferes SET foto='$contenido_archivo' WHERE id_chofer='" . $id_chofer . "';";
    
    $mysqli->query($sql);
}


