<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "osakidetza";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$provincia = $_POST['provincia'];


$sql = "SELECT nombre FROM ciudad WHERE provincia = '$provincia'";
$result = $conn->query($sql);


$ciudades = array();
while ($row = $result->fetch_assoc()) {
    $ciudades[] = $row['nombre'];
}


echo json_encode($ciudades);

$conn->close();
?>
