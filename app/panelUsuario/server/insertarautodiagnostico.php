<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $symptoms = $_POST['symptoms'];
    $result = $_POST['result'];
    $colegiado = $_POST['colegiado'];
    $tarjeta = $_POST['tarjeta'];
 
    $db = mysqli_connect('localhost', 'root', '', 'osakidetza');


    
    if (!$db) {
        die("La conexión a la base de datos falló: " . mysqli_connect_error());
    }

   
    

    $insertQuery = "INSERT INTO diagnosticos (sintomas, respuesta, tipo, estado, colegiado, tarjeta) VALUES ('$symptoms', '$result', 'autodiagnostico', 'pendiente', '$colegiado', '$tarjeta')";
    $insertResult = mysqli_query($db, $insertQuery);

   
    if ($insertResult) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Error al insertar en la base de datos']);
    }

   
    mysqli_close($db);
} else {
   
    echo json_encode(['error' => 'Método no permitido']);
}
?>
