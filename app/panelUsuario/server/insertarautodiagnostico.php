<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $symptoms = $_POST['symptoms'];
    $result = $_POST['result'];
    $colegiado = $_POST['colegiado'];
    $tarjeta = $_POST['tarjeta'];
    // Conectar a la base de datos
    $db = mysqli_connect('localhost', 'admin', 'test', 'medicina');

    // Verificar la conexión
    if (!$db) {
        die("La conexión a la base de datos falló: " . mysqli_connect_error());
    }

    // Escapar los datos para evitar SQL injection
    

    // Preparar y ejecutar la sentencia SQL de inserción
    $insertQuery = "INSERT INTO diagnosticos (sintomas, respuesta, tipo, estado, colegiado, tarjeta) VALUES ('$symptoms', '$result', 'autodiagnostico', 'pendiente', '$colegiado', '$tarjeta')";
    $insertResult = mysqli_query($db, $insertQuery);

    // Verificar si la inserción fue exitosa
    if ($insertResult) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Error al insertar en la base de datos']);
    }

    // Cerrar la conexión
    mysqli_close($db);
} else {
    // Manejar casos en los que la solicitud no es de tipo POST
    echo json_encode(['error' => 'Método no permitido']);
}
?>
