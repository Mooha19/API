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
    $user_check_query = "SELECT * FROM cita WHERE tarjeta = '$user';";
    $res = mysqli_query($db, $user_check_query);
    $usuario = mysqli_fetch_assoc($res);

    //Obtener nombre del usuario
    $citas_query = "SELECT citas.*,sanitario.nombre,sanitario.especialidad,sanitario.tipo_trabajo,sanitario.trabajo FROM citas WHERE tarjeta = '$user' INNER JOIN
    sanitario ON citas.colegiado = sanitario.colegiado;";    
    $res = mysqli_query($db, $citas_query);
    $citas = array();
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $citas[] = $row;
        }
    };
    echo '<script>';
    echo 'var citas = ' . json_encode($citas) . ';';
    echo '</script>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Mis Citas</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/second.css'>
    <link rel="icon" href='img/logo.ico' type ='image/x-icon'>
    <script src='../js/bootstrap.bundle.js'></script>
    <script src = 'js/vercitas.js'></script>
</head>
<body>
    <div class= "container text-center mt-5">
        <h1>Mis Citas</h1>
    </div>
    <div class = "contenedorRegistro margenRegistro p-5 bordeRegistro rounded-3">
        <h1>Agenda Médica</h1>
            <table id="tabla-citas">
            <thead>
                <tr>
                    <th>Día</th>
                    <th>Tipo</th>
                    <th>Sanitario</th>
                    <th>Especialidad</th>
                    <th>Lugar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody></tbody>
            </table>
    </div>
        <div class="contenedorRegistro margenVolver">
            <a class="textLinks" href="index.php"> < Volver a inicio</a>
        </div>
</body>
</html>
<?php
unset($_SESSION['errUserContra']);
?>