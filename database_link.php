<?php
$host ="localhost";
$dbname ="helios";
$username ="root";
$password ="";

// Change the above connection credentials when hosted in server.

$mysqli = new mysqli(hostname: $host,
                      username:$username,
                      password:$password,
                      database:$dbname);
if($mysqli->connect_errno){
    die("Connection Error: ". $mysqli->connect_error);
}
return $mysqli;

?>