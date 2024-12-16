<?php
include 'conexion.php'; 
$con = conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero = $_POST['numero'];
    $categoria =$_POST['categoria'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $estado = $_POST['estado'];

    $sql = "INSERT INTO habitaciones (numero, categoria,descripcion, precio, estado) VALUES ('$numero', '$categoria','$descripcion', '$precio', '$estado')";

    if (mysqli_query($con, $sql)) {
        header("Location: habitaciones.php?mensaje=habitacion_agregada");
    } else {
        echo "Error al agregar habitacion: " . mysqli_error($con);
    }
}
?>