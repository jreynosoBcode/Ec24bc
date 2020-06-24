<?php
include('../conexion.php');
	$LATCLIENTE=19.6865691;
	$LNGCLIENTE=-101.19906950000001;
	$absCLIENTE=abs($LATCLIENTE)+abs($LNGCLIENTE);

	$sqlquery="SELECT * FROM ubicacion_taxi";
	$resultado = $mysqli->query($sqlquery);
  while ($fila = $resultado->fetch_assoc()){
  	$ABSU=abs($fila['latitud'])+abs($fila['longitud']);
  	echo $ABSU."<br>";
		$arrayDatos[] = array(
			0 => $fila['matricula'], 
			1 => $fila['id_chofer'], 
			2 => $fila['latitud'], 
			3 => $fila['longitud'],
			4 => $fila['fecha_hora'],
			5 => $ABSU
		);

  }

echo count($arrayDatos)."<br>";
for ($i=0; $i < count($arrayDatos); $i++) { 
		$RESTA=abs($absCLIENTE-$arrayDatos[$i][5]);
		echo $RESTA."<br>";
		$arrayRestas[] = array(
				0=>$arrayDatos[$i][0],
				1=>$arrayDatos[$i][1],
				2=>$RESTA
		);

}
$i=0;
$menor=$arrayRestas[$i][2];
$mayor=$arrayRestas[$i][2];

$pMenor=0;
while($i<count($arrayRestas)){
	$j=$i;
	if($menor>$arrayRestas[$i][2]){
	 		$menor=$arrayRestas[$i][2];	
	 		$pMenor=$j;
	}
	$i=$i+1;
}
echo"El menor es $menor en posicion $pMenor<br />";
$i=0;

echo $arrayDatos[$pMenor][0]." ".$arrayDatos[$pMenor][1]." ".$arrayDatos[$pMenor][2]." ".$arrayDatos[$pMenor][3]." ".$arrayDatos[$pMenor][4]." ".$arrayDatos[$pMenor][5];
	

$i=0;
while ($i<20) {
    // poll database for changes which is a bad idea.
    $i = $i + 1;
   	$IDPETICION=32;
		$sqlquery="SELECT estado FROM peticiones WHERE id_peticion=$IDPETICION";
		$resultado = $mysqli->query($sqlquery);
		
		if($resultado->num_rows === 0)
    {
        echo '<br>No results';
        $i=20;
    }else{
    		$fila = $resultado->fetch_assoc();
    		echo '<br>'.$fila['estado'];
    		if ($fila['estado']=="esperando") {
    			# code...
    		}
    		if ($fila['estado']=="cancelada") {
    			$i=20;
    		}
    		if ($fila['estado']=="aceptada") {
    			$i=20;
    		}
    }
		
    sleep(1); // sleep 1 second
}

?>