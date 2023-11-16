<?php
session_start();

$nombre = "";
$apellidos = "";
$tel = "0";
$fecha = "";
$provincia = "";
$ciudad = "";
$tarjeta ="0";
$contra = "";
$cabecera = "";
$ambulatorio = "";

$db = mysqli_connect('localhost', 'admin', 'test', 'medicina');
$nombre = htmlspecialchars($_POST['nombre']);
$apellidos = htmlspecialchars($_POST['apellidos']);
$tel = htmlspecialchars($_POST['tel']);
$fecha = htmlspecialchars($_POST['fecha']);
$provincia = htmlspecialchars($_POST['provincia']);
$ciudad = htmlspecialchars($_POST['ciudad']);
$tarjeta = htmlspecialchars($_POST['username']);
$contra = htmlspecialchars($_POST['contra']);
$cabecera = htmlspecialchars($_POST['cole']);
$ambulatorio = htmlspecialchars($_POST['ambulatorio']);
$error = false;
$nacim = date("Y-m-d", strtotime($fecha));

$user_check_query = "SELECT * FROM usuario WHERE tarjeta = ?;";
$stmt = $db -> prepare($user_check_query);
$stmt -> bind_param("s", $tarjeta);
$stmt -> execute();
$result = $stmt -> get_result();
$usuariotarjeta = $result -> fetch_assoc();
$stmt-> close();



if ($usuariotarjeta) {
    $error = true;    
}

if (!$error){
    $query = "INSERT INTO usuario VALUES (?,?,?,?,?,?,?,?,?,?);";
    $stmt = $db -> prepare($query);
    $stmt -> bind_param("sssissssss", $nombre, $apellidos, $tel, $nacim, $provincia, $ciudad, $tarjeta, $contra, $cabecera, $ambulatorio);
    $stmt -> execute();
    $stmt-> close();
    header('location: ../index.php');
    
} else {    
    header('location: ../registro.php');
}

?>
