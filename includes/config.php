<?php

$servername = "144.22.59.68";
$database = "emani";
$username = "emani_root";
$password = "emani23082021";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_query($conn,"SET lc_time_names = 'es_ES'" );
// Check connection
if (!$conn) {
	
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
// mysqli_close($conn);

?>