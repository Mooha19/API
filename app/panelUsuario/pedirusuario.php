<?php
session_start();
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
</head>
<body>
    <div class= "container text-center mt-5">
        <h1>Pedir Citas</h1>
    </div>
        <div id="princ" class = "contenedorRegistro margenRegistro p-5 bordeRegistro rounded-3">
            <form name="reg" action="server/pedircita.php" method="POST">
                <div id="c1" class="mb-3">
                <label for="tipocita" class="form-label">Tipo de Cita:</label>
                    <select id="tipocita" name="tipocita" onchange="mostrarCampos()" >
                        <option value="" disabled selected>Seleccionar tipo de cita</option>
                        <option value="consultap">Consulta presencial</option>
                        <option value="consultat">Consulta telefónica</option>
                        <option value="vacu">Vacunación</option>
                        <option value="anali">Analitica</option>   
                        <option value="cura">Curas</option>                    
                    </select>                    
                </div>
                <div id="c2" class="mb-3">
                    <label for="medic" class="form-label">Medico Asignado</label>
                    <input name = "medic" type="text" class="form-control" id="medic" readonly>
                </div>
                <div id = "c3" class="mb-3">
                    <label for="enfer" class="form-label">Enfermero Asignado</label>
                    <input name = "enfer" type="text" class="form-control" id="enfer" readonly>
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
                        <option value="Gipuzkoa">Gipuzkoa</option>
                        <option value="Bizkaia">Bizkaia</option>                       
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

                <div id = "c8" class="mb-3">
                    <label for="usern" class="form-label">Tarjeta Sanitaria</label>
                    <input name= "username" type="text" class="form-control" id="controlId" placeholder = "ej: AnttonPer">
                </div>
                <div id = "c9" class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input name = "contra" type="password" class="form-control" id="controlPass">
                </div>
                <div id = "c10" class="mb-3">
                    <label for="password" class="form-label">Repetir contraseña</label>
                    <input name = "contra_repetir" type="password" class="form-control" id="controlPassRepeat">
                </div>                
                <?php if (isset($_SESSION['errorUsername'])) : ?>
                    <p class="text-danger" id="errUsername">Elcodigo ya está elegido</p>
                <?php endif; ?>               
                <input type="hidden" name="CSRFToken" value="FQMcSH9G3oSuekSUS5q7fo3ZAciGPJGvA2SAHhrmeTNFMGKG3Raop9WAjKHKc4MKwLXx7dY2wiUbNF5eetFf4">
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