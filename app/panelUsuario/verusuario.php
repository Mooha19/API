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

    //Obtener nombre del usuario
    $consulta = "SELECT citas.*, sanitario.nombre, sanitario.especialidad, sanitario.tipo_trabajo, sanitario.trabajo FROM citas INNER JOIN sanitario ON citas.colegiado = sanitario.colegiado WHERE citas.tarjeta = '$user' AND citas.fecha >= '$hoy'";
  
    $resultado = $db->query($consulta);
    $db->close();

}
?>
<!DOCTYPE html>
<html>
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis  Citas</title>
    <script src='js/vercitas.js'></script>
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
    <h1>Agenda de Citas </h1>

    <?php
        if ($resultado->num_rows > 0) {
            echo "<table>";
            echo "<tr>
                <th>Día</th>
                <th>Hora</th>
                <th>Tipo</th>
                <th>Sanitario</th>
                <th>Especialidad</th>
                <th>Lugar</th>
            </tr>";

            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>
                    <td>" . $fila['fecha'] . "</td>
                    <td>" . $fila['hora'] . "</td>
                    <td>" . $fila['tipo'] . "</td>
                    <td>" . $fila['nombre'] . "</td>
                    <td>" . $fila['especialidad'] . "</td>
                    <td>" . $fila['tipo_trabajo'] . ' ' . $fila['trabajo'] ."</td>
                    <td class='action-buttons'>
                        <button onclick='eliminar_cita(" . $fila['id'] . ")'>Eliminar Cita</button>
                        
            </td>
        </tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No tiene citas .</p>";
        }
    ?>
    </div>
        <div class="contenedorRegistro margenVolver">
            <a class="textLinks" href="index.php"> < Volver a inicio</a>
        </div>
</body>
</html>
<?php
unset($_SESSION['errUserContra']);
?>