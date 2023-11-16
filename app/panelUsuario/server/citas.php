<?php
// Aquí debes realizar la conexión a tu base de datos
$db = new mysqli('localhost', 'admin', 'test', 'medicina');

// Verificar la conexión
if ($db->connect_error) {
    die("Error de conexión: " . $db->connect_error);
}

// Obtener la fecha desde la solicitud POST (puedes ajustar según tu frontend)
$fecha = $_POST['fecha'];
$colegiado = $_POST['colegiado'];

// Consulta SQL para obtener las citas del médico para la fecha específica
$query = "SELECT hora FROM citas WHERE colegiado = '$colegiado' AND fecha = '$fecha'";
$resultado = $db->query($query);

// Verificar si la consulta fue exitosa
if ($resultado) {
    // Obtener las citas en un array
    $citas = [];
    while ($fila = $resultado->fetch_assoc()) {
        $citas[] = $fila['hora'];
    }

    // Devolver las citas en formato JSON
    echo json_encode(['citas' => $citas]);
} else {
    // Manejar errores si la consulta falla
    echo json_encode(['error' => 'Error al obtener citas']);
}

// Cerrar la conexión a la base de datos
$db->close();
?>
