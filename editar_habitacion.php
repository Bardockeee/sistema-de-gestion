<?php
include("conexion.php");
$con = conectar();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $id = $_POST['id_habitacion'];
    $numero = $_POST['numero'];
    $categoria =$_POST['categoria'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $estado = $_POST['estado'];

    $sql = "UPDATE habitaciones SET numero='$numero', categoria='$categoria', descripcion='$descripcion', precio='$precio', estado='$estado' WHERE id_habitacion='$id'";


    $query = mysqli_query($con, $sql);

    if ($query) {
       
        header("Location: editar_habitacion.php?id_habitacion=$id&actualizado=exito");
        exit();
    } else {
        echo "Error al actualizar el registro: " . mysqli_error($con);
    }
}


if (isset($_GET['id_habitacion'])) {
    $id = $_GET['id_habitacion'];
    $sql = "SELECT * FROM habitaciones WHERE id_habitacion='$id'";
    $query = mysqli_query($con, $sql);

    if ($query && mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
    } else {
        echo "Registro no encontrado.";
        exit();
    }
} else {
    echo "ID no especificado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar habitacion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</head>
<body>

<?php
 
    if (isset($_GET['actualizado']) && $_GET['actualizado'] === 'exito') {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var actualizacionExitosaModal = new bootstrap.Modal(document.getElementById('actualizacionExitosaModal'));
                actualizacionExitosaModal.show();
            });
        </script>";
    }
    ?>

    <div class="container">
        <form method="POST">
            <h2 class="text-white text-center">Actualizar Habitacion</h2>
            
            <input type="hidden" name="id_habitacion" value="<?= $row['id_habitacion']; ?>">

            <div class="mb-3">
                <label for="numero" class="form-label">Numero habitacion:</label>
                <input type="number" class="form-control" id="numero" name="numero" value="<?= $row['numero']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" id="categoria" name="categoria" readonly>
                    <option value="Simple" <?= $row['categoria'] === 'Simple' ? 'selected' : ''; ?>>Simple</option>
                    <option value="Matrimonial" <?= $row['categoria'] === 'Matrimonial' ? 'selected' : ''; ?>>Matrimonial</option>
                    <option value="Deluxe" <?= $row['categoria'] === 'Deluxe' ? 'selected' : ''; ?>>Deluxe</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <input type="text" class="form-control" id="Descripcion" name="descripcion" value="<?= $row['descripcion']; ?>" readonly>
            </div>
            
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="precio" class="form-control" id="precio" name="precio" value="<?= $row['precio']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" id="estado" name="estado" readonly>
                    <option value="Disponible" <?= $row['estado'] === 'Disponible' ? 'selected' : ''; ?>>Disponible</option>
                    <option value="No Disponible" <?= $row['estado'] === 'No Disponible' ? 'selected' : ''; ?>>No disponible</option>
                </select>
        </div>
            
            <div class="mb-3">
                <button type="submit" class="btn btn-danger w-100">Actualizar</button>
            </div>
        </form>
    </div>
    <!-- Modal de éxito  -->
    <div class="modal fade" id="actualizacionExitosaModal" tabindex="-1" aria-labelledby="actualizacionExitosaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
        <div class="modal-header border-secondary">
            <h5 class="modal-title" id="actualizacionExitosaLabel">¡Actualización Exitosa!</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Los datos se han actualizado correctamente.
        </div>
        <div class="modal-footer border-secondary">
            <button type="button" class="btn btn-light" onclick="redirigirHabitaciones()">Aceptar</button>
        </div>
        </div>
    </div>
    </div>
    
    <script>
    function redirigirHabitaciones() {
        window.location.href = 'habitaciones.php'; 
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>    

</body>
</html>