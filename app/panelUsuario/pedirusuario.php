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
    $user_check_query = "SELECT * FROM usuario WHERE tarjeta = '$user';";
    $res = mysqli_query($db, $user_check_query);
    $usuario = mysqli_fetch_assoc($res);
      
    $colegiado = $usuario['cabecera'];
    

    $medico_query= "SELECT nombre FROM sanitario WHERE colegiado = '$colegiado';";
    $res4 = mysqli_query($db, $medico_query);
    $m = mysqli_fetch_assoc($res4);
    $medico = $m['nombre'];

    $ambulatorio_query= "SELECT ambulatorio FROM usuario WHERE tarjeta = '$user';";
    $res2 = mysqli_query($db, $ambulatorio_query);
    $a = mysqli_fetch_assoc($res2);
    $ambulatorio = $a['ambulatorio'];

    $query = "SELECT colegiado,nombre FROM sanitario WHERE tipo_trabajo = 'ambulatorio' AND trabajo = '$ambulatorio' AND especialidad = 'enfermeria' ORDER BY RAND() LIMIT 1;";
    $res3 = mysqli_query($db,$query);
    $e = mysqli_fetch_assoc($res3);
    $enfermeron = $e['nombre'];
    $enfermeroc = $e['colegiado'];

    $fechaActual = date('Y-m-d');
    $fechaSiguiente = date('Y-m-d', strtotime($fechaActual . ' + 1 day'));
    
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Pedir Cita</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/second.css'>
    <link rel="icon" href='img/logo.ico' type ='image/x-icon'>
    <script src='../js/bootstrap.bundle.js'></script>
    <script src='../panelUsuario/js/pedircitas.js'></script>
    <script src='../panelUsuario/js/fechas.js'></script>
    <script src='../panelUsuario/js/usuario.js'></script>
</head>
<body>
<div class= "container text-center mt-5">
        <h1>Solicitar Cita</h1>
    </div>
    <div id="princ" class = "contenedorRegistro margenRegistro p-5 bordeRegistro rounded-3">
        <form name="reg" action="server/insertar_citas.php" method="POST">
            <div id="c1" class="mb-3">
                <label for="tipocita" class="form-label">Tipo de Cita:</label>
                <select id="tipocita" name="tipocita" onchange="mostrarCampos()">
                    <option value="seleccionar" selected>Seleccionar tipo de cita</option>
                    <option value="Consulta presencial">Consulta presencial</option>
                    <option value="Consulta telefónica">Consulta telefónica</option>
                    <option value="Vacunas">Vacunación</option>
                    <option value="Análisis">Analítica</option>   
                    <option value="Curaciones">Curas</option>                    
                </select>                    
            </div>
            <div id="c2" class="mb-3 hidden">
                <label for="medic" class="form-label">Médico Asignado</label>
                <input name="medic" type="text" class="form-control" id="medic" value="<?php echo $medico; ?>" readonly>
            </div>
            <div id="c3" class="mb-3 hidden">
                <label for="enfer" class="form-label">Enfermer@ Asignado</label>
                <input name="enfer" type="text" class="form-control" id="enfer" value="<?php echo $enfermeron; ?>" readonly>

            </div>
            <div id="c4" class="mb-3 hidden">
                <label for="cole" class="form-label">colegiado Asignado</label>
                <input name="cole" type="text" class="form-control" id="cole" value="<?php echo $colegiado; ?>" readonly>
            </div>
            <div id="c5" class="mb-3 hidden">
                <label for="colenfer" class="form-label">colegiado  Enfer Asignado</label>
                <input name="colenfer" type="text" class="form-control" id="colenfer" value="<?php echo $enfermeroc; ?>" readonly>
            </div>
            <div id="c6" class="mb-3">
                <label for="date">Fecha:</label>
                <input type="date" id="date" name="date" min="<?php echo $fechaSiguiente; ?>" required oninput="filtrarFechas()">
            </div>
            <div id="c7" class="mb-3">
                <label for="hora">Hora:</label>
                <select id="hora" name="hora" required></select>
            </div>
            <div id="c8" class="mb-3 hidden">
                <label for="tarjeta" class="form-label">tarjeta</label>
                <input name="tarjeta" type="text" class="form-control" id="tarjeta" value="<?php echo $user; ?>" readonly>
            </div>
            

            <?php if (isset($_SESSION['errorUsername'])) : ?>
                <p class="text-danger" id="errUsername">El código ya está elegido</p>
            <?php endif; ?>               
            
            <button type="button" class="btn btn-primary" onclick="comprobardatos()">Pedir Cita</button>
        </form>
    </div>
    <div class="contenedorRegistro margenVolver">
        <a class="textLinks" href="usuario.php">< Volver atrás</a>
    </div>
    <footer class="modal-footer">
        <p>&copy; 2023 Sistema de Autodiagnóstico de Síntomas</p>        
    </footer>
</body>
</html>
<?php
unset($_SESSION['errorUsername']);

?>