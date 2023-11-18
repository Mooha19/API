<?php

if (isset($_POST['actContraNueva'])) { 
    actualizarContra();
}

function actualizarContra() {
    session_start();
    $tarjeta = $_SESSION['user'];
    $db = mysqli_connect('localhost', 'root', '', 'osakidetza');
    $contraN = htmlspecialchars($_POST['actContraNueva']);
    $contraAct = htmlspecialchars($_POST['actContraAct']);
    
    $query = "SELECT * FROM usuario WHERE tarjeta = '$tarjeta';";
    $res = mysqli_query($db, $query);
    $usuario = mysqli_fetch_assoc($res);    

    if ($contraAct == $usuario['contra']) {        
        $query = "UPDATE usuario SET contra = ? WHERE tarjeta = ?;";
        $stmt = $db -> prepare($query);
        $stmt -> bind_param("ss", $contraN, $tarjeta);
        $stmt -> execute();
        $stmt-> close();
        mysqli_query($db, $query);
        $_SESSION['successActContra'] = true;
        header('location: ../cambiar_contrasena.php');
    } else {
        $_SESSION['errorActContra'] = true;
        header('location: ../cambiar_contrasena.php');
    }
    
    
}



?>