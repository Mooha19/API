<?php
session_start();
if ($_SESSION['ult_actividad'] < time() - $_SESSION['expira']) {
    session_unset();
    
    session_destroy();
} else {
    $_SESSION['ult_actividad'] = time(); //SETEAMOS NUEVO TIEMPO DE ACTIVIDAD
    $db = mysqli_connect('localhost', 'admin', 'test', 'medicina');
    $user = $_SESSION['user'];
    $user_check_query = "SELECT * FROM sanitario WHERE colegiado = '$user';";
    $res = mysqli_query($db, $user_check_query);
    $sanitario = mysqli_fetch_assoc($res);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Sanitarios</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/second.css'>
    <link rel="icon" href='../img/logo.ico' type ='image/x-icon'>
    <script src='../js/bootstrap.bundle.js'></script>
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
                   
                    <button onclick="location.href='registro.php'" type="button" class="btn btn-dark">Editar Datos</button>
                   
                </div>
            </div>
        </nav>
    </div>    
    <main>
    <div class="contenedor">
        <div class="fila">
            <img src="../img/ver_citas.jpg" alt="Imagen 1">
            <img src="../img/pedir.png" alt="Imagen 2">
        </div>
        <div class="fila">
            <button onclick="location.href='ver_citas_sanitario.php'">Consultar Agenda</button>
            <button onclick="location.href='citar_especialista.php'">Citar con especialista</button>
        </div>
        <div class="fila">
            <img src="../img/auto.png" alt="Imagen 3">
            <img src="../img/pedir.png" alt="Imagen 4">
        </div>
        <div class="fila">
            <button onclick="location.href='lista_autodiagnosticos.php'">Aprobar Autodiagnosticos</button>
            <form action="ver_historial_paciente.php" method="GET">
                <label for="tarjeta">Paciente</label>
                <input type="tarjeta" id="tarjeta" name="tarjeta" required>
                <button type="submit">Ver Historial</button>
            </form>
        </div>
    </div>    
    </main>

    <footer class="modal-footer">
        <p>Josu te queremos </p>
        <p>
          <a href="#">Arriba</a>
        </p>
    </footer>
</body>
</html>