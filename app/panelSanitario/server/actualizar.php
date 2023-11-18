<?php

if (isset($_POST['actContraNueva'])) { 
    actualizarContra();
}

function actualizarContra() {
    session_start();
    $colegiado = $_SESSION['user'];
    $db = mysqli_connect('localhost', 'root', '', 'osakidetza');
    $contraN = htmlspecialchars($_POST['actContraNueva']);
    $contraAct = htmlspecialchars($_POST['actContraAct']);
    
    $query = "SELECT * FROM sanitario WHERE colegiado = '$colegiado';";
    $res = mysqli_query($db, $query);
    $sanitario = mysqli_fetch_assoc($res);    

    if ($contraAct == $sanitario['contra']) {        
        $query = "UPDATE sanitario SET contra = ? WHERE colegiado = ?;";
        $stmt = $db -> prepare($query);
        $stmt -> bind_param("ss", $contraN, $colegiado);
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