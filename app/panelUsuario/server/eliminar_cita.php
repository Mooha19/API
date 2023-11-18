<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    
   
    $db = mysqli_connect('localhost', 'root', '', 'osakidetza');


    if (!$db) {
        die("La conexión a la base de datos falló: " . mysqli_connect_error());
    }

   
    $deleteQuery = "DELETE FROM citas WHERE id = '$id'";
    $result = mysqli_query($db, $deleteQuery);

   
    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Error al borrar ']);
    }

  
    mysqli_close($db);
} else {

    echo json_encode(['error' => 'Método no permitido']);
}
?>
