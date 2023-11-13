<?php
// Conexión a la base de datos (ajusta los detalles según tu configuración)
$servername = "localhost";
$username = "admin";
$password = "test";
$dbname = "medicina";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener la provincia desde la solicitud POST
$provincia = $_POST['provincia'];

// Consultar la base de datos para obtener las ciudades de la provincia
$sql = "SELECT nombre FROM ciudad WHERE provincia = '$provincia'";
$result = $conn->query($sql);

// Almacenar las ciudades en un array
$ciudades = array();
while ($row = $result->fetch_assoc()) {
    $ciudades[] = $row['nombre'];
}

// Devolver las ciudades como respuesta en formato JSON
echo json_encode($ciudades);

$conn->close();
?>
