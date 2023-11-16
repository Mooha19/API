<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Historial</title>
</head>
<body>
    <h1>Lista del Historial</h1>

    <?php
    if (isset($_GET['tarjeta'])) {
        $tarjeta = $_GET['tarjeta'];

        // Realizar la conexión a la base de datos (reemplaza estos valores con los tuyos)
        $conexion = new mysqli("localhost", "admin", "test", "medicina");

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Consulta para obtener citas asociadas con la tarjeta proporcionada
        $consulta = "SELECT sintomas,respuesta,tipo,estado FROM diagnosticos WHERE tarjeta = '$tarjeta'";
        $resultado = $conexion->query($consulta);


        if ($resultado->num_rows > 0) {
            echo "<p>Hola, número de tarjeta: $tarjeta</p>";
            echo "<table border='1'>
                    <tr>
                        <th>Sintomas</th>
                        <th>Solución</th>
                        <th>Tipo de diagnostico</th>
                        <th>Estado</th>
                    </tr>";
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>
                        <td>" . $fila['sintomas'] . "</td>
                        <td>" . $fila['respuesta'] . "</td>
                        <td>" . $fila['tipo'] . "</td>
                        <td>" . $fila['estado'] . "</td>
                      </tr>";
            }
            echo "</table>";

            // Formulario para añadir nueva fila
            
        } else {
            echo "<p>No se encontraron citas para el número de tarjeta: $tarjeta</p>";
        }
        echo "<h2>Añadir nueva fila</h2>";
            echo "<form action='server/guardar_historial.php' method='post'>
                    <label for='sintomas'>Síntomas:</label>
                    <input type='text' name='sintomas' required><br>

                    <label for='respuesta'>Solución:</label>
                    <input type='text' name='respuesta' required><br>

                    <label for='tipo'>Tipo de diagnóstico:</label>
                    <input type='text' name='tipo' required><br>

                    <label for='estado'>Estado:</label>
                    <input type='text' name='estado' required><br>

                    <input type='hidden' name='tarjeta' value='$tarjeta'>
                    <input type='submit' value='Añadir a historial'>
                  </form>";

        // Cerrar la conexión
        $conexion->close();
    } else {
        echo "<p>Número de tarjeta no proporcionado.</p>";
    }
    ?>
<div class="contenedorRegistro margenVolver">
            <a class="textLinks" href="sanitario.php"> < Volver al panel principal </a>
        </div>
    <footer class="modal-footer">
        <p>&copy; 2023 Sistema de Autodiagnóstico de Síntomas</p>
        
    </footer>
</body>
</html>
