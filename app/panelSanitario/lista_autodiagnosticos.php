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
    
        
    $consulta = "SELECT diagnosticos.*, usuario.nombre AS nombre FROM diagnosticos INNER JOIN usuario ON diagnosticos.tarjeta = usuario.tarjeta WHERE diagnosticos.tipo = 'autodiagnostico' AND diagnosticos.colegiado = '$user' AND diagnosticos.estado = 'pendiente'";
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
    <title>Aprobar Autodiagnosticos</title>
    <script src='js/script.js'></script>
    
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
    <h1>Aprobar autodiagnosticos </h1>
    
    <?php
    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr>
        <th>Paciente</th>
        <th>Sintomas</th>
        <th>Diagnóstico</th>
        <th>Observaciones</th>

    </tr>";

while ($fila = $resultado->fetch_assoc()) {
    echo "<tr>
            <td>" . $fila['nombre'] . "</td>
            <td>" . $fila['sintomas'] . "</td>
            <td>" . $fila['respuesta'] . "</td>
            <td><textarea id='observaciones" . $fila['id'] . "'>" . $fila['comentarios'] . "</textarea></td>
            <td class='action-buttons'>
                        <button onclick='aceptarDiagnostico(" . $fila['id'] . ")'>Aceptar</button>
                        <button onclick='denegarDiagnostico(" . $fila['id'] . ")'>Denegar</button>
            </td>
        </tr>";
        }
        


        echo "</table>";
    } else {
        echo "<p>No hay más autodiagnosticos por evaluar.</p>";
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
