<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $estado = $_POST['estado'];

    // Conectar a la base de datos
    $db = mysqli_connect('localhost', 'admin', 'test', 'medicina');

    // Verificar la conexión
    if (!$db) {
        die("La conexión a la base de datos falló: " . mysqli_connect_error());
    }

    // Preparar y ejecutar la sentencia SQL de actualización
    $updateQuery = "UPDATE diagnosticos SET estado = '$estado' WHERE id = '$id'";
    $result = mysqli_query($db, $updateQuery);

    // Verificar si la actualización fue exitosa
    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Error al actualizar el estado']);
    }

    // Cerrar la conexión
    mysqli_close($db);
} else {
    // Manejar casos en los que la solicitud no es de tipo POST
    echo json_encode(['error' => 'Método no permitido']);
}
?>
