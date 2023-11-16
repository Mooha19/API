<?php
session_start();

if ($_SESSION['ult_actividad'] < time() - $_SESSION['expira']) {
    session_unset();
    session_destroy();
    header('location: ../index.php');
} else {
    $_SESSION['ult_actividad'] = time(); //SETEAMOS NUEVO TIEMPO DE ACTIVIDAD
    $db = mysqli_connect('localhost', 'admin', 'test', 'medicina');
    $user = $_SESSION['user'];

    $hoy = date("Y-m-d");
    if (isset($_POST['nueva_fecha'])) {
        $nueva_fecha = $_POST['nueva_fecha'];
    } else {
        $nueva_fecha = $hoy; // Si no se ha enviado una nueva fecha, mostramos las citas de hoy por defecto
    }
    
    //Obtener nombre del usuario      
    $consulta = "SELECT citas.*, usuario.nombre FROM citas INNER JOIN usuario ON citas.tarjeta = usuario.tarjeta WHERE citas.colegiado = '$user' AND citas.fecha = '$nueva_fecha' ORDER BY hora";
    $resultado = $db->query($consulta);
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Citas</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Agenda de Citas para el día <?php echo $nueva_fecha; ?></h1>

    <form method="post" action="">
        <label for="nueva_fecha">Seleccionar fecha:</label>
        <input type="date" id="nueva_fecha" name="nueva_fecha" value="<?php echo $nueva_fecha; ?>">
        <input type="submit" value="Cambiar Fecha">
    </form>

    <?php
    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr>
        <th>Hora</th>
        <th>Paciente</th>
        <th>tipo</th>
    </tr>";

while ($fila = $resultado->fetch_assoc()) {
    echo "<tr>
            <td>" . $fila['hora'] . "</td>
            <td>" . $fila['nombre'] . "</td>
            <td>" . $fila['tipo'] . "</td>
        </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No hay citas para la fecha seleccionada.</p>";
    }
    ?>
    <div class="contenedorRegistro margenVolver">
            <a class="textLinks" href="sanitario.php"> < Volver al panel principal</a>
    </div>
    <footer class="modal-footer">
        <p>&copy; 2023 Sistema de Autodiagnóstico de Síntomas</p>
        
    </footer>
</body>
</html>
