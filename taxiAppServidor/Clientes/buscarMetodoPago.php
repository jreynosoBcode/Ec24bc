<?php 
	header('Access-Control-Allow-Origin: *'); 
		
	include('../conexion.php');
	$IDCLIENTE=$_POST['id_cliente'];
	$PAYPAL="";


	$sqlquery="SELECT forma_pago2 FROM metodo_pago WHERE id_cliente=$IDCLIENTE";
	$resultado = $mysqli->query($sqlquery);
	  while ($fila = $resultado->fetch_assoc()){
			$arrayDatos[] = array(
				0 => $fila['forma_pago2']
			);	    
	  }  
	  
  for ($i=0; $i <count($arrayDatos) ; $i++) { 
  		$PAYPAL=$arrayDatos[$i][0];
  }
  
  $metodos=array($PAYPAL);
  echo json_encode($metodos);
?>