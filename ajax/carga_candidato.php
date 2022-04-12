<?php

include("../includes/config.php");

$sql="
SELECT cli_id,CONCAT(cli_nombre,cli_apellido) AS nombre FROM clientes
WHERE CONCAT(cli_nombre,cli_apellido) IS NOT NULL			 
  "; 


$cad=mysqli_query($conn,$sql) or die(mysqli_error($conn));
$data = array();

while ($xDato = mysqli_fetch_array($cad))
{
  $cli_id=$xDato['cli_id'];
  $nombre=$xDato['nombre'];

  $data[] = array('cli_id'=> $cli_id,'nombre'=> $nombre); 
}

print_r(json_encode($data));

?>