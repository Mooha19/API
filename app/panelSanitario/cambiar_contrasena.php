<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Cambio de Contraseña</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/second.css'>
    <link rel="icon" href='img/logo.ico' type ='image/x-icon'>
    <script src='../js/bootstrap.bundle.js'></script>
    <script src='js/actualizar.js'></script>
</head>
<body>
    <div class= "container text-center mt-5">
        <h1>Cambiar Contraseña</h1>
    </div>
    <div class = "contenedorRegistro margenRegistro p-5 bordeRegistro rounded-3">
        <div class = "row mb-2">
            <div class="col-lg-4 text-end p-2">
                <p>Contraseña actual: </p>
            </div>
            <div class="col-lg-4 ps-5 text-start" id = "contraAct">
                <form name= "actContra" action="server/actualizar.php" method="POST">
                    <input name = "actContraAct" type="password" class="form-control" id="actContraAct">
            </div>
        </div>
        <div class = "row mb-4">
            <div class="col-lg-4 text-end p-2">
                <p>Nueva contraseña: </p>
            </div>
            <div class="col-lg-4 ps-5 text-start" id = "contraNueva">
                    <input name = "actContraNueva" type="password" class="form-control" id="actContraNueva">
                </form>
                <?php if (isset($_SESSION['successActContra'])) : ?>
                    <p class= 'text-success'>La contraseña se ha actualizado</p>
                <?php elseif (isset($_SESSION['errorActContra'])) : ?>
                    <p class= 'text-danger'>Esa contraseña no es tu contraseña actual</p>
                <?php endif ?>
                </div>
            <div class = "col-lg-4">
                <button name = "contraBot" type="button" class= "btn btn-primary" onclick="comprobarContra()"> Actualizar contraseña</button>
            </div>
         </div>
    </div>
    <div class="contenedorRegistro margenVolver">
        <a class="textLinks" href="sanitario.php"> < Volver atrás</a>
    </div>
    <footer class="modal-footer">
        <p>&copy; 2023 Sistema de Autodiagnóstico de Síntomas</p>
    </footer>
</body>
</html>
<?php

unset($_SESSION['successActContra']);
unset($_SESSION['errorActContra']);

?>