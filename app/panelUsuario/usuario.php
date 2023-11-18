<?php
session_start();
if ($_SESSION['ult_actividad'] < time() - $_SESSION['expira']) {
    session_unset();    
    session_destroy();
    header('location: ../index.php');
} else {
    $_SESSION['ult_actividad'] = time(); //SETEAMOS NUEVO TIEMPO DE ACTIVIDAD
    $db = mysqli_connect('localhost', 'root', '', 'osakidetza');
    $user = $_SESSION['user'];
    $user_check_query = "SELECT * FROM usuario WHERE tarjeta = '$user';";
    $res = mysqli_query($db, $user_check_query);
    $usuario = mysqli_fetch_assoc($res);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Usuarios</title>
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
                            <a class="nav-link active" href="#">Edición para Ciudadanos </a>              

                        </li>
                      
                    </ul>              
                    <button onclick="location.href='../server/cerrar.php'" type="button" class="btn btn-outline-dark me-2">Cerrar Sesión</button>
                   
                    <button onclick="location.href='cambiar_contrasena.php'" type="button" class="btn btn-dark">Cambiar Contraseña</button>
                   
                </div>
            </div>
        </nav>
    </div>    
    <main>
    <div class="cont">
        <div class="option">
            <img src="../img/miscitas.png" alt="Imagen 1">
            <div class="button-container">
                <button onclick="location.href='verusuario.php'">Ver mis citas</button>       
            </div>
            
        </div>
        <div class="option">
            <img src="../img/pedircita.png" alt="Imagen 2">
            <div class="button-container">
                <button onclick="location.href='pedirusuario.php'">Pedir Cita</button>
            </div>
        </div>
        <div class="option">
           <img src="../img/auto.png" alt="Imagen 3"> 
            <div class="button-container">    
                <button onclick="location.href='autodiagnostico.php'">Autodiagnostico</button>
            </div>
        </div>
        <div class="option">
            <img src="../img/consultar.png" alt="Imagen 4">
            <div class="button-container">  
                <button onclick="location.href='consultar_autodiagnosticos.php'">Consultar Autodiagnosticos</button>
            </div>        
        </div>
    </div>    
    </main>

    <footer class="modal-footer">
        <p>&copy; 2023 Sistema de Autodiagnóstico de Síntomas</p>
        <p>
          <a href="#">Arriba</a>
        </p>
    </footer>
</body>
</html>