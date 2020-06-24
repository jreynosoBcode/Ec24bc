<?php
  header('Access-Control-Allow-Origin: *'); 
  
 include('../conexion.php');
 $mysqli->query("SET CHARSET 'utf8'");
 $IDCLIENTE=$_POST['id_cliente'];
 $NOMBRE="";
 $APP="";
 $APM="";
 $CALLE="";
 $COLONIA="";
 $NUM="";
 $CP="";
 $FECHANAC="";
 $GENERO="";
 $TEL="";
 $CEL="";
 $FECHAREG="";
 $CORREO="";
 $PROMEDIO="";
 $EFECTIVO="";
 $PAYPAL="";

//falta sacar la foto
 $sqlquery="SELECT nombre,apellidopaterno,apellidomaterno,calle,colonia,numero,cp,fechanacimiento,genero,telefono,celular,fecha_registro,correo,promedio_calificacion FROM clientes WHERE id_cliente=$IDCLIENTE";
 $resultado = $mysqli->query($sqlquery);
  while ($fila = $resultado->fetch_assoc()){
		$arrayDatos[] = array(
			0 => $fila['nombre'], 
			1 => $fila['apellidopaterno'], 
			2 => $fila['apellidomaterno'], 
			3 => $fila['calle'],
			4 => $fila['colonia'],
			5 => $fila['numero'],
			6 => $fila['cp'],
			7 => $fila['fechanacimiento'],
			8 => $fila['genero'],
			9 => $fila['telefono'],
			10 => $fila['celular'],
			11 => $fila['fecha_registro'],
			12 => $fila['correo'],
			13 => $fila['promedio_calificacion']
		);
    
  }  

  for ($i=0; $i <count($arrayDatos) ; $i++) { 
  		$NOMBRE=$arrayDatos[$i][0];
  		$APP=$arrayDatos[$i][1];
  		$APM=$arrayDatos[$i][2];
  		$CALLE=$arrayDatos[$i][3];
  		$COLONIA=$arrayDatos[$i][4];
  		$NUM=$arrayDatos[$i][5];
  		$CP=$arrayDatos[$i][6];
  		$FECHANAC=$arrayDatos[$i][7];
  		$GENERO=$arrayDatos[$i][8];
  		$TEL=$arrayDatos[$i][9];
  		$CEL=$arrayDatos[$i][10];
  		$FECHAREG=$arrayDatos[$i][11];
  		$CORREO=$arrayDatos[$i][12];
  		$PROMEDIO=$arrayDatos[$i][13];

  }

 $sqlquery="SELECT forma_pago,forma_pago2 FROM metodo_pago WHERE id_cliente=$IDCLIENTE";
 $resultado = $mysqli->query($sqlquery);
 if ($resultado -> num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()){
      $arrayforma[] = array(
        0 => $fila['forma_pago'],
        1 => $fila['forma_pago2']
      );
      for ($i=0; $i <count($arrayforma) ; $i++) { 
        $EFECTIVO=$arrayforma[$i][0];
        $PAYPAL=$arrayforma[$i][1];
    }
  }
 }else{
    $EFECTIVO="";
    $PAYPAL="";
 }  

  

  $datos_perfil=array($NOMBRE,$APP,$APM,$CALLE,$COLONIA,$NUM,$CP,$FECHANAC,$GENERO,$TEL,$CEL,$FECHAREG,$CORREO,$PROMEDIO,$EFECTIVO,$PAYPAL);
  echo json_encode($datos_perfil);

?>
