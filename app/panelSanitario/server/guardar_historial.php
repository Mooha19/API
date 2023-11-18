<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tarjeta = $_POST['tarjeta'];
    $sintomas = $_POST['sintomas'];
    $respuesta = $_POST['respuesta'];
    $tipo = $_POST['tipo'];
    $comentarios = $_POST['comentarios'];
    $colegiado = $_POST['colegiado'];

    
    $conexion = new mysqli("localhost", "root", "", "osakidetza");

   
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    
    $insertar = "INSERT INTO diagnosticos (tarjeta, sintomas, respuesta, tipo, estado, comentarios, colegiado) 
                 VALUES ('$tarjeta', '$sintomas', '$respuesta', '$tipo', 'aceptado','$comentarios', $colegiado)";
    
    if ($conexion->query($insertar) === TRUE) {
        header("location: ../ver_historial_paciente.php?tarjeta=$tarjeta");
        exit();
    } else {
        echo "Error al añadir la fila: " . $conexion->error;
    }

    
    $conexion->close();
}
?>
