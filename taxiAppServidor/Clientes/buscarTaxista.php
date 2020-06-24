	<?php
	header('Access-Control-Allow-Origin: *'); 
	
include('../conexion.php');
$mysqli->query("SET CHARSET 'utf8'");
	$IDCHOFER=$_POST['id_chofer'];
	$NOMBRETAXISTA="";
	$APPTAXISTA="";
	$APMTAXISTA="";
	$FECHANAC="";
	$CELULAR="";
	$PROMEDIO="";
	$COMPANIA="";
	$MODELO="";
	

	$sqlquery="SELECT nombre,apellidopaterno,apellidomaterno,fechanacimiento,celular,promedio_calificacion FROM choferes WHERE id_chofer=$IDCHOFER";
	$resultado = $mysqli->query($sqlquery);
  while ($fila = $resultado->fetch_assoc()){
		$arrayDatos[] = array(
			0 => $fila['nombre'], 
			1 => $fila['apellidopaterno'], 
			2 => $fila['apellidomaterno'], 
			3 => $fila['fechanacimiento'],
			4 => $fila['celular'],
			5 => $fila['promedio_calificacion']
		);
    
  }  
  
  for ($i=0; $i <count($arrayDatos) ; $i++) { 
  		$NOMBRETAXISTA=$arrayDatos[$i][0];
  		$APPTAXISTA=$arrayDatos[$i][1];
  		$APMTAXISTA=$arrayDatos[$i][2];
  		$FECHANAC=$arrayDatos[$i][3];
  		$CELULAR=$arrayDatos[$i][4];
  		$PROMEDIO=$arrayDatos[$i][5];
  }

  	$sqlquery="SELECT compania,modelo FROM unidades WHERE id_chofer=$IDCHOFER";
	$resultado = $mysqli->query($sqlquery);
  while ($fila = $resultado->fetch_assoc()){
		$arrayUnidades[] = array(
			0 => $fila['compania'], 
			1 => $fila['modelo'] 
			);   
  }  

   for ($i=0; $i <count($arrayUnidades) ; $i++) { 
  		$COMPANIA=$arrayUnidades[$i][0];
  		$MODELO=$arrayUnidades[$i][1];
  }

  $datos_chofer=array($NOMBRETAXISTA,$APPTAXISTA,$APMTAXISTA,$FECHANAC,$CELULAR,$PROMEDIO,$COMPANIA,$MODELO);
  echo json_encode($datos_chofer);


 ?>
	  
