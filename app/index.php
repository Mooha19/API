<?php
session_start();
$db = mysqli_connect('localhost', 'admin', 'test', 'medicina');
if (!$db) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
//if ($_SESSION['ult_actividad'] < time() - $_SESSION['expira']) {
//    session_unset();
//    session_destroy();
//} else {
//   $_SESSION['ult_actividad'] = time();
//}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Autodiagnostico</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/second.css'>
    <link rel="icon" href='img/logo.ico' type ='image/x-icon'>
    <script src='js/bootstrap.bundle.js'></script>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Autodiagnostico</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navi" aria-control="navi" 
                aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navi">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Inicio</a>
                        </li>
                      
                    </ul>
                    <button onclick="location.href='inicioSesionSanitario.php'" type="button" class="btn btn-outline-dark me-2">Sanitario</button>
                    <button onclick="location.href='inicioSesionCiudadano.php'" type="button" class="btn btn-outline-dark me-2">Ciudadano</button>
                    <button onclick="location.href='registro.php'" type="button" class="btn btn-dark">Crear cuenta</button>
                   
                </div>
            </div>
        </nav>
    </div>
    
    <main>
        <div class="container">
            <div class="p-4 p-md-5 text-white rounded bg-dark">
                <div class = "row">
                    <div class="col-12 col-md-6">
                        <h3 class="display-4">AUTODIAGNOSTICADOR ONLINE</h3>
                        <p class="lead">Date de alta para poder tener acceso al primer autodiagnosticador en el mundo.
                            Con él podrás evitarte citas médicas y esperas innecesarias.
                        </p>
                        <button type="button" class="btn btn-secondary" onclick="location.href='registro.php'">Crear cuenta</button>
                    </div>
                    <div class ="col-13 col-lg-6 mt-3 mt-lg-4">
                        <img src="img/auto.png" style="margin-left: 140px;">         
      
                        
                    </div>
                </div>
                <div class="my-3 my-md-3 bg-white"></div>
                <div class="p-4 p-md-5 bg-white">
                        <div class="row">
                            <div class="mx-auto mx-sm-0 col-8 col-sm-6 col-lg-3 my-lg-0 mb-3">
                                <div class="container bg-dark rounded p-0">
                                    <img class="imgCuadrada" src="img/vacunacion.png">
                                    <div class="container text-white p-2 text-center">
                                        <h3>Campaña Vacunación Gripe 2023</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-auto mx-sm-0 col-8 col-sm-6 col-lg-3 my-lg-0 mb-3">
                                <div class="container bg-dark rounded p-0">
                                <img class="imgCuadrada" src="img/cancer.png">
                                    <div class="container text-white p-2 text-center">
                                        <h3>Programa detección cancer</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-auto mx-sm-0 col-8 col-sm-6 col-lg-3 my-lg-0 mb-3">
                                <div class="container bg-dark rounded p-0">
                                <img class="imgCuadrada" src="img/donacion.png">
                                    <div class="container text-white p-2 text-center">
                                        <h3>Información Donaciones</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-auto mx-sm-0 col-8 col-sm-6 col-lg-3 my-lg-0 mb-3">
                                <div class="container bg-dark rounded p-0">
                                <img class="imgCuadrada" src="img/tabaco.png">
                                    <div class="container text-white p-2 text-center">
                                        <h3>Mejor Sin Tabaco</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="my-md-5 bg-white"></div>
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