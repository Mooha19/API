<?php 
session_start();
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
                            <a class="nav-link active" href="#">Edición para Sanitarios</a>              

                        </li>
                      
                    </ul>              
                    <button onclick="location.href='inicioSesionSanitario.php'" type="button" class="btn btn-outline-dark me-2">Proyectos de Investigación</button>
                   
                    <button onclick="location.href='registro.php'" type="button" class="btn btn-dark">Editar Perfil</button>
                   
                </div>
            </div>
        </nav>
    </div>
    
    <main>
    <div class="image-container">
            <img src="ruta/imagen1.jpg" alt="Imagen 1">
            <p>Texto para la imagen 1</p>
            <button onclick="alert('Botón 1')">Botón 1</button>
        </div>

        <div class="image-container">
            <img src="ruta/imagen2.jpg" alt="Imagen 2">
            <p>Texto para la imagen 2</p>
            <button onclick="alert('Botón 2')">Botón 2</button>
        </div>

        <div class="image-container">
            <img src="ruta/imagen3.jpg" alt="Imagen 3">
            <p>Texto para la imagen 3</p>
            <button onclick="alert('Botón 3')">Botón 3</button>
        </div>

        <div class="image-container">
            <img src="ruta/imagen4.jpg" alt="Imagen 4">
            <p>Texto para la imagen 4</p>
            <button onclick="alert('Botón 4')">Botón 4</button>
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