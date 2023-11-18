<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "osakidetza";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$ciudad = $_POST['ciudad'];


$sqlAmbulatorio = "SELECT ambulatorio FROM ciudad WHERE nombre = '$ciudad'";
$resultAmbulatorio = $conn->query($sqlAmbulatorio);


$ambulatorio = array();
if ($resultAmbulatorio->num_rows > 0) {
    $rowAmbulatorio = $resultAmbulatorio->fetch_assoc();
    $ambulatorio['ambulatorio'] = $rowAmbulatorio['ambulatorio'];

    
    $sqlMedico = "SELECT * FROM sanitario WHERE trabajo = '" . $ambulatorio['ambulatorio'] . "' AND especialidad = 'cabecera' ORDER BY RAND() LIMIT 1";
    $resultMedico = $conn->query($sqlMedico);

    
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


echo json_encode($ambulatorio);

$conn->close();
?>
