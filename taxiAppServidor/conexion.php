<?php
    //$mysqli = new mysqli("localhost","root","","taxiapp");
    $mysqli = new mysqli("67.227.236.124", "bcodemex", "587ec52495117b7.%", "bcodemex_taxiapp");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
?>



