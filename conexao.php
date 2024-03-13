<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "bancoDeDados";

$mysqli = new mysqli($host, $user, $pass, $db);
    if($mysqli->connect_errno){
        die("Falha ao se conectar". $mysqli->connect_error);
    }
   
?>