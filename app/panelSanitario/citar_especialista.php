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
    $user_check_query = "SELECT * FROM sanitario WHERE colegiado = '$user';";
    $res = mysqli_query($db, $user_check_query);
    $usuario = mysqli_fetch_assoc($res);
    $lm = $usuario['trabajo'];
    $tm =$usuario['tipo_trabajo'];
            
    $query = "SELECT * FROM sanitario WHERE especialidad = 'enfermeria' AND trabajo = '$lm' AND provincia = (SELECT provincia FROM sanitario WHERE colegiado = '$user') ORDER BY RAND() LIMIT 1;";
    $res2 = mysqli_query($db,$query);
    $enfermero = mysqli_fetch_assoc($res2);
    $le=$enfermero['trabajo'];
    $te= $enfermero['tipo_trabajo'];
       

    $query_digest = "SELECT * FROM sanitario WHERE especialidad = 'digestivo' AND provincia = (SELECT provincia FROM sanitario WHERE colegiado = '$user') ORDER BY RAND() LIMIT 1;";
    $res3 = mysqli_query($db,$query_digest);
    $digestivo = mysqli_fetch_assoc($res3);
    $ld = $digestivo['trabajo'];
    $td = $digestivo['tipo_trabajo'];

    $query_cardio = "SELECT * FROM sanitario WHERE especialidad = 'cardiologia' AND provincia = (SELECT provincia FROM sanitario WHERE colegiado = '$user') ORDER BY RAND() LIMIT 1;";
    $res4 = mysqli_query($db,$query_cardio);
    $cardiologo = mysqli_fetch_assoc($res4);
    $lc = $cardiologo['trabajo'];
    $tc = $cardiologo['tipo_trabajo'];
     
    $query_trauma = "SELECT * FROM sanitario WHERE especialidad = 'traumatologia' AND provincia = (SELECT provincia FROM sanitario WHERE colegiado = '$user') ORDER BY RAND() LIMIT 1;";
    $res5 = mysqli_query($db,$query_trauma);
    $traumatologo = mysqli_fetch_assoc($res5);
    $lt = $traumatologo['trabajo'];
    $tt =  $traumatologo['tipo_trabajo'];

    $query_oft = "SELECT * FROM sanitario WHERE especialidad = 'oftalmologia' AND provincia = (SELECT provincia FROM sanitario WHERE colegiado = '$user') ORDER BY RAND() LIMIT 1;";
    $res6 = mysqli_query($db,$query_oft);
    $oftalmologo = mysqli_fetch_assoc($res6);
    $lo = $oftalmologo['trabajo'];
    $to = $oftalmologo['tipo_trabajo'];

    $query_gine = "SELECT * FROM sanitario WHERE especialidad = 'ginecologia' AND provincia = (SELECT provincia FROM sanitario WHERE colegiado = '$user') ORDER BY RAND() LIMIT 1;";
    $res7 = mysqli_query($db,$query_gine);
    $ginecologo = mysqli_fetch_assoc($res7);
    $lg = $ginecologo['trabajo'];
    $tg = $ginecologo['tipo_trabajo'];
        
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
            <script src='../panelSanitario/js/pedircitasani.js'></script>
           
        </head>
        <body>
            <div class= "container text-center mt-5">
                <h1>Citar paciente </h1>
            </div>
            <div id="princ" class = "contenedorRegistro margenRegistro p-5 bordeRegistro rounded-3">
                <form name="reg" action="server/insertar_cita_sanitario.php" method="POST">
                    <div id = "c1" class="mb-3">
                        <label for="usern" class="form-label">Tarjeta Sanitaria del Paciente</label>
                        <input name= "username" type="text" class="form-control" id="controlId" >
                    </div>
                    <div id="c2" class="mb-3">
                        <label for="tipocita" class="form-label">Tipo de Cita:</label>
                        <select id="tipocita" name="tipocita" onchange="mostrarCampos(); obtenerlugar();" >
                            <option value="seleccionar" selected>Seleccionar tipo de cita</option>
                            <option value="Consulta presencial">Consulta presencial</option>
                            <option value="Consulta telefónica">Consulta telefónica</option>
                            <option value="Vacunas">Vacunación</option>
                            <option value="Análisis">Analítica</option>   
                            <option value="Curaciones">Curas</option>
                            <option value="Digestivo">Digestivo</option>
                            <option value="Cardiología">Cardiología</option>
                            <option value="Traumatología">Traumatología</option>
                            <option value="Oftalmología">Oftalmología</option>
                            <option value="Ginecología">Ginecología</option>  
                                      
                        </select>                    
                    </div>
                    <div id="c3" class="mb-3 hidden">
                        <label for="medic" class="form-label">Médico Asignado</label>
                        <input name="medic" type="text" class="form-control" id="medic" value="<?php echo $usuario['nombre']; ?>" readonly>
                    </div>
                    <div id="c4" class="mb-3 hidden">
                        <label for="enfer" class="form-label">Enfermer@ Asignado</label>
                        <input name="enfer" type="text" class="form-control" id="enfer" value="<?php echo $enfermero['nombre']; ?>" readonly>
                    </div>
                    <div id="c5" class="mb-3 hidden">
                        <label for="digest" class="form-label">Digestiv@ Asignado</label>
                        <input name="digest" type="text" class="form-control" id="digest" value="<?php echo $digestivo['nombre']; ?>" readonly>
                    </div>
                    <div id="c6" class="mb-3 hidden">
                        <label for="cardio" class="form-label">Cardiolog@ Asignado</label>
                        <input name="cardio" type="text" class="form-control" id="cardio" value="<?php echo $cardiologo['nombre']; ?>" readonly>
                    </div>
                    <div id="c7" class="mb-3 hidden">
                        <label for="traumat" class="form-label">Traumatolog@ Asignado</label>
                        <input name="traumat" type="text" class="form-control" id="traumat" value="<?php echo $traumatologo['nombre']; ?>" readonly>
                    </div>
                    <div id="c8" class="mb-3 hidden">
                        <label for="oftalm" class="form-label">Oftalmolog@ Asignado</label>
                        <input name="oftalm" type="text" class="form-control" id="oftalm" value="<?php echo $oftalmologo['nombre']; ?>" readonly>
                    </div>
                    <div id="c9" class="mb-3 hidden">
                        <label for="ginecol" class="form-label">Ginecolog@ Asignado</label>
                        <input name="ginecol" type="text" class="form-control" id="ginecol" value="<?php echo $ginecologo['nombre']; ?>" readonly>
                    </div>
                    <div id="c10" class="mb-3 hidden">
                        <label for="cole" class="form-label">colegiado medico Asignado</label>
                        <input name="cole" type="text" class="form-control" id="cole" value="<?php echo $user; ?>" readonly>
                    </div>
                    <div id="c11" class="mb-3 hidden">
                        <label for="colenfer" class="form-label">colegiado  enfermero Asignado</label>
                        <input name="colenfer" type="text" class="form-control" id="colenfer" value="<?php echo $enfermero['colegiado']; ?>" readonly>
                    </div>
                    <div id="c12" class="mb-3 hidden">
                        <label for="coledig" class="form-label">colegiado digestivo Asignado</label>
                        <input name="coledig" type="text" class="form-control" id="coledig" value="<?php echo $digestivo['colegiado']; ?>" readonly>
                    </div>
                    <div id="c13" class="mb-3 hidden">
                        <label for="colecar" class="form-label">colegiado cardiologo Asignado</label>
                        <input name="colecar" type="text" class="form-control" id="colecar" value="<?php echo $cardiologo['colegiado']; ?>" readonly>
                    </div>
                    <div id="c14" class="mb-3 hidden">
                        <label for="coletrau" class="form-label">colegiado trauma Asignado</label>
                        <input name="coletrau" type="text" class="form-control" id="coletrau" value="<?php echo $traumatologo['colegiado']; ?>" readonly>
                    </div>
                    <div id="c15" class="mb-3 hidden">
                        <label for="coleoft" class="form-label">colegiado  oft Asignado</label>
                        <input name="coleoft" type="text" class="form-control" id="coleoft" value="<?php echo $oftalmologo['colegiado']; ?>" readonly>
                    </div>
                    <div id="c16" class="mb-3 hidden">
                        <label for="colegin" class="form-label">colegiado  ginecologo Asignado</label>
                        <input name="colegin" type="text" class="form-control" id="colegin" value="<?php echo $ginecologo['colegiado']; ?>" readonly>
                    </div>
                    <div id="c17" class="mb-3">
                        <label for="date">Fecha:</label>
                        <input type="date" id="date" name="date" min="<?php echo $fechaSiguiente; ?>" required oninput="filtrarFechas()">
                    </div>
                    <div id="c18" class="mb-3">
                        <label for="hora">Hora:</label>
                        <select id="hora" name="hora" required></select>
                    </div>
                    <div id="c19" class="mb-3">
                            <label for="tipo" class="form-label">Centro Asignado</label>
                            <input name = "tipo" type="text" class="form-control" id="tipo"  readonly>
                    </div>
                    <div id="c20" class="mb-3  ">
                            <label for="lugar" class="form-label"></label>
                            <input name="lugar" type="text" class="form-control" id="lugar" readonly>
                    </div>
            

                    <?php if (isset($_SESSION['errorUsername'])) : ?>
                        <p class="text-danger" id="errUsername">El código ya está elegido</p>
                    <?php endif; ?>               
                    
                    <button type="button" class="btn btn-primary" onclick="comprobardatos()">Enviar</button>
                </form>
            </div>
            <div class="contenedorRegistro margenVolver">
            <a class="textLinks" href="sanitario.php">< Volver atrás</a>
            </div>
            <footer class="modal-footer">
                <p>&copy; 2023 Sistema de Autodiagnóstico de Síntomas</p>        
            </footer>
        </body>
    </html>
    <script>
    
    var datosSanitario = {
        lm: <?php echo json_encode($lm); ?>,
        tm: <?php echo json_encode($tm); ?>,
        le: <?php echo json_encode($le); ?>,
        te: <?php echo json_encode($te); ?>,
        ld: <?php echo json_encode($ld); ?>,
        td: <?php echo json_encode($td); ?>,
        lc: <?php echo json_encode($lc); ?>,
        tc: <?php echo json_encode($tc); ?>,
        lt: <?php echo json_encode($lt); ?>,
        tt: <?php echo json_encode($tt); ?>,
        lo: <?php echo json_encode($lo); ?>,
        to: <?php echo json_encode($to); ?>,
        lg: <?php echo json_encode($lg); ?>,
        tg: <?php echo json_encode($tg); ?>
    };
    </script>
    <?php
    unset($_SESSION['errorUsername']);
    ?>