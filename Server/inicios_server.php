<?php
session_start();

$db = mysqli_connect('localhost', 'admin', 'test', 'medicina');
$user = $_POST['user'];
$pass = $_POST['pass'];

// Evitar inyección de SQL utilizando consultas preparadas
$user_check_query = "SELECT * FROM sanitario WHERE colegiado = ? AND contra = ?;";
$stmt = $db->prepare($user_check_query);
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$stmt->close();

if ($usuario) {
    $_SESSION['user'] = $user;
    $_SESSION['success'] = "Hola, $user";
    $_SESSION['expira'] = 60;
    $_SESSION['ult_actividad'] = time();
    $exito = 1;
    $sesion = "INSERT INTO sesion (tarjeta, exito) VALUES (?, ?)";
    $stmt = $db->prepare($sesion);
    $stmt->bind_param("si", $user, $exito);
    $stmt->execute();
    $stmt->close();
    // Utilizar barras diagonales para rutas
    header('location: ../panelSanitario/sanitario.php');
} else {
    $_SESSION['errUserContra'] = true;
    $exito = 0;
    $sesion = "INSERT INTO sesion (tarjeta, exito) VALUES (?, ?)";
    $stmt = $db->prepare($sesion);
    $stmt->bind_param("si", $user, $exito);
    $stmt->execute();
    $stmt->close();
    header('location: ../inicioSesionSanitario.php');
}

mysqli_close($db);
?>
