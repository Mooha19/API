<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Inicio de sesión Personal Sanitario</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/second.css'>
    <link rel="icon" href='img/logo.ico' type ='image/x-icon'>
    <script src='js/bootstrap.bundle.js'></script>
</head>
<body>
    <div class= "container text-center mt-5">
        <h1>Iniciar sesión como Sanitario</h1>
    </div>
        <div class = "contenedorRegistro margenRegistro p-5 bordeRegistro rounded-3">
            <form name = "inic" action= "server/inicioc_server.php" method="POST">
                <div class="mb-3">
                    <label for="user" class="form-label">Nº de colegiado</label>
                    <input name = "user" type="text" class="form-control" id="controlUser">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input name = "pass" type="password" class="form-control" id="controlPass">
                </div>
                <?php if (isset($_SESSION['errUserContra'])) : ?>
                    <p class="text-danger" id="errUsername">El numero de colegiado o contraseña no son correctos</p>
                <?php endif; ?>
                <input type="hidden" name="CSRFToken" value="OWY4NmQwODE4ODRjN2Q2NTlhMmZlYWEwYzU1YWQwMTVhM2JmNGYxYjJiMGI4MjJjZDE1ZDZMGYwMGEwOA==">
                <button type="submit" class= " btn btn-primary "> Enviar</button>
            </form>
        <p class="mt-4 mb-0">Pide a tu Colegio que te inscriba en nuestra web o date alta 
            llamando al 900258779
        </a></p>
        </div>
        <div class="contenedorRegistro margenVolver">
            <a class="textLinks" href="index.php"> < Volver a inicio</a>
        </div>
    <footer class="modal-footer">
        <p>&copy; 2023 Sistema de Autodiagnóstico de Síntomas</p>
    </footer>
</body>
</html>
<?php
unset($_SESSION['errUserContra']);
?>