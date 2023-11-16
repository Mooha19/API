<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    
    // Conectar a la base de datos
    $db = mysqli_connect('localhost', 'admin', 'test', 'medicina');

    // Verificar la conexión
    if (!$db) {
        die("La conexión a la base de datos falló: " . mysqli_connect_error());
    }

    // Preparar y ejecutar la sentencia SQL de actualización
    $deleteQuery = "DELETE FROM citas WHERE id = '$id'";
    $result = mysqli_query($db, $deleteQuery);

    // Verificar si la actualización fue exitosa
    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Error al borrar ']);
    }

    // Cerrar la conexión
    mysqli_close($db);
} else {
    // Manejar casos en los que la solicitud no es de tipo POST
    echo json_encode(['error' => 'Método no permitido']);
}
?>
