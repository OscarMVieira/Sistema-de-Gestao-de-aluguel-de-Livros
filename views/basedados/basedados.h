<?php
$host = "localhost"; 
$dbname = "biblioteca_bd"; // O nome que criaste no phpMyAdmin
$username_db = "root"; 
$password_db = ""; 

$conn = new mysqli($host, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die('Erro de ligação: ' . $conn->connect_error);
}
?>