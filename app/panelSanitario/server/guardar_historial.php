<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tarjeta = $_POST['tarjeta'];
    $sintomas = $_POST['sintomas'];
    $respuesta = $_POST['respuesta'];
    $tipo = $_POST['tipo'];
    $estado = $_POST['estado'];

    // Realizar la conexión a la base de datos (reemplaza estos valores con los tuyos)
    $conexion = new mysqli("localhost", "admin", "test", "medicina");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Insertar nueva fila en la base de datos
    $insertar = "INSERT INTO diagnosticos (tarjeta, sintomas, respuesta, tipo, estado) 
                 VALUES ('$tarjeta', '$sintomas', '$respuesta', '$tipo', '$estado')";
    
    if ($conexion->query($insertar) === TRUE) {
        header("location: ../ver_historial_paciente.php?tarjeta=$tarjeta");
        exit();
    } else {
        echo "Error al añadir la fila: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
