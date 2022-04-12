<?php

include("../includes/config.php");

$regi_id=$_POST["region_id"];

$sql="
SELECT comu_id,comu_nombre FROM comuna where regi_id=$regi_id					 
  "; 


$cad=mysqli_query($conn,$sql) or die(mysqli_error($conn));
$data = array();

while ($xDato = mysqli_fetch_array($cad))
{
  $comu_id=$xDato['comu_id'];
  $comu_nombre=$xDato['comu_nombre'];

 // header('Content-Type: application/json');

  //$data = ["giro_id" => $giro_id, "giro_nombre" => $giro_nombre];
  $data[] = array('comu_id'=> $comu_id,'comu_nombre'=> $comu_nombre); 
}

print_r(json_encode($data));

?>