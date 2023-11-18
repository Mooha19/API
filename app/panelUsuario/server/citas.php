<?php

$db = mysqli_connect('localhost', 'root', '', 'osakidetza');



if ($db->connect_error) {
    die("Error de conexión: " . $db->connect_error);
}

$fecha = $_POST['fecha'];
$colegiado = $_POST['colegiado'];


$query = "SELECT hora FROM citas WHERE colegiado = '$colegiado' AND fecha = '$fecha'";
$resultado = $db->query($query);


if ($resultado) {
  
    $citas = [];
    while ($fila = $resultado->fetch_assoc()) {
        $citas[] = $fila['hora'];
    }

 
    echo json_encode(['citas' => $citas]);
} else {

    echo json_encode(['error' => 'Error al obtener citas']);
}


$db->close();
?>
