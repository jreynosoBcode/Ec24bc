<?php
  header('Access-Control-Allow-Origin: *'); 
  
 include('../conexion.php');

$IDCLIENTE=$_POST['id_cliente'];


$sqlquery="SELECT id_traslado,fecha,hora_salida,hora_llegada FROM traslados WHERE id_cliente=$IDCLIENTE";
?>
<thead>
  <tr style="background: #f2f2f2">
    <th class="label-cell sortable-cell sortable-active">Fecha</th>
    <th class="numeric-cell sortable-cell">Hora salida</th>
    <th class="numeric-cell sortable-cell">Hora llegada</th>
    <th class="numeric-cell sortable-cell">Ver</th>
  </tr>
</thead>
<tbody >
<?php
$resultado = $mysqli->query($sqlquery);
      while ($fila = $resultado->fetch_assoc()) 
      {
?>   
          <tr>
            <td class="label-cell"><?php echo $fila['fecha']; ?></td>
            <td class="numeric-cell"><?php echo $fila['hora_salida']; ?></td>
            <td class="numeric-cell"><?php echo $fila['hora_llegada']; ?></td>
            <td onclick="loadHistorialDetalles('<?php echo $fila['id_traslado']; ?>')" class="numeric-cell"><a data-popup=".popup-historial" class="open-popup"><i class="icon f7-icons">eye</i></a></td>
          </tr>
<?php
      }
?>
         </tbody>
  