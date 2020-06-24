	<?php
	header('Access-Control-Allow-Origin: *'); 
	
	include('../../conexion.php');
	$IDLUGAR=$_POST['id_lugar'];


	$sqlquery="DELETE FROM lugares_favoritos WHERE id_lugar=$IDLUGAR";
	$resultado = $mysqli->query($sqlquery);
	
	if($resultado->affected_rows) { 
			echo "successful";
	}else{
			echo "something went wrong";
	}


//	$sqlquery="SELECT id_chofer,matricula FROM ubicacion_taxi WHERE ";
?>
	  
