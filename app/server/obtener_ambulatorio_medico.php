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

// Obtener la ciudad desde la solicitud POST
$ciudad = $_POST['ciudad'];

// Consultar la base de datos para obtener el ambulatorio de la ciudad
$sqlAmbulatorio = "SELECT ambulatorio FROM ciudad WHERE nombre = '$ciudad'";
$resultAmbulatorio = $conn->query($sqlAmbulatorio);

// Almacenar el ambulatorio en un array
$ambulatorio = array();
if ($resultAmbulatorio->num_rows > 0) {
    $rowAmbulatorio = $resultAmbulatorio->fetch_assoc();
    $ambulatorio['ambulatorio'] = $rowAmbulatorio['ambulatorio'];

    // Consultar la base de datos para obtener un médico aleatorio con especialidad "cabecera" del ambulatorio
    $sqlMedico = "SELECT * FROM sanitario WHERE trabajo = '" . $ambulatorio['ambulatorio'] . "' AND especialidad = 'cabecera' ORDER BY RAND() LIMIT 1";
    $resultMedico = $conn->query($sqlMedico);

    // Almacenar el médico en el mismo array
    if ($resultMedico->num_rows > 0) {
        $rowMedico = $resultMedico->fetch_assoc();
        $ambulatorio['medico'] = $rowMedico['nombre'];
        $ambulatorio['cole'] = $rowMedico['colegiado'];
    } else {
        $ambulatorio['medico'] = 'No encontrado';
    }
} else {
    $ambulatorio['ambulatorio'] = 'No encontrado';
    $ambulatorio['medico'] = 'No encontrado';
}

// Devolver el ambulatorio y el médico como respuesta en formato JSON
echo json_encode($ambulatorio);

$conn->close();
?>
