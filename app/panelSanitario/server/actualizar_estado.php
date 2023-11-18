<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $estado = $_POST['estado'];
    $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : '';

    
    $db = mysqli_connect('localhost', 'root', '', 'osakidetza');


    
    if (!$db) {
        die("La conexión a la base de datos falló: " . mysqli_connect_error());
    }

   
    $updateQuery = "UPDATE diagnosticos SET estado = '$estado', comentarios = '$observaciones' WHERE id = '$id'";
    $result = mysqli_query($db, $updateQuery);

    
    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Error al actualizar el estado']);
    }

    
    mysqli_close($db);
} else {
    
    echo json_encode(['error' => 'Método no permitido']);
}
?>
