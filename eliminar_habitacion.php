<?php

include("conexion.php");
$con = conectar();

$id=$_GET['id_habitacion'];


$sql = "DELETE FROM habitaciones WHERE id_habitacion='$id'";

$query = mysqli_query($con, $sql);

if ($query) {
    header("Location: habitaciones.php");
} else {
    echo "Error en la eliminacion: " . mysqli_error($con);
}