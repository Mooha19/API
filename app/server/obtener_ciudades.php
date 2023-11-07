<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["provincia"])) {
    $provincia = $_GET["provincia"];

    // Conexión a la base de datos (reemplaza los valores con los de tu configuración)
    $mysqli = new mysqli("localhost", "admin", "test", "medicina");

    if ($mysqli->connect_error) {
        die("Conexión fallida: " . $mysqli->connect_error);
    }

    // Consulta para obtener las ciudades desde la base de datos según la provincia
    $result = $mysqli->query("SELECT nombre FROM ciudad WHERE provincia = '$provincia'");

    echo '<option value="" disabled selected>Selecciona una ciudad</option>';

    // Mostrar opciones de la base de datos
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['nombre'] . '</option>';
    }

    // Cerrar la conexión
    $mysqli->close();
}
?>
