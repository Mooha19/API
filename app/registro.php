<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Registro</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/second.css'>
    <link rel="icon" href='img/logo.ico' type ='image/x-icon'>
    <script src='js/bootstrap.bundle.js'></script>
    <script src='js/main.js'></script>
</head>
<body>
    <div class= "container text-center mt-5">
        <h1>Registro</h1>
    </div>
        <div id="princ" class = "contenedorRegistro margenRegistro p-5 bordeRegistro rounded-3">
            <form name="reg" action="server/registro_server.php" method="POST">
                <div id="c1" class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input name = "nombre" type="text" class="form-control" id="controlName" placeholder = "ej: Antonio">
                </div>
                <div id = "c2" class="mb-3">
                    <label for="surnames" class="form-label">Apellidos</label>
                    <input name= "apellidos" type="text" class="form-control" id="controlSurname" placeholder = "ej: Pérez Gómez">
                </div>
                <div id = "c3" class="mb-3">
                    <label for="tel" class="form-label">Teléfono</label>
                    <input name = "tel" type="tel" class="form-control" id="controlTel" placeholder = "ej: 660066006">
                </div>
                <div id = "c4" class="mb-3">
                    <label for="date" class="form-label">Fecha de nacimiento</label>
                    <input name = "fecha" type="date" class="form-control" id="controlFecha">
                </div>
                <div id="c5"  class="mb-3">
                    <label for="provincia" class="form-label">Provincia:</label>
                    <select id="provincia" name="provincia" onchange="cargarCiudades()">
                        <option value="" disabled selected>Selecciona una provincia</option>
                        <option value="Alava">Álava</option>
                        <option value="Guipuzcoa">Guipuzkoa</option>
                        <option value="Vizcaya">Vizcaya</option>                       
                    </select>                    
                </div>            
                <div id="c6" class="mb-3">
                    <label for="ciudad" class="form-label">Ciudad:</label>
                    <select id="ciudad" name="ciudad" oninput="buscarAmbulatorioYMedico()" >
                        <option value="" disabled selected>Selecciona una ciudad</option>
                        
                    </select>
                </div>                  
                <div id="c7" class="mb-3">
                    <label for="ambulatorio" class="form-label">Ambulatorio Asignado</label>
                    <input name = "ambulatorio" type="text" class="form-control" id="ambulatorio" readonly>
                </div>
                <div id="c8" class="mb-3">
                    <label for="medico" class="form-label">Médico de Cabecera Asignado</label>
                    <input name = "medico" type="text" class="form-control" id="medico"  readonly>
                </div>
                <div id="c9" class="mb-3 hidden ">
                    <label for="cole" class="form-label">colegiado Asignado</label>
                    <input name="cole" type="text" class="form-control" id="cole" readonly>
                </div>

                <div id = "c10" class="mb-3">
                    <label for="usern" class="form-label">Tarjeta Sanitaria</label>
                    <input name= "username" type="text" class="form-control" id="controlId" placeholder = "ej: 00112545">
                </div>
                <div id = "c11" class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input name = "contra" type="password" class="form-control" id="controlPass">
                </div>
                <div id = "c12" class="mb-3">
                    <label for="password" class="form-label">Repetir contraseña</label>
                    <input name = "contra_repetir" type="password" class="form-control" id="controlPassRepeat">
                </div>                
                <?php if (isset($_SESSION['errorUsername'])) : ?>
                    <p class="text-danger" id="errUsername">La tarjeta sanitaria ya está creada</p>
                <?php endif; ?>               
                
                <button type="button" class= "btn btn-primary" onclick="comprobardatos()"> Enviar</button>
            </form>
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
unset($_SESSION['errorUsername']);

?>