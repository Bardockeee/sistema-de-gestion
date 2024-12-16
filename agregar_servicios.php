<?php
include 'conexion.php'; 
$con = conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $estado = $_POST['estado'];

    $sql = "INSERT INTO servicios (nombre, descripcion, precio, estado) VALUES ('$nombre', '$descripcion', '$precio', '$estado')";

    if (mysqli_query($con, $sql)) {
        header("Location: servicios.php?mensaje=servicio_agregado");
    } else {
        echo "Error al agregar servicio: " . mysqli_error($con);
    }
}
?>