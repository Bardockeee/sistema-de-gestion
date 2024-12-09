<?php
include 'conexion.php'; 
$con = conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];
    $contraseña = $_POST['contrasena'];

    $sql = "INSERT INTO usuarios (nombre, email, rol, contrasena) VALUES ('$nombre', '$email', '$rol', '$contraseña')";

    if (mysqli_query($con, $sql)) {
        header("Location: usuarios.php?mensaje=usuario_agregado");
    } else {
        echo "Error al agregar usuario: " . mysqli_error($con);
    }
}
?>
