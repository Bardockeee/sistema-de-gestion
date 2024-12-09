<?php

include"conexion.php";
$con = conectar();

$id=$_GET['id_usuario'];


$sql = "DELETE FROM usuarios WHERE id_usuario='$id'";

$query = mysqli_query($con, $sql);

if ($query) {
    header("Location: usuarios.php");
} else {
    echo "Error en la eliminacion: " . mysqli_error($con);
}
?>