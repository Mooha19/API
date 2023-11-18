<?php
session_start();

if ($_SESSION['ult_actividad'] < time() - $_SESSION['expira']) {
    session_unset();
    session_destroy();
    header('location: ../index.php');
} else {
    $_SESSION['ult_actividad'] = time(); 
    $db = mysqli_connect('localhost', 'root', '', 'osakidetza');

    $user = $_SESSION['user'];

    $hoy = date("Y-m-d");
    if (isset($_POST['nueva_fecha'])) {
        $nueva_fecha = $_POST['nueva_fecha'];
    } else {
        $nueva_fecha = $hoy; 
    }
    
         
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
    <link rel='stylesheet' type='text/css' media='screen' href='../css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/second.css'>
    <title>Agenda de Citas</title>
    
</head>
<body>
<div class="container">
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container-fluid">
                <img  src="../img/logo.png">
                <a class="navbar-brand" href="#">Osakidetza</a> 
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navi" aria-control="navi" 
                aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <img  src="../img/DS.png">
                <div class="collapse navbar-collapse" id="navi">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Inicio</a>               

                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Edición para Sanitarios </a>              

                        </li>
                      
                    </ul>              
                    <button onclick="location.href='../server/cerrar.php'" type="button" class="btn btn-outline-dark me-2">Cerrar Sesión</button>
                   
                    <button onclick="location.href='cambiar_contrasena.php'" type="button" class="btn btn-dark">Cambiar Contraseña</button>
                   
                </div>
            </div>
        </nav>
    </div>    
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
            <a class="textLinks" href="sanitario.php"> < Volver atrás</a>
    </div>
    <footer class="modal-footer">
        <p>&copy; 2023 Sistema de Autodiagnóstico de Síntomas</p>
        
    </footer>
</body>
</html>
