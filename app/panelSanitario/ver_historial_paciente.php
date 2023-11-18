<?php
session_start();
if ($_SESSION['ult_actividad'] < time() - $_SESSION['expira']) {
    session_unset();    
    session_destroy();
    header('location: ../index.php');
}else {
    $_SESSION['ult_actividad'] = time(); 
    $db = mysqli_connect('localhost', 'root', '', 'osakidetza');

    $user = $_SESSION['user'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='../css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/second.css'>
    <title>Ver Historial</title>
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
    <h1>Historial del paciente: </h1>

    <?php
    if (isset($_GET['tarjeta'])) {
        $tarjeta = $_GET['tarjeta'];

        // Realizar la conexión a la base de datos (reemplaza estos valores con los tuyos)
        $conexion = new mysqli("localhost", "root", "", "osakidetza");

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Consulta para obtener citas asociadas con la tarjeta proporcionada
        $consulta = "SELECT sintomas,respuesta,tipo,estado,comentarios FROM diagnosticos WHERE tarjeta = '$tarjeta'";
        $resultado = $conexion->query($consulta);

        $cons = "SELECT nombre FROM usuario WHERE tarjeta = '$tarjeta'";
        $res = $conexion->query($cons);
        $usu = $res->fetch_assoc();
        $nombre = $usu['nombre'];



        if ($resultado->num_rows > 0) {
            echo "<p> $nombre</p>";
            echo "<table border='1'>
                    <tr>
                        <th>Sintomas</th>
                        <th>Diagnóstico</th>
                        <th>Tipo de diagnóstico</th>
                        <th>Estado</th>
                        <th>Observaciones</th>
                    </tr>";
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>
                        <td>" . $fila['sintomas'] . "</td>
                        <td>" . $fila['respuesta'] . "</td>
                        <td>" . $fila['tipo'] . "</td>
                        <td>" . $fila['estado'] . "</td>
                        <td>" . $fila['comentarios'] . "</td>
                      </tr>";
            }
            echo "</table>";

            // Formulario para añadir nueva fila
            
        } else {
            echo "<p>No se encontraron citas para el paciente: $nombre</p>";
        }
        echo "<h2>Añadir nueva fila</h2>";
            echo "<form action='server/guardar_historial.php' method='post'>
                    <label for='sintomas'>Síntomas:</label>
                    <input type='text' name='sintomas' required><br>

                    <label for='respuesta'>Diagnóstico:</label>
                    <input type='text' name='respuesta' required><br>

                    <label for='tipo'>Tipo de diagnóstico:</label>
                    <input type='text' name='tipo' required><br>
                    
                    <label for='comentarios'>Observaciones:</label>
                    <input type='text' name='comentarios' required><br>

                    <input type='hidden' name='tarjeta' value='$tarjeta'>
                    <input type='hidden' name='colegiado' value='$user'>
                    
                    <input type='submit' value='Añadir a historial'>
                  </form>";

        // Cerrar la conexión
        $conexion->close();
    } else {
        echo "<p>Número de tarjeta no proporcionado.</p>";
    }
    ?>
<div class="contenedorRegistro margenVolver">
            <a class="textLinks" href="sanitario.php"> < Volver atrás </a>
        </div>
    <footer class="modal-footer">
        <p>&copy; 2023 Sistema de Autodiagnóstico de Síntomas</p>
        
    </footer>
</body>
</html>
