<?php
session_start();

$db = mysqli_connect('localhost', 'root', '', 'osakidetza');
$user = $_POST['user'];
$pass = $_POST['pass'];


$user_check_query = "SELECT * FROM usuario WHERE tarjeta = ? AND contra = ?;";
$stmt = $db->prepare($user_check_query);
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$stmt->close();

if ($usuario) {
    $_SESSION['user'] = $user;
    $_SESSION['success'] = "Hola, $user";
    $_SESSION['expira'] = 120;
    $_SESSION['ult_actividad'] = time();
    $exito = 1;
    $sesion = "INSERT INTO sesion (clave, exito) VALUES (?, ?)";
    $stmt = $db->prepare($sesion);
    $stmt->bind_param("si", $user, $exito);
    $stmt->execute();
    $stmt->close();
    
    header('location: ../panelUsuario/usuario.php');
} else {
    $_SESSION['errUserContra'] = true;
    $exito = 0;
    $sesion = "INSERT INTO sesion (clave, exito) VALUES (?, ?)";
    $stmt = $db->prepare($sesion);
    $stmt->bind_param("si", $user, $exito);
    $stmt->execute();
    $stmt->close();
    header('location: ../inicioSesionCiudadano.php');
}

mysqli_close($db);
?>

    
