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
    
    //Obtener nombre del usuario      
    $consulta = "SELECT * FROM diagnosticos WHERE tipo = 'autodiagnostico' AND tarjeta = '$user'  ";
    $resultado = $db->query($consulta);
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Autodiagnosticos</title>
    
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
    <h1>Consultar autodiagnosticos </h1>

    
    <?php
    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr>
        <th>Sintomas</th>
        <th>Resultado</th>
        <th>Estado</th>
        

    </tr>";

while ($fila = $resultado->fetch_assoc()) {
    echo "<tr>
            <td>" . $fila['sintomas'] . "</td>
            <td>" . $fila['respuesta'] . "</td>
            <td>" . $fila['estado'] . "</td>
            
        </tr>";
        }
        


        echo "</table>";
    } else {
        echo "<p>No tiene autodiagnosticos realizados .</p>";
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