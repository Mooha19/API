<?php
session_start();

$colegiado = "0";
$tarjeta = "";
$fecha = "";
$hora = "";
$tipo = "";

$db = mysqli_connect('localhost', 'root', '', 'osakidetza');

$tarjeta = htmlspecialchars($_POST['tarjeta']);
$fecha = htmlspecialchars($_POST['date']);
$hora = htmlspecialchars($_POST['hora']);
$tipo = htmlspecialchars($_POST['tipocita']);
if($tipo == "Consulta presencial" || $tipo == "Consulta telefónica"){
    $colegiado = htmlspecialchars($_POST['cole']);
}else{
    $colegiado = htmlspecialchars($_POST['colenfer']);
}

$query = "INSERT INTO citas (colegiado, tarjeta, fecha, hora, tipo) VALUES (?, ?, ?, ?, ?);";
$stmt = $db->prepare($query);
$stmt->bind_param("sssss", $colegiado,$tarjeta, $fecha, $hora, $tipo);

$stmt->execute();
$stmt->close();
header('location: ../usuario.php');

    
?>
