<?php
session_start();

$colegiado = "0";
$tarjeta = "";
$fecha = "";
$hora = "";
$tipo = "";

$db = mysqli_connect('localhost', 'root', '', 'osakidetza');

$tarjeta = htmlspecialchars($_POST['username']);
$fecha = htmlspecialchars($_POST['date']);
$hora = htmlspecialchars($_POST['hora']);
$tipo = htmlspecialchars($_POST['tipocita']);

if ($tipo == "Consulta presencial" || $tipo == "Consulta telefónica") {
    $colegiado = htmlspecialchars($_POST['cole']);
} else if ($tipo == "Vacunas" || $tipo == "Curaciones" || $tipo == "Análisis") {
    $colegiado = htmlspecialchars($_POST['colenfer']);
}else if ($tipo == "Digestivo" ) {
    $colegiado = htmlspecialchars($_POST['coledig']);
}else if ($tipo == "Cardiología" ) {
    $colegiado = htmlspecialchars($_POST['colecar']);
}else if ($tipo == "Traumatología" ) {
    $colegiado = htmlspecialchars($_POST['coletrau']);
}else if ($tipo == "Oftalmología" ) {
    $colegiado = htmlspecialchars($_POST['coleoft']);
}else if ($tipo == "Ginecología" ) {
    $colegiado = htmlspecialchars($_POST['colegin']);
}    


$query = "INSERT INTO citas (colegiado, tarjeta, fecha, hora, tipo) VALUES (?, ?, ?, ?, ?);";
$stmt = $db->prepare($query);
$stmt->bind_param("sssss", $colegiado,$tarjeta, $fecha, $hora, $tipo);

$stmt->execute();
$stmt->close();
header('location: ../sanitario.php');

    
?>
